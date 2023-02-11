<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\Request;

class UserDashboardTeamProjectsController extends Controller
{
    public function index()
    {
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
    }
}
