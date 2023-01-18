<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectUser;
use App\Models\ProjectVotes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProjectVotesController extends Controller
{
    function submitUpVote(Request $request, Project $project) {
        Log::info('in here submit up vote', [$request->all(), $project]); 
        
        $validated = $request->validate([
            'vote_type' => 'bail|required',
        ]);
        
        $this->authorize('create', [ProjectVotes::class, $project]);

        try {
            $project = DB::transaction(function () use ($project, $validated, $request) {
                // creating vote
                ProjectVotes::create(
                    [
                        'user_id' => $request->user()->id,
                        'project_id' => $project->id, 
                        'vote_type' => $validated['vote_type'],
                    ]
                );
    
                // updating project points
                $project->update([
                    'points' => $project->points + 1
                ]); 
    
                return $project;
            });
            return response()->json('Vote Submitted'); 
        } catch (\Exception $exception) {
            return response()->json('Vote Not Submitted'); 
        }
    }
}
