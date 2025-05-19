<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;


class Tag extends Model
{
    protected $table = 'tags';
    protected $primaryKey = 'id';

    protected $guarded = [];

    public function comments(): MorphMany
    {
        return $this->MorphMany(Comment::class, 'commentable');
    }

        public function posts(): MorphToMany
    {
        return $this->morphedByMany(Post::class, 'taggable');
    }

        public function videos(): MorphToMany
    {
        return $this->morphedByMany(Video::class, 'taggable');
    }

}
