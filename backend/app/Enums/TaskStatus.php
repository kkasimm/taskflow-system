<?php

namespace App\Enums;

enum TaskStatus : string
{
    case TODO = 'todo';
    case PROGRESS = 'progress';
    case DONE = 'done';
}
