<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';
    protected $fillable = [
        'title',
        'description',
        'due_date',
        'is_completed',
        'category_id',
        'created_at',
        'updated_at',
    ];

    public function subTasks()
    {
        return $this->hasMany(SubTask::class);
    }

    public function category()
    {
        return $this->belongsTo(Categories::class);
    }
}
