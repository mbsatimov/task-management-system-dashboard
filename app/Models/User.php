<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles, HasFactory, Notifiable;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'details'
    ];

    /**
     * @var string[]
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @return HasMany
     */
    public function tasksAsMentor(): HasMany
    {
        return $this->hasMany(Task::class, 'mentor_id');
    }

    /**
     * @return BelongsToMany
     */
    public function tasksAsStudent(): BelongsToMany
    {
        return $this->belongsToMany(Task::class, 'user_task');
    }

    /**
     * @return string[]
     */
    protected function casts(): array
    {
        return [
            'details' => 'array',
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
