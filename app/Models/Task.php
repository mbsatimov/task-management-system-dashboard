<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';

    protected $fillable = [
        'name',
        'description',
        'video',
        'category',
        'progress',
        'created_by',
        'updated_by',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'task_user'); // Assumes a pivot table named 'task_user'
    }


    // Relationship to the TaskCategory model
    public function category()
    {
        return $this->belongsTo(TaskCategory::class, 'category');
    }

    // Relationship to the User model for created_by
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Relationship to the User model for updated_by
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
