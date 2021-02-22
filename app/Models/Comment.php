<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property int $course_id
 * @property int $article_id
 * @property int $status
 * @property string $idea
 * @property string $created_at
 * @property int $commentable_id
 * @property string $commentable_type
 */
class Comment extends Model
{
    public $timestamps = false;

    public static function boot() 
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_at = $model->freshTimestamps();
        });
    }

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'course_id', 'article_id', 'status', 'idea', 'created_at', 'commentable_id', 'commentable_type'];

    /*
     * Get all of the course's status.
     */
    public function statuses() {
        return $this->morphOne('App\Models\Status', 'status');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

}
