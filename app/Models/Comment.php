<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon;

/**
 * @property int $id
 * @property string $name
 * @property string $comment
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
            $model->created_at = $model->freshTimestamp();
        });
    }

    /**
     * @var array
     */
    protected $fillable = ['name', 'comment', 'created_at', 'commentable_id', 'commentable_type'];

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

    /**
     * Get The comment model.
     */
    public function commentable() {
        return $this->morphTo();
    }

}
