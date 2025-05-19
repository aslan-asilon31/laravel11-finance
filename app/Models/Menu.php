<?php

namespace App\Models;

use Livewire\Component;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Menu extends  Model
{
    use HasFactory;


    protected $guarded = [''];
    protected $table = 'menus';


    public function moduleable(): MorphTo
    {
        return $this->morphTo();
    }
}
