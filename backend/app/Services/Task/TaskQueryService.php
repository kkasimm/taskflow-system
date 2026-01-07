<?php
namespace App\Services\Task;

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use App\Models\Task;
use Illuminate\Database\Eloquent\Builder;

class TaskQueryService{
    public function build(array $filters){
        return Task::query()->when($filters['status'] ?? null, fn ($q, $v) 
        => $q->where('status', TaskStatus::from($v))
        )->when($filters['priority'] ?? null, fn($q, $v)
        => $q->where('status', TaskStatus::from($v))
        )->when($filters['search'] ?? null, fn($q, $v)
        => $q->where('title', 'like', "%{$v}%")
        )->orderByraw("
        CASE 
            WHEN deadline IS NULL THEN 1
            WHEN deadline  < NOW() THEN 0
            ELSE 1
        END
        ")->orderBy('deadline');
    }
}