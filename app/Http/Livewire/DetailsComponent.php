<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Sale;
use Livewire\Component;
use Cart;
class DetailsComponent extends Component
{
    public $slug;

    public $qty;

    public function mount($slug){
        $this->slug = $slug;
        $this->qty = 1; 
    }

    public function store($product_id,$product_name,$product_price){
        Cart::add($product_id,$product_name,$this->qty,$product_price)->associate('App\Models\Product');
        // here 1 is product quantity.
        // lets add the message inside the session. and inside the flush method lets pass thekey named as success key.
        session()->flash('success_message','Item addes in Cart');
        return redirect()->route('product.cart');
    }

    public function increaseQuantity()
    {
        $this->qty++;
    }

    public function decreseQuantity()
    {
        if($this->qty > 1)
        {
            $this->qty--;
        }
    }

    public function render()
    {
        $product = Product::where('slug',$this->slug)->first();

        //return view('livewire.details-component',['product'=>$product])->layout('layouts.base');

        // For making the remainging products dynamic.
        
        $popular_products = Product::inRandomOrder()->limit(4)->get();
        $related_products = Product::where('category_id', $product->category_id)->inRandomOrder()->limit(5)->get();
        $sale = Sale::find(1);
        return view('livewire.details-component', ['product'=>$product, 'popular_products'=>$popular_products, 'related_products'=>$related_products,'sale'=>$sale])->layout('layouts.base');
        
    }
}
