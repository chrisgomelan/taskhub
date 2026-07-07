<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = 'categories';
    protected $fillable = [
        'name',
        'description',
        'is_active',
        'created_at',
        'updated_at',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
