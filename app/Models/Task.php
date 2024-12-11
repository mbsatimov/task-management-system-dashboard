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
        'title',
        'description',
        'video',
        'category_id',
        'mentor_id',
        'deadline',
    ];

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(TaskCategory::class);
    }

    // Relationship to the TaskCategory model

    /**
     * @return BelongsTo
     */
    public function mentor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }

    /**
     * @return BelongsToMany
     */
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_task')->withPivot('status')->withTimestamps();
    }

    /**
     * @return array
     */
    protected function casts(): array
    {
        return [
            'deadline' => 'datetime',
        ];
    }
}
