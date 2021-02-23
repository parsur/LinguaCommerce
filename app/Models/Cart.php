<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property int $course_id
 * @property int $count
 * @property string $order_factor
 * @property Course $course
 * @property User $user
 */
class Cart extends Model
{
    public $timestamps = false;
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'course_id', 'count', 'order_factor'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course()
    {
        return $this->belongsTo('App\Models\Course');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

}
