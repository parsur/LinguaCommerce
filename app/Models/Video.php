<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $video_url
 * @property int $video_id
 * @property string $video_type
 */
class Video extends Model
{
    public $timestamps = false;
    
    /**
     * @var array
     */
    protected $fillable = ['video_url', 'video_id', 'video_type'];

    /**
     * Get the parent Imagable model (Course Or Article).
     */
    public function video() {
        return $this->morphTo();
    }

}
