<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'telephone',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Scope a query to only include user's attributes of a given text.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed  $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfText($query, $text)
    {
        if (!$text) {
            return;
        }

        return $query->where('first_name', 'LIKE', "%{$text}%")
            ->orWhere('last_name', 'LIKE', "%{$text}%")
            ->orWhere('email', 'LIKE', "%{$text}%")
            ->orWhere('telephone', 'LIKE', "%{$text}%")
        ;
    }
}
