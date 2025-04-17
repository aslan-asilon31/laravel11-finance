<?php
 
namespace App\Livewire\Product\Forms;
 
use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Validation\Rule;
class ProductForm extends Form
{

    public string|null $name = null;
    public string|null $detail = null;

    public function rules(): array
    {
        return [
            'masterForm.name' => 'required|string',
            'masterForm.detail' => 'required|string',
        ];
    }

    public function attributes(): array
    {
      return [
        'masterForm.name' => 'Name',
        'masterForm.detail' => 'Detail',
      ];
    }

}