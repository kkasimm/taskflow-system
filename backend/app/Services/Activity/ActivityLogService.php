<?php
namespace App\Services\Activity;

use App\Models\ActivityLog;
use App\Models\User;

class ActivityLogService{

    public function log(
        user $actor,
        string $action,
        string $targetType,
        int $targetId,
        array|null $oldData = null,
        array|null $newData = null,
    ): void {
        ActivityLog::create([
            'actor_id' => $actor->id,
            'actor_role' => $actor->role->value,
            'action' => $action,
            'target_type' => $targetType,
            'target_id' => $targetId,
            'old_data' => $oldData,
            'new_data' => $newData,
        ]);
        
    }

}
