<?php

namespace App\Livewire\Admin\HumanResource\Dashboard;

use Livewire\Component;
use App\Models\HumanResource;
use Mary\Traits\Toast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Livewire\Attributes\Url;
use App\Helpers\Sidebar\Traits\WithSidebarMenu;

class DashboardList extends Component
{
    use WithSidebarMenu;
    use Toast;
    public $url = '/dashboard';

    public bool $showDrawer3 = false;

    public array $sortBy = ['column' => 'name', 'direction' => 'asc'];

    public $setLang;
    public $title = "Dashboard";

    public $id;
    public $lang;

    #[Url]
    public $search = '';

    #[\Livewire\Attributes\Locked]
    protected $masterModel = '';

    // public $masterModule = \App\Models\Accounting\Account::class;
    public $masterModule = 'HumanResource';
    public $listMenu;

    public function mount()
    {

        $allMenus = $this->getSidebarMenu();
        $menus = $allMenus['/human-resource'];
    }


    public function menuList()
    {
        return $this->listMenu = \App\Models\Accounting\Account::class::get();
    }


    public function render()
    {
        return view('livewire.admin.dashboard.dashboard-list');
    }
}
