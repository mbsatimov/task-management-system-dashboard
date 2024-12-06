<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mentor extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'category_id',
    ];

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(TaskCategory::class);
    }
}
