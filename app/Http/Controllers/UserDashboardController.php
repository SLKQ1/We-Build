<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class UserDashboardController extends Controller
{
    public function index() { 
        $userPoints = Auth::user()->projects->sum('points');
        $userProjects = Auth::user()->projects;

        return Inertia::render('Dashboard/Home', ['userPoints' => $userPoints, 'userProjects' => $userProjects]);

    }
}
