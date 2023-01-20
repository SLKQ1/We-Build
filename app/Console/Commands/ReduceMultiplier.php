<?php

namespace App\Console\Commands;

use App\Models\Project;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ReduceMultiplier extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reduce_multiplier';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reduce multiplier on projects by 1.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $projectsWithMultiplier = Project::where('multiplier', '>', 0)->get();

        foreach ($projectsWithMultiplier as $project) {
            $multiplier = $project->multiplier; 
            
            if ($multiplier > 0) {
                $project->multiplier -= 1; 
                $project->save(); 
            }
        }
        
        return Command::SUCCESS;
    }
}
