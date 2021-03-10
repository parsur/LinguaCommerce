<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title
 * @property int $course_id
 * @property string $url
 * @property Course $course
 */
class File extends Model
{
    public $timestamps = false;
    /**
     * @var array
     */
    protected $fillable = ['title', 'course_id', 'url'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course()
    {
        return $this->belongsTo('App\Models\Course');
    }
}
