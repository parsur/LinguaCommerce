<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\Status;
use Illuminate\Database\Eloquent\Model;
use ShiftOneLabs\LaravelCascadeDeletes\CascadesDeletes;

/**
 * @property int $id
 * @property int $user_id
 * @property string $factor
 * @property string $total_price
 * @property string $transportation
 * @property string $payment
 * @property User $user
 */

class Order extends Model
{
    public $timestamps = false;

    /**
     * Cascade On Delete.
     */
    use CascadesDeletes;
    protected $cascadeDeletes = ['statuses'];

    /**
     * @var array
     */
    protected $fillable = ['factor', 'total_price', 'transaction_id', 'user_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /*
     * Get all of the order's status.
     */
    public function statuses() {
        return $this->morphOne('App\Models\Status', 'status');
    }

    /**
     * Determine if current user has more than 4 unpaied orders.
     *
     * @return bool
     */
    public function hasExceededOrder()  {
        return $this->statuses()->where('status', Status::ACTIVE)->where('user_id', auth()->user()->id)->count() > 4;
    }

    /**
     * Get the carts with factors.
     * 
     * @return string
     */
    public function getCart($factor) {
        return Cart::where('factor', $factor)->get();
    }
}
