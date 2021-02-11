<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $status
 * @property int $articulable_id
 * @property string $articulable_type
 * @property string $created_at
 * @property string $updated_at
 */
class Article extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['title', 'description', 'status', 'articulable_id', 'articulable_type', 'created_at', 'updated_at'];

    /**
     * Get all of the article's media.
     */
    public function comments()
    {
        return $this->morphMany('App\Models\Media', 'mediable');
    }

    /**
     * Get all of the article's descriptions.
     */
    public function descriptions()
    {
        return $this->morphMany('App\Models\Description', 'description');
    }

    /*
     * Get all of the article's status.
     */
    public function statuses() {
        return $this->morphOne('App\Models\Status', 'status');
    }

}
