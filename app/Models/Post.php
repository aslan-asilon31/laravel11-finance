<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

 
class Post extends Model
{
    protected $table = 'posts';
    protected $primaryKey = 'id';

    protected $guarded = [];

    public function comments(): MorphMany
    {
        return $this->MorphMany(Comment::class, 'commentable');
    }

        public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }


}
