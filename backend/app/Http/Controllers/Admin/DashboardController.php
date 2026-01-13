<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use App\Enums\TaskStatus;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $tasks = Task::query();

        return view('admin.dashboard', [
            'totalUsers' => User::count(),
            'totalTasks' => $tasks->count(),

            'todo' => Task::where('status', TaskStatus::TODO)->count(),
            'progress' => Task::where('status', TaskStatus::PROGRESS)->count(),
            'done' => Task::where('status', TaskStatus::DONE)->count(),

            'overdue' => Task::whereNot('status', TaskStatus::DONE)
                ->whereDate('deadline', '<', now())
                ->count(),

            // chart data
            'statusChart' => [
                'todo' => Task::where('status', TaskStatus::TODO)->count(),
                'progress' => Task::where('status', TaskStatus::PROGRESS)->count(),
                'done' => Task::where('status', TaskStatus::DONE)->count(),
            ],
        ]);
    }
}
