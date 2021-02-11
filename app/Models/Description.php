<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $description
 * @property string $describable_type
 * @property int $describable_id
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
    public function description() {
        return $this->morphTo();
    }

}
