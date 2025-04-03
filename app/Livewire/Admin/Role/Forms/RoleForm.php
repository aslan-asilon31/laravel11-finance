<?php

namespace App\Livewire\Pengguna\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class RoleForm extends Form
{
  public string|null $nama = null;
  public string|null $surel = null;
  public string|null $sandi = null;
  public string|null $dibuat_oleh = null;
  public string|null $diupdate_oleh = null;
  public string|null $tgl_dibuat = null;
  public string|null $tgl_diupdate = null;

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
