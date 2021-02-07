<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $status
 * @property int $likeable_id
 * @property string $likeable_type
 */
class Like extends Model
{
    public $timestamps = false;
    /**
     * @var array
     */
    protected $fillable = ['status', 'likeable_id', 'likeable_type'];

}
