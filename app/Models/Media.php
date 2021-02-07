<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $media_url
 * @property int $type
 * @property int $mediable_id
 * @property string $mediable_type
 */
class Media extends Model
{
    public $timestamps = false;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'media';

    /**
     * @var array
     */
    protected $fillable = ['media_url', 'type', 'mediable_id', 'mediable_type'];

    /**
     * Get the parent Imagable model (Course Or Article).
     */
    public function mediable() {
        return $this->morphTo();
    }


}
