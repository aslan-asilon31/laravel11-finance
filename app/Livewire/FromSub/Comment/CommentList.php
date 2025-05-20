<?php

namespace App\Livewire\FromSub\Comment;

use Livewire\Attributes\Layout;
use App\Models\Comment;
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

class CommentList extends Component
{
    public $title = "comments";
    public $url = "/comments";

    use WithFileUploads;

    public $count = 1;
    public $giveValue = 5;

    public $photo;
    public $myDate2;
    public $todo = [];


    #[Url(except: '')]
    public ?string $search = '';

    public bool $filterDrawer;

    public array $sortBy = ['column' => 'body', 'direction' => 'desc'];

    #[Url(except: '')]
    public array $filters = [];
    public array $filterForm = [
        'commentable_id' => '',
        'commentable_type' => '',
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
            ['key' => 'body', 'label' => 'Body', 'sortBy' => 'body', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-left'],
            ['key' => 'commentable_id', 'label' => 'Commentable ID', 'sortBy' => 'commentable_id',  'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-left'],
            ['key' => 'commentable_type', 'label' => 'Commentable Type', 'sortBy' => 'commentable_type',  'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-left'],
            ['key' => 'created_at', 'label' => 'Created At', 'format' => ['date', 'Y-m-d H:i:s'], 'sortBy' => 'created_at', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-center']
        ];
    }

    #[Computed]
    public function rows(): LengthAwarePaginator
    {

        $query = Comment::query();


        $query->when($this->search, fn($q) => $q->where('body', 'like', "%{$this->search}%"))

            ->when(($this->filters['commentable_id'] ?? ''), fn($q) => $q->where('commentable_id', $this->filters['commentable_id']))
            ->when(($this->filters['commentable_type'] ?? ''), fn($q) => $q->where('commentable_type', $this->filters['commentable_id']))
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
        $posts = Comment::all();

        // Export all users
        (new FastExcel($posts))->export('posts.xlsx');
    }

    public function get($todo)
    {
        return count($todo);
    }

    public function save() {}

    public function render()
    {
        return view('livewire.post.post-list');
    }
}
