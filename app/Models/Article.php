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
 * @property int $article_id
 * @property string $article_type
 * @property int $subCategory_id
 * @property Category $category
 * @property SubCategory $subCategory
 */
class Article extends Model
{
    /**
     * Cascade deletes.
     */
    use CascadesDeletes;
    protected $cascadeDeletes = ['image', 'video','description','statuses'];

    /**
     * @var array
     */
    protected $fillable = ['category_id', 'title', 'created_at', 'updated_at', 'article_id', 'article_type', 'subCategory_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subCategory()
    {
        return $this->belongsTo('App\Models\SubCategory');
    }

    /*
     * Get all of the course's media.
     */
    public function image() {
        return $this->morphMany('App\Models\Image', 'image');
    }

    /*
     * Get all of the course's media.
     */
    public function video() {
        return $this->morphMany('App\Models\Video', 'video');
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
}
