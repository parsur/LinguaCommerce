<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use ShiftOneLabs\LaravelCascadeDeletes\CascadesDeletes;

/**
 * @property int $id
 * @property int $category_id
 * @property string $name
 * @property int $status
 * @property Category $category
 */
class Subcategory extends Model
{
    public $timestamps = false;
    /**
     * Cascade deletes.
     */
    use CascadesDeletes;
    protected $cascadeDeletes = ['courses','statuses'];
    
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'subcategories';

    /**
     * @var array
     */
    protected $fillable = ['name', 'category_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    /**
     * Get all of the subcategory courses.
     */
    public function courses() {
        return $this->hasMany('App\Models\Course', 'subcategory_id');
    }

    /**
     * Get all of the subcategory courses.
     */
    public function articles() {
        return $this->hasMany('App\Models\Article', 'subcategory_id');
    }

    /*
     * Get all of the category status.
     */
    public function statuses() {
        return $this->morphOne('App\Models\Status', 'status');
    }
}
