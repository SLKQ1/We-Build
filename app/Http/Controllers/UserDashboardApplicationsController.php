<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UserDashboardApplicationsController extends Controller
{
    public function index()
    {
        $applications = Application::query()
            ->with('project')
            ->where('user_id', Auth::user()->id)
            ->when(Request::input('filter'), function ($query, $filter) {
                $query->where('status', $filter);
            })
            ->orderBy('created_at', 'asc')
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('Dashboard/Applications/Index', ['applications' => $applications, 'filter' => Request::input('filter')]);
    }
}
