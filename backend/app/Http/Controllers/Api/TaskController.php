<?php

namespace App\Http\Controllers\Api;

use App\Enums\TaskStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\TaskStoreRequest;
use App\Models\Task;
use App\Services\Task\TaskQueryService;
use App\Services\Task\TaskService;
use App\Services\Task\TaskStatusService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        protected TaskService $taskService,
        protected TaskStatusService $statusService,
        protected TaskQueryService $queryService,
    ) {}

public function index(Request $request)
{
    $tasks = $this->queryService
        ->build($request->all())
        ->where('user_id', $request->user()->id)
        ->paginate(10);
    return response()->json($tasks);
}

public function store(TaskStoreRequest $request)
{
    $task = $this->taskService->create(
        $request->validated(),
        $request->user()
    );
    return response()->json($task, 201);
}

public function updateStatus(Request $request, Task $task)
{
    $request->validate([
        'status' => 'required|in:todo,progress,done'
    ]);
    $this->statusService->changeStatus(
        $task,
        TaskStatus::from($request->status),
        $request->user()
    );
    return response()->json($task);
}

public function destroy(Request $request, Task $task)
{
    $this->authorize('delete', $task);
    $this->taskService->delete($task, $request->user());
    return response()->json(['message' => 'Task deleted']);
}
}
