<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use ShiftOneLabs\LaravelCascadeDeletes\CascadesDeletes;

/**
 * @property int $id
 * @property string $code
 * @property int $type
 * @property int $value
 */
class Coupon extends Model
{

    public $timestamps = false;

    /**
     * Cascade on delete.
     */
    use CascadesDeletes;
    protected $cascadeDeletes = ['statuses'];

    /**
     * @var array
     */
    protected $fillable = ['code', 'type', 'value', 'course_id'];

    // Type | price, percentage
    const PRICE = 0;
    const PERCENTAGE = 1;


    // Discount
    public function discount($total) {
        // Simple price
        if($this->type == Coupon::PRICE) {
            return $total - $this->value;
        } 
        // Percentage
        else if($this->type == Coupon::PRICE) {
            return ($this->value / 100) * $total;
        } 
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course()
    {
        return $this->belongsTo('App\Models\Course', 'course_id');
    }

    /*
     * Get all of the coupon's status.
     */
    public function statuses() {
        return $this->morphOne('App\Models\Status', 'status');
    }
}
