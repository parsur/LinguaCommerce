<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use ShiftOneLabs\LaravelCascadeDeletes\CascadesDeletes;

/**
 * @property int $id
 * @property int $category_id
 * @property string $title
 * @property string $created_at
 * @property string $updated_at
 * @property int $subcategory_id
 * @property Category $category
 * @property Subcategory $subcategory
 */
class Article extends Model
{
    /**
     * Cascade On Delete.
     */
    use CascadesDeletes;
    protected $cascadeDeletes = ['media','description','statuses','comments'];

    /**
     * @var array
     */
    protected $fillable = ['title', 'created_at', 'updated_at', 'category_id', 'subCategory_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subcategory()
    {
        return $this->belongsTo('App\Models\Subcategory', 'subcategory_id');
    }

    /*
     * Get all of the article's media.
     */
    public function media() {
        return $this->morphMany('App\Models\Media', 'media');
    }

    /*
     * Get all of the course's descriptions.
     */
    public function description() {
        return $this->morphOne('App\Models\Description','description');
    }

    /*
     * Get all of the course's status.
     */
    public function statuses() {
        return $this->morphOne('App\Models\Status', 'status');
    }

    /*
     * Get all of the course's comments.
     */
    public function comments() {
        return $this->morphMany('App\Models\Comment', 'commentable');
    }
}
