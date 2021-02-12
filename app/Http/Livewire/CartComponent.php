<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Cart;

class CartComponent extends Component
{
    public function increaseQuantity($rowid){
        $product = Cart::get($rowid);
        $qty = $product->qty + 1;
        Cart::update($rowid,$qty);

    }
    public function decreaseQuantity($rowid){
        $product = Cart::get($rowid);
        $qty = $product->qty - 1;
        Cart::update($rowid,$qty);

    }
    public function render()
    {
        return view('livewire.cart-component')->layout("layouts.base");
    }
}
