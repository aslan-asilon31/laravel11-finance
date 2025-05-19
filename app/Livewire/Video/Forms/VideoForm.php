<?php
 
namespace App\Livewire\Video\Forms;
 
use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Validation\Rule;

class VideoForm extends Form
{

    public string|null $title = null;
    public string|null $url = null;

    public function rules(): array
    {
        return [
            'masterForm.title' => 'required|string',
            'masterForm.url' => 'required|string',
        ];
    }

    public function attributes(): array
    {
      return [
        'masterForm.title' => 'title',
        'masterForm.url' => 'url',
      ];
    }

}