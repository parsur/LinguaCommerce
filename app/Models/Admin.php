<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $username
 * @property string $email_verified_at
 * @property string $password
 * @property string $remember_token
 * @property string $created_at
 * @property string $updated_at
 */
class Admin extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'username', 'email_verified_at', 'password', 'remember_token', 'created_at', 'updated_at'];

}
