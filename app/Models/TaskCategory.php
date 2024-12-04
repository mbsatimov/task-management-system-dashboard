<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TaskCategory extends Model
{
    /**
     * @var string
     */
    protected $table = 'task_categories';

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
    ];

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}
