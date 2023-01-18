<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Models\Application;
use App\Models\Project;
use App\Models\ProjectUser;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class ProjectController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Project::class, null, ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::query()
            ->when(Request::input('filter'), function ($query, $filter) {
                $query->where('status', $filter);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('Projects/Index', [
            'projects' => $projects, 
            'filter' => Request::input('filter')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Projects/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Project $project, StoreProjectRequest $request)
    {
        # when we create a project we also want to create a record in the users projects table
        try {
            $project = DB::transaction(function () use ($request) {
                // creating project
                $project = Project::create(
                    [
                        'user_id' => $request->user()->id,
                        'title' => $request->title,
                        'description' => $request->description,
                        'team_size' => $request->team_size,
                        'due' => $request->due,
                        // when team size is 1 we already have a due date so the project is started
                        'status' => $request->team_size === 1 ? Project::IN_PROGRESS : $request->status
                    ]
                );

                // creating record in users project table
                ProjectUser::create([
                    'user_id' => $request->user()->id,
                    'project_id' => $project->id,
                ]);

                return $project;
            });

            return Redirect::route('projects.show', $project)->with('message', 'Project created successfully');
        } catch (\Exception $exception) {
            return Redirect::route('projects.index')->with('error', "Unable to create project. {$exception}");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $currentTeamSize = ProjectUser::where('project_id', $project->id)->count();
        $hasApplied = false;
        if (Auth::user()) {
            $hasApplied = Application::where('project_id', $project->id)->where('user_id', Auth::user()->id)->exists();
        }

        return Inertia::render('Projects/Show', [
            'project' => $project, 
            'currentTeamSize' => $currentTeamSize, 
            'hasApplied' => $hasApplied, 
            'multiplier' => $project->multiplier, 
            'points' => $project->points, 
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return Inertia::render('Projects/Edit', ['project' => $project]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Project $project, StoreProjectRequest $request)
    {
        Project::where('id', $project->id)->update($request->validated());

        return redirect()->route('projects.index')->with('message', 'Project was updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index')->with('message', 'Project was deleted successfully');
    }
}
