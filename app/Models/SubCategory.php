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
class SubCategory extends Model
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
    protected $table = 'subCategories';

    /**
     * @var array
     */
    protected $fillable = ['category_id', 'name', 'status'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    /**
     * Get all of the sub category courses.
     */
    public function courses() {
        return $this->hasMany('App\Models\Course');
    }

    /*
     * Get all of the category status.
     */
    public function statuses() {
        return $this->morphOne('App\Models\Status', 'status');
    }
}
