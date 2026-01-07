<?php

namespace App\Models;

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use DateTime;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'priority',
        'status',
        'deadline',
        'reminder_at',
    ];

    protected $casts = [
        'status' => TaskStatus::class,
        'priority' => TaskPriority::class,
        'deadline' => 'datetime',
        'reminder_at' => 'datetime'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
