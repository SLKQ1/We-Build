<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ProjectController;
use App\Models\Application as ApplicationModel;
use Illuminate\Foundation\Application;
use App\Models\Project;
use App\Models\User;
use App\Models\ProjectUser;
use Illuminate\Support\Facades\Auth;
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
    
    Route::get('/dashboard/projects/points', function () {
        return Inertia::render('Dashboard/UserPoints');
    })->name('dashboard.points');
    
    Route::get('/dashboard/projects/team_points', function () {
        return Inertia::render('Dashboard/TeamPoints');
    })->name('dashboard.team_points');
    
    Route::get('/dashboard/projects', function () {
        $projects = Project::query()
            ->whereIn('id', function ($query) {
                $query->select('project_id')->from('project_user')->where('user_id', Auth::user()->id);
            })
            ->when(Request::input('filter'), function ($query, $filter) {
                $query->where('status', $filter);
            })
            ->paginate(10)
            ->withQueryString(); 
    
        return Inertia::render('Dashboard/UserProjects', ['projects' => $projects, 'filter' => Request::input('filter')]);
    })->name('dashboard.projects');
    
    Route::get('/dashboard/applications', function () {
        $applications = ApplicationModel::query()
            ->with('project')
            ->where('user_id', Auth::user()->id)
            ->when(Request::input('filter'), function ($query, $filter) {
                $query->where('status', $filter);
            })
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

    // Project application routes
    Route::get('projects/{project}/applications', [ApplicationController::class, 'index'])->name('projects.applications.index');
    Route::get('projects/{project}/applications/{application}', [ApplicationController::class, 'show'])->name('projects.applications.show');
    Route::get('projects/{project}/applications/{application}/resume', [ApplicationController::class, 'downloadResume'])->name('projects.applications.downloadResume');
    Route::get('projects/{project}/application/create', [ApplicationController::class, 'create'])->name('projects.applications.create');
    Route::post('projects/{project}/application/store', [ApplicationController::class, 'store'])->name('projects.applications.store');
    Route::post('projects/{project}/application/update', [ApplicationController::class, 'update'])->name('projects.applications.update');
});

// Project routes
Route::resource('projects', ProjectController::class)->only(['show', 'index']);

Route::get('/leaderboards', function () {
    return Inertia::render('Leaderboards');
})->name('leaderboards');

require __DIR__ . '/auth.php';
