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
    
    use WithPagination;

    public $title = "Product";
    public $url = "/product";

    public $productPaginators;

    #[Locked] 
    public $productId;

    #[Url]
    public ?string $search = '';

    public $modalProduct = false;

    public function mount()
    {

    }

    public function toggleSold($productId)
    {
        $product = Product::find($productId);
        if ($product) {
            $product->is_sold = !$product->is_sold;
            $product->save();
        }
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

    #[Computed]
    public function productCount()
    {
        return Product::count();
    }

    public function render()
    {
        return view('livewire.product.product-list');
    }

}
