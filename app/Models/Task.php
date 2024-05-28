<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    const STATUS_TODO = 'todo';
    const STATUS_IN_PROGRESS = 'in progress';
    const STATUS_DONE = 'done';

    use HasFactory;

    public function subTasks()
    {
        return $this->hasMany(Task::class, 'parent_id', 'id');
    }

}
