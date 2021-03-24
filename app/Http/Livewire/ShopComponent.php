<?php

namespace App\Http\Livewire;
// namespace App\Models;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;
use App\Models\Category;


class ShopComponent extends Component
{   
    public $sorting;
    public $pagesize;

    public $min_price;
    public $max_price;

    public function mount(){
        $this->sorting="default";
        $this->pagesize= 12;

        $this->min_price = 1;
        $this->max_price = 1000;    
    }
    public function store($product_id,$product_name,$product_price){
        Cart::instance('cart')->add($product_id,$product_name,1,$product_price)->associate('App\Models\Product');
        // here 1 is product quantity.
        // lets add the message inside the session. and inside the flush method lets pass thekey named as success key.
        session()->flash('success_message','Item added in Cart');
        return redirect()->route('product.cart');
    }

    public function addToWishlist($product_id,$product_name,$product_price)
    {
        Cart::instance('wishlist')->add($product_id,$product_name,1,$product_price)->associate('App\Models\Product');
        $this->emitTo('wishlist-count-component','refreshComponent');
    }

    use WithPagination;
    public function render()
    {  
        if($this->sorting=='date')
        {
            $products = Product::WhereBetween('regular_price',[$this->min_price,$this->max_price])->orderBy('created_at','DESC')->paginate($this->pagesize);
        }
        else if($this->sorting=="price"){
            $products = Product::WhereBetween('regular_price',[$this->min_price,$this->max_price])->orderBy('regular_price','ASC')->paginate($this->pagesize);
        }
        else if($this->sorting=="price-desc"){
            $products = Product::WhereBetween('regular_price',[$this->min_price,$this->max_price])->orderBy('regular_price','DESC')->paginate($this->pagesize);
        }
        else{
            $products = Product::WhereBetween('regular_price',[$this->min_price,$this->max_price])->paginate($this->pagesize);

        }

        $categories = Category::all();
        // $products = Product::paginate(12);
        // return $products;
        return view('livewire.shop-component',['products'=> $products,'categories' => $categories])->layout("layouts.base");
    }
}
