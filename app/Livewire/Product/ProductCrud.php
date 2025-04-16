<?php

namespace App\Livewire\Product;
use Livewire\Attributes\Layout;
use App\Models\Product;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Url;
use App\Livewire\Product\Forms\ProductForm;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Computed;

class ProductCrud extends Component
{

    public $products;
    
    #[\Livewire\Attributes\Locked] 
    public $id;

    public $number = 12;

    #[\Livewire\Attributes\Locked]
    public string $readonly = '';

    #[Url] 
    public $search = '';

    public $bookmarks;

    use \Mary\Traits\Toast;


    public ProductForm $form; 

    public function mount()
    {

        $this->bookmarks = [
            ['id_user' => 1, 'id_product' => 1],
            ['id_user' => 3, 'id_product' => 3],
            ['id_user' => 5, 'id_product' => 5],
            ['id_user' => 6, 'id_product' => 6],
            ['id_user' => 8, 'id_product' => 8],
        ];

        if ($this->id && $this->readonly) {
            $this->show();
          } else if ($this->id) {
            $this->edit();
          } else {
            $this->create();
        }

    }


    #[Computed]
    public function getBookmarkedProducts()
    {
        $productIds = array_column($this->bookmarks, 'id_product');
        return in_array($this->id, $productIds);
    }
 

    #[On('product-updated')] 
    public function cekUpdated()
    {
        
    }


    #[On('product-updated')] 
    public function gantiValueNumber()
    {
        $this->number = 20;
        $this->dispatch('value-number-diubah', number:$this->number);

    }

    public function create()
    {
    }

    public function store()
    {
        $this->validate();

        $products = Product::create([
            'name' => $this->name,
            'detail' => $this->detail,
        ]);

        if($products){
            $this->success('Product berhasil ditambahkan');
        }else{
            $this->success('Product gagal ditambahkan');
        }
        
    }

    public function edit()
    {
        $product = Product::findOrFail($this->id);
        $this->form->name = $product->name;
        $this->form->detail = $product->detail;
    }

    public function update()
    {

        $this->validate();

        $product = Product::findOrFail($this->id);

        $updated = $product->update([
            'name' => $this->form->name,
            'detail' => $this->form->detail,
        ]);
    
        if ($updated) {
            $this->success('Product berhasil diupdate');
            $this->dispatch('product-updated');
        } else {
            $this->error('Product gagal diupdate');
        }


    //   $this->redirect('/product');

    }
    
    public function delete()
    {
    }

    public function render()
    {
        return view('livewire.product.product-crud')
        ->layout('components.layouts.app_visitor');
    }
}
