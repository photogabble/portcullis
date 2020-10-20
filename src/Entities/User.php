<?php

namespace Photogabble\Portcullis\Entities;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class User
 * @package Photogabble\Portcullis\Entities
 *
 * @property int id
 * @property int inviter_id
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Carbon|null email_verified_at
 * @property Carbon|null delete_after
 * @property Carbon|null disabled_on
 * @property string locale
 * @property string|null profile_photo_url
 * @property string display_name
 * @property string username
 * @property string email
 * @property string role
 * @property string password
 * @property string remember_token
 *
 * @property-read User|null inviter
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    const ROLE_EVALUATOR = 'evaluator';
    const ROLE_USER = 'user';
    const ROLE_MODERATOR = 'moderator';
    const ROLE_ADMIN = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'display_name', 'email', 'password', 'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'disabled_on' => 'datetime',
        'email_verified_at' => 'datetime',
        'delete_after' => 'datetime',
    ];

    /**
     * Hash Password on save
     */
    public function setPasswordAttribute($pass){
        $this->attributes['password'] = Hash::make($pass);
    }
    
    public function inviter(): ?BelongsTo
    {
        return $this->belongsTo(User::class, 'inviter_id');
    }

    /**
     * Because we can have empty email addresses for anonymous authentication
     * this method returns true in the case of the email being empty.
     *
     * @return bool
     */
    public function hasVerifiedEmail(): bool
    {
        if (empty($this->email)) {
            return true;
        }
        return ! is_null($this->email_verified_at);
    }
}
