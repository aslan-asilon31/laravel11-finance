<?php

namespace App\Livewire\Admin\Finance\Dashboard;

use Livewire\Component;
use App\Models\Module;
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
    public $masterModule = 'Accounting';
    public $listMenu;

    public function mount() {}


    public function menuList()
    {
        $allMenus = $this->getSidebarMenu();

        $menus = $allMenus['Accounting'];

        return $menus;
    }


    public function render()
    {
        return view('livewire.admin.dashboard.dashboard-list');
    }
}
