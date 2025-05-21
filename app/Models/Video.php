<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Video extends Model
{
    use HasFactory, HasUuids;

    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'videos';

    protected $guarded = [];

    public function newUniqueId(): string
    {
        return (string) str()->orderedUuid();
    }



    protected function casts(): array
    {
        return [
            'created_at' => 'datetime: Y-m-d H:i:s',
            'updated_at' => 'datetime: Y-m-d H:i:s',
        ];
    }

    public function comments(): MorphMany
    {
        return $this->MorphMany(Comment::class, 'commentable');
    }
}
