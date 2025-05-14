<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Video extends Model
{
    protected $table = 'videos';
    protected $primaryKey = 'id';

    protected $guarded = [];

    public function comments(): MorphMany
    {
        return $this->MorphMany(Comment::class, 'commentable');
    }
}
