<?php
 
namespace App\Livewire\User1\Forms;
 
use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Validation\Rule;

class UserForm extends Form
{

    public string|null $name = null;
    public string|null $email = null;

    public function rules(): array
    {
        return [
            'masterForm.name' => 'required|string',
            'masterForm.email' => 'required|string',
        ];
    }

    public function attributes(): array
    {
      return [
        'masterForm.name' => 'Name',
        'masterForm.email' => 'Email',
      ];
    }

}