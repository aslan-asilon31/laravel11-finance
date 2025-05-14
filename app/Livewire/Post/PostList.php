<?php

namespace App\Livewire\Post;

use Livewire\Attributes\Layout;
use App\Models\Post;
use App\Models\Product;
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

class PostList extends Component
{
    public $title = "post";
    public $url = "/post";

    use WithFileUploads;

    public $count = 1;
    public $giveValue = 5;

    public $photo;
    public $myDate2;
    public $todo = [];


    #[Url(except: '')]
    public ?string $search = '';

    public bool $filterDrawer;

    public array $sortBy = ['column' => 'title', 'direction' => 'desc'];

    #[Url(except: '')]
    public array $filters = [];
    public array $filterForm = [
        'title' => '',
        'title' => '',
        'content' => '',
        'is_activated' => '',
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
            ['key' => 'comment_body', 'label' => 'Comment', 'sortBy' => 'comment_body', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-left'],
            ['key' => 'content', 'label' => 'Content', 'sortBy' => 'content',  'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-left'],
            ['key' => 'created_at', 'label' => 'Created At', 'format' => ['date', 'Y-m-d H:i:s'], 'sortBy' => 'created_at', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-center']
        ];
    }

    #[Computed]
    public function rows(): LengthAwarePaginator
    {

        $query = Post::query();


        $query->when($this->search, fn($q) => $q->where('title', 'like', "%{$this->search}%"))

            ->when(($this->filters['content'] ?? ''), fn($q) => $q->where('content', $this->filters['content']))
            ->when(($this->filters['']->comments->body ?? ''), fn($q) => $q->where('content', $this->filters['content']->comments->body))
            ->when(($this->filters['created_at'] ?? ''), function ($q) {
                $dateTime = $this->filters['created_at'];
                $dateOnly = substr($dateTime, 0, 10);
                $q->whereDate('created_at', $dateOnly);
            });

        $paginator = $query
            ->with('comments')
            ->orderBy(...array_values($this->sortBy))
            ->paginate(20);

        $start = ($paginator->currentPage() - 1) * $paginator->perPage();

        $paginator->getCollection()->transform(function ($item, $key) use ($start) {
            $item->comment_body = optional($item->comments->first())->body ?? '-';
            $item->no_urut = $start + $key + 1;
            return $item;
        });

        return $paginator;
    }

    public function decrement()
    {
        $this->count--;
    }

    public function get($todo)
    {
        return count($todo);
    }


    public function save() {}

    public function render()
    {
        return view('livewire.post.post-list')
            ->layout('components.layouts.app_visitor');
    }
}
