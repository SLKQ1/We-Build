<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ChatsController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectVotesController;
use App\Http\Controllers\UserDashboardApplicationsController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\UserDashboardProjectsController;
use App\Http\Controllers\UserDashboardTeamProjectsController;
use App\Models\Application as ApplicationModel;
use App\Models\Message;
use Illuminate\Foundation\Application;
use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard routes
    Route::get('{user}/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::get('{user}/dashboard/projects', [UserDashboardProjectsController::class, 'index'])->name('dashboard.projects');
    Route::get('{user}/dashboard/projects/team', [UserDashboardTeamProjectsController::class, 'index'])->name('dashboard.projects.team');
    Route::get('{user}/dashboard/applications', [UserDashboardApplicationsController::class, 'index'])->name('dashboard.applications');

    // Project routes
    Route::resource('projects', ProjectController::class)->except(['show', 'index'])->middleware('auth', 'verified');
    Route::get('projects/{project}/start', function ($project) {
        $project = Project::where('id', $project)->firstOrFail();
        return Inertia::render('Projects/Start', ['project' => $project, 'team' => $project->users]);
    })->middleware(['auth', 'verified'])->name('projects.start');

    Route::get('projects/{project}/complete', function ($project) {
        $project = Project::where('id', $project)->firstOrFail();

        // calculate multiplier
        $dueDate = $project->due;
        $diffDates = now()->diffInDays(Carbon::parse($dueDate));
        if ($dueDate < now()) {
            $multiplier = 0;
            $status = Project::LATE;
        } else {
            $multiplier = floor($diffDates * Project::MULTIPLIER_VAL);
            $status = Project::ON_TIME;
        }

        // updating project
        $project->update([
            'submission_date' => Carbon::now()->toDateTimeString(),
            'multiplier' => $multiplier,
        ]);

        return Inertia::render('Projects/Complete', [
            'project' => $project,
            'team' => $project->users,
            'diffDays' => $diffDates,
            'multiplier' => $multiplier,
            'status' => $status
        ]);
    })->middleware(['auth', 'verified'])->name('projects.complete');


    Route::post('projects/{project}/upvote', [ProjectVotesController::class, 'submitUpVote'])->name('projects.upvote');

    // Project application routes
    Route::get('projects/{project}/applications', [ApplicationController::class, 'index'])->name('projects.applications.index');
    Route::get('projects/{project}/applications/{application}', [ApplicationController::class, 'show'])->name('projects.applications.show');
    Route::get('projects/{project}/applications/{application}/resume', [ApplicationController::class, 'downloadResume'])->name('projects.applications.downloadResume');
    Route::put('projects/{project}/applications/{application}/status', [ApplicationController::class, 'acceptOrRejectApplication'])->name('projects.applications.acceptOrRejectApplication');
    Route::get('projects/{project}/application/create', [ApplicationController::class, 'create'])->name('projects.applications.create');
    Route::post('projects/{project}/application/store', [ApplicationController::class, 'store'])->name('projects.applications.store');
    Route::get('projects/{project}/application/{application}/contact', [ApplicationController::class, 'contact'])->name('projects.applications.contact');

    // Chat routes 
    Route::resource('chat', ChatsController::class);
    Route::post('chat/{chat}/messages', [ChatsController::class, 'sendMessage'])->name('chat.sendMessage');
});

// Project routes
Route::resource('projects', ProjectController::class)->only(['show', 'index']);

Route::get('/leaderboards/users', function () {
    $userLeaderboards = DB::table('projects')
        ->select('users.name', DB::raw("sum(projects.points) as total_points"))
        ->join('project_user', 'projects.id', '=', 'project_user.project_id')
        ->join('users', 'users.id', '=', 'project_user.user_id')
        ->groupBy('users.id')
        ->get();

    return Inertia::render('Leaderboards/UserLeaderboards', ['leaderboards' => $userLeaderboards]);
})->name('userLeaderboards');

Route::get('/leaderboards/team', function () {
    $teamLeaderboards = Project::where('status', Project::DONE)->orderBy('points', 'desc')->get(['id', 'title', 'points', 'team_size']);

    return Inertia::render('Leaderboards/TeamLeaderboards', ['leaderboards' => $teamLeaderboards]);
})->name('teamLeaderboards');

require __DIR__ . '/auth.php';
