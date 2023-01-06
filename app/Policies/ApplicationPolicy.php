<?php

namespace App\Policies;

use App\Models\Application;
use App\Models\Project;
use App\Models\ProjectUser;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Log;

class ApplicationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user, Project $project)
    {
        // checking if user is owner of project
        return Project::where('id', $project->id)->where('user_id', $user->id)->exists()
            ? Response::allow()
            : Response::deny("You are not authorized to view applications for this project.");
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Project $project, Application $application)
    {
        $isApplicationIsForProject = $project->id == $application->project->id;
        $isOwnerOfProject = Project::where('id', $project->id)->where('user_id', $user->id)->exists();
        $isOwnerOfApplication = $application->user_id == $user->id;
        # checking if user is owner of the project 
        return $isApplicationIsForProject && ($isOwnerOfApplication || $isOwnerOfProject)
            ? Response::allow()
            : Response::deny("You are not authorized to view this application.");
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user, Project $project)
    {
        // check if user has not already applied to this project
        $isFirstTimeApplying = !Application::where('user_id', $user->id)->where('project_id', $project->id)->exists();
        $isOwnerOfProject = Project::where('id', $project->id)->where('user_id', $user->id)->exists();
        $isProjectStarted = $project->status === Project::IN_PROGRESS;
        
        return !$isProjectStarted && $isFirstTimeApplying && !$isOwnerOfProject
            ? Response::allow()
            : Response::deny('You are not authorized to apply to this project.');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Project $project, Application $application)
    {
        //   
    }

    public function acceptOrReject(User $user, Project $project, Application $application)
    {   
        $isTeamFull = ProjectUser::where('project_id', $project->id)->count() === $project->team_size; 
        return !$isTeamFull && Project::where('id', $project->id)->where('user_id', $user->id)->exists()
        ? Response::allow()
        : Response::deny('This Project is full');
;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Application $application)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Application $application)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Application $application)
    {
        //
    }
}
