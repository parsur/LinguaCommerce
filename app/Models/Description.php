<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $description
 * @property string $description_type
 * @property int $description_id
 */
class Description extends Model
{
    public $timestamps = false;
    /**
     * @var array
     */
    protected $fillable = ['description', 'description_type', 'description_id'];


    /**
     * Get The parent description_type model (Course, Article)
     */
    public function describable() {
        return $this->morphTo();
    }

}
