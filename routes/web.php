<?php

use App\Http\Controllers\ProjectApplicationController;
use App\Http\Controllers\ProjectController;
use App\Models\Project;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
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

Route::get('/dashboard', function () {
    $projects = Project::where('user_id', Auth::user()->id)->paginate(10); 
    return Inertia::render('Dashboard', ['projects' => $projects]);
})->middleware(['auth', 'verified'])->name('dashboard');


Route::resource('projects', ProjectController::class)->except(['show', 'index'])->middleware('auth', 'verified'); 
Route::resource('projects', ProjectController::class)->only(['show', 'index']);

Route::get('/leaderboards', function () {
    return Inertia::render('Leaderboards');
})->name('leaderboards');

require __DIR__.'/auth.php';
