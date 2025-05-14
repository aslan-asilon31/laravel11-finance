<?php

namespace App\Livewire\Post;
use Livewire\Attributes\Layout;
use App\Models\Product;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Url;
use App\Livewire\Product\Forms\ProductForm;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Session;

class PostCrud extends Component
{

        
    /*
    Buat CRUD menggunakan
    - Locked Properties
    - URL Query Parameters
    - Forms
    - Validation
    */

    use \Mary\Traits\Toast;


    #[Locked] 
    public $id;

    public ProductForm $masterForm;

    public function mount()
    {
       if($this->id){
        $this->edit();
       }else{
        $this->create();
       }
    }

    public function create()
    {
        $this->masterForm->reset();

    }

    public function store()
    {
        $validatedForm = $this->validate(
            $this->masterForm->rules(),
            [],
            $this->masterForm->attributes()
        )['masterForm'];

        $products = Product::create([
            'name' => $validatedForm['name'],
            'detail' => $validatedForm['detail'],
        ]);

        if($products){
            $this->success('Product berhasil ditambahkan');
            $this->dispatch('product-created');
        }else{
            $this->success('Product gagal ditambahkan');
        }

    }

    public function edit()
    {
        $product = Product::findOrFail($this->id);
        $this->masterForm->name = $product->name;
        $this->masterForm->detail = $product->detail;
    }

    public function update()
    {
        $validatedForm = $this->validate(
            $this->masterForm->rules(),
            [],
            $this->masterForm->attributes()
        )['masterForm'];
        
        $product = Product::findOrFail($this->id);

        $updated = $product->update($validatedForm);
    
        if ($updated) {
            $this->success('Product berhasil diupdate');
            $this->dispatch('product-updated');
        } else {
            $this->error('Product gagal diupdate');
        }

    }

    public function render()
    {
        return view('livewire.product.product-crud')
        ->layout('components.layouts.app_visitor');
    }
}
