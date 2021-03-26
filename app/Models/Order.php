<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use ShiftOneLabs\LaravelCascadeDeletes\CascadesDeletes;

/**
 * @property int $id
 * @property int $user_id
 * @property string $factor
 * @property string $total_price
 * @property string $transportation
 * @property string $payment
 * @property int $status
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
    protected $fillable = ['factor', 'total_price', 'user_id', 'test'];

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
}
