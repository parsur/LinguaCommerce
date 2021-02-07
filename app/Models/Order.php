<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property string $order_factor
 * @property string $totalـprice
 * @property string $transportation
 * @property string $payment
 * @property int $status
 * @property User $user
 */
class Order extends Model
{
    public $timestamps = false;
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'order_factor', 'totalـprice', 'transportation', 'payment', 'status'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
