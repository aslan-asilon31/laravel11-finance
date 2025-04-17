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

class ProductList extends Component
{

    public $products;
    public $users;

    #[Locked] 
    public $id;

    public $count = 0;
    public $name = '';
    public $detail = '';
    public $bookmarks;




    

    use \Mary\Traits\Toast;

    #[Url] 
    public $search = '';
    public $boot = '';
    public $mount = '';

    protected Product $product;


    #[Computed]
    public function product_detail()
    {
        return Product::find($this->userId);
    }

    public function addOne()
    {
        $this->count++;
    }

    public function minusOne()
    {
        $this->count--;

    }

    public function resetCounter()
    {
        $this->count = 0;
    }

    public function mount()
    {  

        $this->mount = (string) str()->uuid();
        $this->bookmarks = [
            ['id_user' => 1, 'id_product' => 1],
            ['id_user' => 3, 'id_product' => 3],
            ['id_user' => 5, 'id_product' => 5],
            ['id_user' => 6, 'id_product' => 6],
            ['id_user' => 8, 'id_product' => 8],
        ];

        $this->bookmarks = 3;

        $this->count = session()->put('count', 0);
        $this->products = Product::where('name', 'LIKE', "%{$this->search}%")->get();
    }




    public function hydrate()
    {  

    }

    public function boot()
    {  
        $this->boot =(string) str()->uuid() ;
        
    }

    public function updating()
    {   
             
    }

    public function updated($property)
    {
        // if ($property === 'search') {
        //     $this->search .= 'updated';
        // }

        if ($property === 'name') {
            $this->name = strtolower($this->name);
        }
    }

    public function updatedName()
    {
        $this->name = strtolower($this->name);
    }

    public function rendering()
    {     

    }
    
    public function rendered()
    {   

    }

    public function dehydrate()
    {      

    }

    public function exception()
    {        
    }



    public function create()
    {
        
    }

    public function store()
    {

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

    public function edit($id)
    {
        $product = Product::findOrFail($this->id);
        $this->name = $product->name;
        $this->detail = $product->detail;
    }

    public function update()
    {
    }

    public function delete()
    {

    }

    public function render()
    {
        return view('livewire.product.product-list')
        ->layout('components.layouts.app_visitor');
    }
}
