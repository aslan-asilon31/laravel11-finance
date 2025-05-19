<?php

namespace App\Livewire\Admin\Accounting\Dashboard;

use Livewire\Component;
use Mary\Traits\Toast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Livewire\Attributes\Url;


class DashboardAnalyticList extends Component
{
    use Toast;
    protected $url = '/dashboard';


    public bool $showDrawer3 = false;

    public array $sortBy = ['column' => 'name', 'direction' => 'asc'];

    public $setLang;
    public $title = "Dashboard";

    public $id;
    public $lang;

    #[Url]
    public $search = '';

    public $dataPenjualan = [
        [
            'kecamatan' => 'Jakarta Selatan',
            'penjualan' => 150000000,
            'produk_terjual' => 300,
            'latitude' => -6.2901, // Koordinat latitude Jakarta Selatan
            'longitude' => 106.8047 // Koordinat longitude Jakarta Selatan
        ],
        [
            'kecamatan' => 'Jakarta Pusat',
            'penjualan' => 120000000,
            'produk_terjual' => 250,
            'latitude' => -6.1751, // Koordinat latitude Jakarta Pusat
            'longitude' => 106.8650 // Koordinat longitude Jakarta Pusat
        ],
        [
            'kecamatan' => 'Jakarta Barat',
            'penjualan' => 100000000,
            'produk_terjual' => 200,
            'latitude' => -6.1751, // Koordinat latitude Jakarta Barat
            'longitude' => 106.7450 // Koordinat longitude Jakarta Barat
        ],
        [
            'kecamatan' => 'Jakarta Utara',
            'penjualan' => 80000000,
            'produk_terjual' => 150,
            'latitude' => -6.1352, // Koordinat latitude Jakarta Utara
            'longitude' => 106.8500 // Koordinat longitude Jakarta Utara
        ],
        [
            'kecamatan' => 'Jakarta Timur',
            'penjualan' => 70000000,
            'produk_terjual' => 100,
            'latitude' => -6.2152, // Koordinat latitude Jakarta Timur
            'longitude' => 106.8832 // Koordinat longitude Jakarta Timur
        ],
    ];


    public $selectedKecamatan = 'Jakarta Selatan';

    public function filter($kecamatan)
    {
        $this->selectedKecamatan = $kecamatan;
        $this->dispatch('update-map', ['kecamatan' => $kecamatan]);
    }


    public function mount()
    {
        App::setLocale(Route::current()->parameter('locale'));
    }

    public function changeLanguage($id)
    {
        $this->lang = $id;
        if (in_array($this->lang, ['en', 'id', 'jp'])) {
            Session::put('locale', $this->lang);

            $this->setLang = $this->lang;

            App::setLocale($this->lang);

            $this->dispatch('change-language', title: $this->lang);
        } else {
            session()->flash('error', 'Invalid language code');
        }
    }


    // Clear filters
    public function clear(): void
    {
        $this->reset();
        $this->success('Filters cleared.', position: 'toast-bottom');
    }

    // Delete action
    public function delete($id): void
    {
        $this->warning("Will delete #$id", 'It is fake.', position: 'toast-bottom');
    }

    // Table headers
    public function headers(): array
    {
        return [
            ['key' => 'id', 'label' => '#', 'class' => 'w-1'],
            ['key' => 'name', 'label' => 'Name', 'class' => 'w-64'],
            ['key' => 'age', 'label' => 'Age', 'class' => 'w-20'],
            ['key' => 'email', 'label' => 'E-mail', 'sortable' => false],
        ];
    }

    /**
     * For demo purpose, this is a static collection.
     *
     * On real projects you do it with Eloquent collections.
     * Please, refer to maryUI docs to see the eloquent examples.
     */
    public function users(): Collection
    {
        return collect([
            ['id' => 1, 'name' => 'Mary', 'email' => 'mary@mary-ui.com', 'age' => 23],
            ['id' => 2, 'name' => 'Giovanna', 'email' => 'giovanna@mary-ui.com', 'age' => 7],
            ['id' => 3, 'name' => 'Marina', 'email' => 'marina@mary-ui.com', 'age' => 5],
        ])
            ->sortBy([[...array_values($this->sortBy)]])
            ->when($this->search, function (Collection $collection) {
                return $collection->filter(fn(array $item) => str($item['name'])->contains($this->search, true));
            });
    }

    public function render()
    {
        return view('livewire.admin.dashboard.dashboard-analytic-list', [
            'users' => $this->users(),
            'headers' => $this->headers()
        ]);
    }
}
