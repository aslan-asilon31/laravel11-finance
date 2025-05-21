<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    protected $table = 'images';
    protected $primaryKey = 'id';
    use HasFactory, HasUuids;
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

    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }
}
