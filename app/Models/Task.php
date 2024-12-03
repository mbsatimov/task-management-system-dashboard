<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Task extends Model
{
    /**
     * @var string
     */
    protected $table = 'tasks';

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'description',
        'video',
        'category',
        'progress',
        'created_by',
        'updated_by',
    ];

    /**
     * @return BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'task_user'); // Assumes a pivot table named 'task_user'
    }


    // Relationship to the TaskCategory model

    /**
     * @return BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(TaskCategory::class, 'category');
    }

    // Relationship to the User model for created_by

    /**
     * @return BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Relationship to the User model for updated_by

    /**
     * @return BelongsTo
     */
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
