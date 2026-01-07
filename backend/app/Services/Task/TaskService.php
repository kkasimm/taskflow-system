<?php

namespace App\Services\Task;

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use App\Models\Task;
use App\Models\User;
use App\Services\Activity\ActivityLogService;

class TaskService
{
    public function __construct(
        protected ActivityLogService $activityLog
    ) {}

    public function create(array $data, User $user)
    {
        $task = Task::create([
            'user_id'    => $user->id,
            'title'      => $data['title'],
            'description' => $data['description'] ?? null,
            'priority'   => TaskPriority::from($data['priority']),
            'status'     => TaskStatus::TODO,
            'deadline'   => $data['deadline'] ?? null,
            'reminder_at' => $data['reminder_at'] ?? null,
        ]);

        $this->activityLog->log(
            $user,
            'create->task',
            'task',
            $task->id,
            null,
            $task->toArray()
        );
        return $task;
    }

    public function delete(Task $task, User $actor){
        $old = $task->toArray();
        $task->delete();

        $this->activityLog->log(
             $actor,
            'delete_task',
            'task',
            $task->id,
            $old,
            null
        );
    }
}
