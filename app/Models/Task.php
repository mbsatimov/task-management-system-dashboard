<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'title',
        'description',
        'video',
        'category_id',
    ];

    // Relationship to the TaskCategory model

    /**
     * @return BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(TaskCategory::class);
    }
}
