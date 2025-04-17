<?php

namespace App\Livewire\Product;
use Livewire\Attributes\Layout;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Url;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class ProductList extends Component
{
    /*
    Tampilkan data product dari database  menggunakan
    1. Computed Property
    2. Pagination
    */
    
    
    use WithPagination;

    // public $products;
    public $productPaginators;

    #[Locked] 
    public $productId;

    #[Url]
    public ?string $search = '';

    public $modalProduct = false;

    public function mount()
    {

    }

    public function openModal($id)
    {
        $this->productId = $id;
        $this->modalProduct = true;
    }

    #[Computed]
    public function products()
    {
        return Product::where('name', 'LIKE', "%{$this->search}%")->paginate(5);
    }

    #[Computed]
    public function product()
    {
        return Product::find($this->productId);
    }

    public function render()
    {
        return view('livewire.product.product-list')
        ->layout('components.layouts.app_visitor');
    }

}
