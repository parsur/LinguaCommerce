<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $count
 * @property string $order_factor
 * @property int $cartable_id
 * @property string $cartable_type
 */
class Cart extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['count', 'order_factor', 'cartable_id', 'cartable_type'];

}
