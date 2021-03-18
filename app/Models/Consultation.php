<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use ShiftOneLabs\LaravelCascadeDeletes\CascadesDeletes;

/**
 * @property int $id
 * @property int $user_id
 * @property string $phone_number
 * @property User $user
 */
class Consultation extends Model
{
    public $timestamps = false;
    /**
     * @var array
     */
    protected $fillable = ['phone_number', 'user_id'];

    /**
     * Cascade On Delete.
     */
    use CascadesDeletes;
    protected $cascadeDeletes = ['descriptions'];

    /*
     * Get all of the course's descriptions.
    */
    public function descriptions() {
        return $this->morphOne('App\Models\Description','description');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
