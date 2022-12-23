<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApplicationRequest;
use App\Models\Application;
use App\Models\Project;
use Aws\S3\S3Client;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validated = $request->validate([
            'project_id' => 'bail|required',
        ]);
        
        $this->authorize('create', [Application::class, $request->get('project_id')]); 

        $project = Project::where('id', $validated['project_id'])->firstOrFail();

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
        
        $this->authorize('create', [Application::class, $validated['project_id']]); 
        
        $user = $request->user();
        $projectId = $validated['project_id'];
        $description = $validated['description'];
        $file = $validated['resume'];
        $fileName = $file->getClientOriginalName();
        $user = null; 

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
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
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
