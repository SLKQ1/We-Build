<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Resources\ProjectCollection;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Models\UserProject;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
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
        $this->authorizeResource(Project::class, 'project');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Projects/Index', [
            'projects' => Project::orderBy('created_at', 'desc')->paginate(10),
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
        $request->validated(); 
        # when we create a project we also want to create a record in the users projects table
        DB::transaction(function () use ($request) {
            // creating project
            $project = Project::create(
                [
                    'user_id' => $request->user()->id,
                    'title' => $request->title,
                    'description' => $request->description, 
                    'team_size' => $request->team_size, 
                    'due' => $request->due, 
                    ]
                );

            // creating record in users project table
            UserProject::create([
                'user_id' => $request->user()->id, 
                'project_id' => $project->id,
            ]);

            return Redirect::route('projects.show', $project);
        });

        return Redirect::route('projects.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $currentTeamSize = UserProject::where('project_id', $project->id)->count(); 
        return Inertia::render('Projects/Show', ['project' => $project, 'currentTeamSize' => $currentTeamSize]);
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
    public function destroy($id)
    {
        //
    }
}
