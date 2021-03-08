<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $url
 * @property int $type
 * @property int $media_id
 * @property string $media_type
 */
class Media extends Model
{
    const IMAGE = 0;
    const VIDEO = 1;

    public $timestamps = false;
    /**
     * @var array
     */
    protected $fillable = ['url', 'type', 'media_id', 'media_type'];

    /**
     * Get the parent Imagable model (Course Or Article).
     */
    public function media() {
        return $this->morphTo();
    }

}
