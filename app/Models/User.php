<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Notifications\Notifiable;
use ShiftOneLabs\LaravelCascadeDeletes\CascadesDeletes;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, CascadesDeletes;

    public static function boot() 
    {
        parent::boot();

        static::creating(function ($model) {
            
            if($model->role == User::ADMIN)
                $model->email_verified_at = $model->freshTimestamp();
        });
    }
    
    // Cascade On Delete
    protected $cascadeDeletes = ['comments', 'orders', 'carts'];
    
    const USER = 0;
    const ADMIN = 1;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'password',
        'role'
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
     * Get all of the user's comments.
     */
    public function comments()
    {   
        return $this->morphMany('App\Models\Comment', 'commentable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {   
        return $this->hasMany('App\Models\Order');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function carts()
    {   
        return $this->hasMany('App\Models\Cart');
    }
}
