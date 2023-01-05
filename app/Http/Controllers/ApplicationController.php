<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Project;
use App\Models\ProjectUser;
use Exception;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Project $project)
    {
        $this->authorize('viewAny', [Application::class, $project]);

        $applications = $project->applications()
        ->with('user')
        ->orderBy('created_at', 'asc')
        ->when(Request::input('filter'), function ($query, $filter) {
            if ($filter == Application::VIEWED) {
                $query->whereIn('status', [$filter, Application::ACCEPTED, Application::REJECTED]);
            } else {
                $query->where('status', $filter);
            }
        })
        ->paginate(10)
        ->withQueryString(); 

        return Inertia::render('Applications/Index', ['project' => $project, 'applications' => $applications, 'filter' => Request::input('filter')]);
    }

    /**
     * Show the form for creating a new resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create(Project $project)
    {
        $this->authorize('create', [Application::class, $project]);

        return Inertia::render('Applications/Create', ['project' => $project]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_id' => 'bail|required',
            'description' => 'nullable',
            'resume' => 'required',
        ]);

        $project = Project::where('id', $validated['project_id'])->firstOrFail();
        $this->authorize('create', [Application::class, $project]);

        $user = $request->user();
        $projectId = $validated['project_id'];
        $description = $validated['description'];
        $file = $validated['resume'];
        $fileName = $file->getClientOriginalName();

        if ($user) {
            $file->storeAs("resumes/project_{$projectId}/user_{$user->id}", $fileName, 's3');
            Application::create(
                [
                    'user_id' => $user->id,
                    'project_id' => $projectId,
                    'description' => $description,
                    'resume_file_path' => "resumes/project_{$projectId}/user_{$user->id}/{$fileName}",
                ]
            );
            return redirect()->route('projects.index')->with('message', 'You successfully applied to the project.');
        } else {
            return redirect()->route('projects.index')->with('error', 'Unable to create your application.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project, Application $application)
    {
        $this->authorize('view', [Application::class, $project, $application]);
        
        // update the application status to viewed when the user first views the application
        if ($application->status == Application::PENDING) {
            $application->status = Application::VIEWED; 
            $application->save(); 
        }

        return Inertia::render('Applications/Show', ['application' => $application, 'project' => $project, 'user' => $application->user->name]);
    }

    public function downloadResume(Project $project, Application $application)
    {
        $fileName = "{$application->user->name}'s application for {$project->title}";
        return Storage::disk('s3')->download($application->resume_file_path, $fileName);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Project $project, Request $request)
    {
        $validated = $request->validate([
            'status' => 'bail|required',
        ]);


        return redirect()->route('project.applications.index', ['project' => $project])->with('message', 'You have updated your application.');
    }

    /**
     * Accept or reject application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function acceptOrRejectApplication(Project $project, Application $application, HttpRequest $request)
    {
        $validated = $request->validate([
            'status' => 'bail|required',
        ]);

        $this->authorize('acceptOrReject', [Application::class, $project, $application]);
        
        
        DB::transaction(function () use ($application, $project, $validated, $request) {
            // updating application 
            $application->update($validated);

            // creating record in users project table
            ProjectUser::create([
                'user_id' => $request->user()->id,
                'project_id' => $project->id,
            ]);
        });

        if ($validated['status'] == Application::ACCEPTED) {
            return redirect()->route('projects.applications.index', ['project' => $project])->with('message', "You have accepted {$application->user->name}'s application.");
        } else {
            return redirect()->route('projects.applications.index', ['project' => $project])->with('message', "You have rejected {$application->user->name}'s application.");
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
