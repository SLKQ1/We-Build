<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\ProjectVotes;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Log;

class ProjectVotesPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProjectVotes  $projectVotes
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, ProjectVotes $projectVotes)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user, Project $project)
    {
        // checking if user is project owner or team member
        $isProjectTeamMember = false; 
        foreach ($project->users as $projectUser) {
            if ($projectUser->id === $user->id) {
                $isProjectTeamMember = true;
            }
        }

        $alreadyVoted = ProjectVotes::where('project_id', $project->id)->where('user_id', $user->id)->exists(); 

        if ($isProjectTeamMember) {
            return Response::deny("You can't vote on this project because you're a team member");
        } else if ($alreadyVoted) {
            return Response::deny("You can't vote on this project because you have already voted");
        }

        return Response::allow(); 
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProjectVotes  $projectVotes
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, ProjectVotes $projectVotes)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProjectVotes  $projectVotes
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, ProjectVotes $projectVotes)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProjectVotes  $projectVotes
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, ProjectVotes $projectVotes)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProjectVotes  $projectVotes
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, ProjectVotes $projectVotes)
    {
        //
    }
}
