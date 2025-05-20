<?php

namespace App\Livewire\FromSub\image;

use Livewire\Attributes\Layout;
use App\Models\Image;
use App\Models\Product;
use Rap2hpoutre\FastExcel\FastExcel;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Url;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Pagination\LengthAwarePaginator;
use Mary\Traits\Toast;

class ImageList extends Component
{
    public $title = "image";
    public $url = "/image";

    use WithFileUploads;

    public $count = 1;
    public $giveValue = 5;

    public $photo;
    public $myDate2;
    public $todo = [];


    #[Url(except: '')]
    public ?string $search = '';

    public bool $filterDrawer;

    public array $sortBy = ['column' => 'url', 'direction' => 'desc'];

    #[Url(except: '')]
    public array $filters = [];
    public array $filterForm = [
        'url' => '',
        'imageable_id' => '',
        'imageable_type' => '',
        'created_at' => '',
    ];



    public function increment()
    {
        $this->count++;
        $this->dispatch('sudah-count');
        $this->js('dataIncrement', $this->count);
    }

    public function mount() {}

    #[Computed]
    public function headers(): array
    {
        return [
            ['key' => 'action', 'label' => 'Action', 'sortable' => false, 'class' => 'whitespace-nowrap border-1 border-l-1 border-gray-300 dark:border-gray-600 text-center'],
            ['key' => 'no_urut', 'label' => '#', 'sortable' => false, 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-right'],
            ['key' => 'id', 'label' => 'ID', 'sortBy' => 'id', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-left'],
            ['key' => 'url', 'label' => 'URL', 'sortBy' => 'url', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-left'],
            ['key' => 'imageable_id', 'label' => 'Imageable ID', 'sortBy' => 'imageable_id', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-left'],
            ['key' => 'imageable_type', 'label' => 'Imageable Type', 'sortBy' => 'imageable_type',  'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-left'],
            ['key' => 'created_at', 'label' => 'Created At', 'format' => ['date', 'Y-m-d H:i:s'], 'sortBy' => 'created_at', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-center']
        ];
    }

    #[Computed]
    public function rows(): LengthAwarePaginator
    {

        $query = Image::query();


        $query->when($this->search, fn($q) => $q->where('url', 'like', "%{$this->search}%"))

            ->when(($this->filters['imageable_id'] ?? ''), fn($q) => $q->where('imageable_id', $this->filters['imageable_id']))
            ->when(($this->filters['imageable_type'] ?? ''), fn($q) => $q->where('imageable_type', $this->filters['imageable_id']))
            ->when(($this->filters['created_at'] ?? ''), function ($q) {
                $dateTime = $this->filters['created_at'];
                $dateOnly = substr($dateTime, 0, 10);
                $q->whereDate('created_at', $dateOnly);
            });

        $paginator = $query
            ->orderBy(...array_values($this->sortBy))
            ->paginate(20);

        $start = ($paginator->currentPage() - 1) * $paginator->perPage();

        $paginator->getCollection()->transform(function ($item, $key) use ($start) {
            $item->no_urut = $start + $key + 1;
            return $item;
        });

        return $paginator;
    }

    public function decrement()
    {
        $this->count--;
    }

    public function exportFastExcel()
    {
        $images = Image::all();

        // Export all users
        (new FastExcel($images))->export('images.xlsx');
    }

    public function get($todo)
    {
        return count($todo);
    }

    public function save() {}

    public function render()
    {
        return view('livewire.image.image-list');
    }
}
