<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $value
 */
class HomeSetting extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'value'];

}
