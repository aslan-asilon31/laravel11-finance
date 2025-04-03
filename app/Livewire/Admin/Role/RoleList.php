<?php

namespace App\Livewire\Admin\Role;

use Livewire\Component;

class RoleList extends Component
{
    public $title = "Role";
    public $url = "role";


    public function render()
    {
        return view('livewire.admin.role.role-list')->title($this->title);
    }
}
