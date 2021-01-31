<?php

namespace App\Http\Livewire;
namespace App\Models;
use Livewire\Component;
use Livewire\WithPagination;

class ShopComponent extends Component
{
    use WithPagination;
    public function render()
    {
        $products = Product::paginate(12);
        return view('Livewire.ShopComponent',['products'=> $products])->layout("layouts.base");
    }
}
