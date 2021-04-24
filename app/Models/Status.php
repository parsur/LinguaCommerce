<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $status
 * @property int $status_id
 * @property string $status_type
 */
class Status extends Model
{
    public $timestamps = false;

    // Active | Inactive (Order)
    const ACTIVE = 0;
    const INACTIVE = 1;
    // Paid | Not paid
    const NOT_PAID = 2;
    const PAID = 3;

    /**
     * Scope a query to only include active statuse.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query) {
        return $query->where('status', Status::ACTIVE);
    }

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'status';

    /**
     * @var array
     */
    protected $fillable = ['status', 'status_id', 'status_type'];

    /**
     * Get The parent status model
     */
    public function status() {
        return $this->morphTo();
    }


}
