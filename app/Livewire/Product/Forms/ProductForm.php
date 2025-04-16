<?php
 
namespace App\Livewire\Product\Forms;
 
use Livewire\Attributes\Validate;
use Livewire\Form;
 
class ProductForm extends Form
{
    #[Validate('required|min:5')]
    public $name = '';
 
    #[Validate('required|min:5')]
    public $detail = '';
}