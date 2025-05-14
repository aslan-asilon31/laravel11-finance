<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Post extends Model
{
    protected $table = 'posts';
    protected $primaryKey = 'id';

    protected $guarded = [];

    public function comments(): MorphMany
    {
        return $this->MorphMany(Comment::class, 'commentable');
    }
}
