<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property float $price
 * @property int $status
 * @property int $coursable_id
 * @property string $coursable_type
 */
class Course extends Model
{
    Const VISIBLE = 0;
    Const INVISIBLE = 1;
    
    public $timestamps = false;
    /**
     * @var array
     */
    protected $fillable = ['name', 'price', 'status', 'coursable_id', 'coursable_type'];

    /**
     * Get all of the Course's media.
     */
    public function media() {
        return $this->morphMany('App\Models\Media', 'mediable');
    }

    /**
     * Get all of the course's descriptions.
     */
    public function descriptions() {
        return $this->morphMany('App\Models\description','describable');
    }


}
