<?php
namespace App\Services\Task;

use App\Enums\TaskStatus;
use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Validation\ValidationException;

class TaskStatusService{
    public function changeStatus(Task $task, TaskStatus $newStatus, User $actor): Task{
        if ($actor->role->value !== 'admin' && $task->user_id !== $actor->id) {
            throw new AuthorizationException('Forbidden');
        }

        $current = $task->status;

        if ($actor->role->value === 'user') {
            if ($current === TaskStatus::DONE) {
                throw ValidationException::withMessages([
                    'status' => 'Task Already Complete.'
                ]);
            }
            if (!$this->isValidUserTransition($current, $newStatus)) {
                throw ValidationException::withMessages([
                    'status' => 'Invalid status transition.'
                ]);
            }
        }

        $task->status = $newStatus;
        $task->save();

        return $task;
    }
    
    private function isValidUserTransition(TaskStatus $from, TaskStatus $to): bool {
        return match ($from){
            TaskStatus::TODO  => $to === TaskStatus::PROGRESS,
            TaskStatus::PROGRESS => $to === TaskStatus::DONE,
            default => false,
        };
    }
}