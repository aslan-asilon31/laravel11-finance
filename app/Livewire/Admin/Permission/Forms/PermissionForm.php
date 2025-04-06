<?php

namespace App\Livewire\Permission\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class PermissionForm extends Form
{
  public string|null $name = null;
  public string|null $guard_name = null;

  public function rules()
  {
      return [
          'name' => 'required|string|max:255',
          'guard_name' => 'required|string|max:255',
      ];
  }

  public function attributes()
  {
      return [
          'name' => 'name',
          'guard_name' => 'guard name',
      ];
  }
}
