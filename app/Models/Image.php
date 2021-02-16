<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $image_url
 * @property int $image_id
 * @property string $image_type
 */
class Image extends Model
{
    public $timestamps = false;
    /**
     * @var array
     */
    protected $fillable = ['image_url', 'image_id', 'image_type'];

    /**
     * Get the parent Imagable model (Course Or Article).
     */
    public function image() {
        return $this->morphTo();
    }

}
