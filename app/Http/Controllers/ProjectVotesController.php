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
                if ($project->multiplier) {
                    $points = $project->points + (1 * $project->multiplier); 
                } else {
                    $points = $project->points + 1;
                }
                
                $project->update([
                    'points' => $points
                ]); 
    
                return $project;
            });
            return response()->json('Vote Submitted'); 
        } catch (\Exception $exception) {
            return response()->json('Vote Not Submitted'); 
        }
    }
}
