<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
