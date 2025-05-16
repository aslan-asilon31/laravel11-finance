<?php

namespace App\Livewire\Admin\Company;

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\Company;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;
use Mary\Traits\Toast;
use App\Exports\CustomersExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class CompanyList extends Component
{

    public string $title = "Company";
    public string $url = "/company";

    #[\Livewire\Attributes\Locked]
    public $id;

    use Toast;
    use WithPagination;

    #[Url(except: '')]
    public ?string $search = '';

    public bool $filterDrawer;
    public $exportFilter;

    public array $sortBy = ['column' => 'name', 'direction' => 'desc'];

    #[Url(except: '')]
    public array $filters = [];
    public array $filterForm = [
        'name' => '',
        'desc' => '',
        'created_at' => '',
        'updated_at' => '',
    ];


    public function mount() {}

    #[Computed]
    public function headers(): array
    {
        return [
            ['key' => 'action', 'label' => 'Action', 'sortable' => false, 'class' => 'whitespace-nowrap border-1 border-l-1 border-gray-300 dark:border-gray-600 text-center'],
            ['key' => 'no_urut', 'label' => '#', 'sortable' => false, 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-right'],
            ['key' => 'id', 'label' => 'ID', 'sortBy' => 'id', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-left'],
            ['key' => 'name', 'label' => 'First Name', 'sortBy' => 'name', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-left'],
            ['key' => 'desc', 'label' => 'Last Name', 'sortBy' => 'desc', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-left'],
            ['key' => 'created_at', 'label' => 'Created At', 'format' => ['date', 'Y-m-d H:i:s'], 'sortBy' => 'created_at', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-center'],
            ['key' => 'updated_at', 'label' => 'Updated At', 'sortBy' => 'updated_at', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-right'],
        ];
    }



    #[Computed]
    public function rows(): LengthAwarePaginator
    {

        $query = Company::query();

        $query->when($this->search, fn($q) => $q->where('name', 'like', "%{$this->search}%"))
            ->when(($this->filters['desc'] ?? ''), fn($q) => $q->where('desc', 'like', "%{$this->filters['desc']}%"))
            ->when(($this->filters['created_at'] ?? ''), function ($q) {
                $dateTime = $this->filters['created_at'];
                $dateOnly = substr($dateTime, 0, 10);
                $q->whereDate('created_at', $dateOnly);
            })
            ->when(($this->filters['updated_at'] ?? ''), function ($q) {
                $dateTime = $this->filters['updated_at'];
                $dateOnly = substr($dateTime, 0, 10);
                $q->whereDate('updated_at', $dateOnly);
            });

        $this->exportFilter = $query->get();

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

    public function filter()
    {
        $validatedFilters = $this->validate(
            [
                'filterForm.name' => 'nullable|string',
                'filterForm.desc' => 'nullable|string',
                'filterForm.created_at' => 'nullable|string',
                'filterForm.updated_at' => 'nullable|string',
            ],
            [],
            [
                'filterForm.name' => 'Name',
                'filterForm.desc' => 'Last Name',
                'filterForm.created_at' => 'Created At',
                'filterForm.updated_at' => 'Updated At',
            ]
        )['filterForm'];



        $this->filters = collect($validatedFilters)->reject(fn($value) => $value === '')->toArray();
        $this->success('Filter Result');
        $this->filterDrawer = false;
    }


    // public function export()
    // {
    //     $timestamp = Carbon::now()->format('Ymd-His');
    //     return Excel::download(new CustomersExport($this->exportFilter), 'customers-' . $timestamp . '.xlsx');
    // }



    public function render()
    {
        return view('livewire.admin.company.company-list')
            ->title($this->title);
    }
}
