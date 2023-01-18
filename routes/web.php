<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectVotesController;
use App\Models\Application as ApplicationModel;
use Illuminate\Foundation\Application;
use App\Models\Project;
use App\Models\User;
use App\Models\ProjectUser;
use App\Models\ProjectVotes;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard/Home');
    })->name('dashboard');

    Route::get('/dashboard/projects', function () {
        $projects = Project::query()
            ->where('user_id', Auth::user()->id)
            ->when(Request::input('filter'), function ($query, $filter) {
                $query->where('status', $filter);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('Projects/Index', ['projects' => $projects, 'filter' => Request::input('filter')]);
    })->name('dashboard.projects');

    Route::get('/dashboard/projects/team', function () {
        $projects = Project::query()
            ->where('user_id', '!=', Auth::user()->id)
            ->whereIn('id', function ($query) {
                $query->select('project_id')->from('project_user')->where('user_id', Auth::user()->id);
            })
            ->when(Request::input('filter'), function ($query, $filter) {
                $query->where('status', $filter);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('Projects/Index', ['projects' => $projects, 'filter' => Request::input('filter')]);
    })->name('dashboard.projects.team');

    Route::get('/dashboard/applications', function () {
        $applications = ApplicationModel::query()
            ->with('project')
            ->where('user_id', Auth::user()->id)
            ->when(Request::input('filter'), function ($query, $filter) {
                $query->where('status', $filter);
            })
            ->orderBy('created_at', 'asc')
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('Dashboard/Applications/Index', ['applications' => $applications, 'filter' => Request::input('filter')]);
    })->name('dashboard.applications');

    // Project routes
    Route::resource('projects', ProjectController::class)->except(['show', 'index'])->middleware('auth', 'verified');
    Route::get('projects/{project}/start', function ($project) {
        $project = Project::where('id', $project)->firstOrFail();
        return Inertia::render('Projects/Start', ['project' => $project, 'team' => $project->users]);
    })->middleware(['auth', 'verified'])->name('projects.start');

    Route::get('projects/{project}/complete', function ($project) {
        $project = Project::where('id', $project)->firstOrFail();
        return Inertia::render('Projects/Complete', ['project' => $project, 'team' => $project->users]);
    })->middleware(['auth', 'verified'])->name('projects.complete');

    
    Route::post('projects/{project}/upvote', [ProjectVotesController::class, 'submitUpVote'])->name('projects.upvote'); 

    // Project application routes
    Route::get('projects/{project}/applications', [ApplicationController::class, 'index'])->name('projects.applications.index');
    Route::get('projects/{project}/applications/{application}', [ApplicationController::class, 'show'])->name('projects.applications.show');
    Route::get('projects/{project}/applications/{application}/resume', [ApplicationController::class, 'downloadResume'])->name('projects.applications.downloadResume');
    Route::put('projects/{project}/applications/{application}/status', [ApplicationController::class, 'acceptOrRejectApplication'])->name('projects.applications.acceptOrRejectApplication');
    Route::get('projects/{project}/application/create', [ApplicationController::class, 'create'])->name('projects.applications.create');
    Route::post('projects/{project}/application/store', [ApplicationController::class, 'store'])->name('projects.applications.store');


    // Votes 
});

// Project routes
Route::resource('projects', ProjectController::class)->only(['show', 'index']);

Route::get('/leaderboards', function () {
    return Inertia::render('Leaderboards');
})->name('leaderboards');

require __DIR__ . '/auth.php';
