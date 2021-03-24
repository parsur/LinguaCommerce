<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use ShiftOneLabs\LaravelCascadeDeletes\CascadesDeletes;

/**
 * @property int $id
 * @property string $name
 * @property int $status
 * @property SubCategory[] $subCategories
 */

class Category extends Model
{
    public $timestamps = false;

    /**
     * Cascade deletes.
     */
    use CascadesDeletes;
    protected $cascadeDeletes = ['articles', 'courses', 'subCategories', 'statuses', 'media'];

    /**
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Get all of the category articles.
     */
    public function articles() {
        return $this->hasMany('App\Models\Article');
    }

    /**
     * Get all of the category courses.
     */
    public function courses() {
        return $this->hasMany('App\Models\Course');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subCategories()
    {
        return $this->hasMany('App\Models\SubCategory');
    }

    /*
     * Get all of the category status.
     */
    public function statuses() {
        return $this->morphOne('App\Models\Status', 'status');
    }

    /*
     * Get all of the category's media.
     */
    public function media() {
        return $this->morphOne('App\Models\Media', 'media');
    }
}
