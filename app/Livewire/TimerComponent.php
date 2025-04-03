<?php

namespace App\Livewire;

use Livewire\Component;

class TimerComponent extends Component
{
    public $timerValue;

    public function saveTimer($value)
    {
        $this->timerValue = $value;
        dd($this->timerValue);
        // Simpan timerValue ke database atau lakukan tindakan lain
    }

    public function render()
    {
        return view('livewire.timer-component');
    }
}
