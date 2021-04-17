<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use ShiftOneLabs\LaravelCascadeDeletes\CascadesDeletes;

/**
 * @property int $id
 * @property int $c_id
 * @property int $sc_id
 * @property string $name
 * @property float $price
 * @property Category $category
 * @property SubCategory $subCategory
 */
class Course extends Model
{
    public $timestamps = false;

    /**
     * Cascade On Delete.
     */
    use CascadesDeletes;
    protected $cascadeDeletes = ['media','files','description','statuses', 'carts', 'comments'];
 
    /**
     * @var array
     */
    protected $fillable = ['name', 'price', 'category_id', 'subCategory_id'];

    /*
     * Get all of the course's image.
     */
    public function carts() {
        return $this->hasMany('App\Models\Cart');
    }

    /*
     * Get all of the course's files.
     */
    public function files() {
        return $this->hasMany('App\Models\File');
    }


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
    public function subCategory()
    {
        return $this->belongsTo('App\Models\SubCategory', 'subCategory_id');
    }

    /*
     * Get all of the course's media.
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
