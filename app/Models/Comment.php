<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property int $course_id
 * @property int $article_id
 * @property int $status
 * @property string $idea
 * @property string $created_at
 * @property int $commentable_id
 * @property string $commentable_type
 */
class Comment extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'course_id', 'article_id', 'status', 'idea', 'created_at', 'commentable_id', 'commentable_type'];

}
