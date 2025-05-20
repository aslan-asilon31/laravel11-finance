<?php

namespace App\Livewire\FromSub\Post;

use Livewire\Attributes\Layout;
use App\Models\Post;
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
use Illuminate\Support\Facades\DB;

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
            ['key' => 'image', 'label' => 'Image', 'sortBy' => 'content',  'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-left'],
            ['key' => 'comment_body', 'label' => 'Comment', 'sortBy' => 'comment_body', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-left'],
            ['key' => 'content', 'label' => 'Content', 'sortBy' => 'content',  'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-left'],
            ['key' => 'tag', 'label' => 'Tag', 'sortBy' => 'content',  'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-left'],
            ['key' => 'created_at', 'label' => 'Created At', 'format' => ['date', 'Y-m-d H:i:s'], 'sortBy' => 'created_at', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-center']
        ];
    }

    #[Computed]
    public function rows(): LengthAwarePaginator
    {



        $query = Post::query();
        $query->when($this->search, fn($q) => $q->where('title', 'like', "%{$this->search}%"))
            ->when(($this->filters['content'] ?? ''), fn($q) => $q->where('content', $this->filters['content']))
            ->when(($this->filters['']->image->url ?? ''), fn($q) => $q->where('url', $this->filters['content']->image->url))
            ->when(($this->filters['']->comments->body ?? ''), fn($q) => $q->where('content', $this->filters['content']->comments->body))
            ->when(($this->filters['']->tags->name ?? ''), fn($q) => $q->where('name', $this->filters['content']->tags->name))
            ->when(($this->filters['created_at'] ?? ''), function ($q) {
                $dateTime = $this->filters['created_at'];
                $dateOnly = substr($dateTime, 0, 10);
                $q->whereDate('created_at', $dateOnly);
            });

        $paginator = $query
            ->orderBy(...array_values($this->sortBy))
            ->paginate(20);
        $paginator->getCollection()->loadMissing(['comments', 'tags', 'image']);

        $start = ($paginator->currentPage() - 1) * $paginator->perPage();
        $paginator->getCollection()->transform(function ($item, $key) use ($start) {
            $item->comment_body = optional($item->comments->first())->body ?? '-';
            $item->tag = optional($item->tags->first())->name ?? '-';
            $item->image = optional($item->image)->url ?? '-';
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
        $posts = Post::all();

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
