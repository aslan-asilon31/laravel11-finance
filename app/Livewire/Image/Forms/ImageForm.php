<?php
 
namespace App\Livewire\Image\Forms;
 
use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Validation\Rule;

class ImageForm extends Form
{

    public string|null $url = null;
    public string|null $imageable_id = null;
    public string|null $imageable_url = null;

    public function rules(): array
    {
        return [
            'masterForm.url' => 'required|string',
            'masterForm.imageable_id' => 'required|string',
            'masterForm.imageable_type' => 'required|string',
        ];
    }

    public function attributes(): array
    {
      return [
        'masterForm.url' => 'Url',
        'masterForm.imageable_id' => 'Imageable ID',
        'masterForm.imageable_type' => 'Imageable Type',
      ];
    }

}