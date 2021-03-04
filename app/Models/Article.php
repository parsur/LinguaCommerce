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
     * Cascade On Delete.
     */
    use CascadesDeletes;
    protected $cascadeDeletes = ['image', 'video','description','statuses','comments'];

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
     * Get all of the article's poster.
     */
    public function poster() {
        return $this->morphMany('App\Models\Poster', 'poster');
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
