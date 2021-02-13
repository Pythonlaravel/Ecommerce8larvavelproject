<?php

namespace App\Http\Livewire;
// namespace App\Models;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;
use App\Models\Category;


class CategoryComponent extends Component
{   
    public $sorting;
    public $pagesize;
    public $category_slug;
    public function mount(){
        $this->sorting="default";
        $this->pagesize= 12;
    }
    public function store($product_id,$product_name,$product_price){
        Cart::add($product_id,$product_name,1,$product_price)->associate('App\Models\Product');
        // here 1 is product quantity.
        // lets add the message inside the session. and inside the flush method lets pass thekey named as success key.
        session()->flash('success_message','Item added in Cart');
        return redirect()->route('product.cart');
    }
    use WithPagination;
    public function render()
    {  
        if($this->sorting=='date')
        {
            $products = Product::orderBy('created_at','DESC')->paginate($this->pagesize);
        }
        else if($this->sorting=="price"){
            $products = Product::orderBy('regular_price','ASC')->paginate($this->pagesize);
        }
        else if($this->sorting=="price-desc"){
            $products = Product::orderBy('regular_price','DESC')->paginate($this->pagesize);
        }
        else{
            $products = Product::paginate($this->pagesize);

        }

        $categories = Category::all();
        // $products = Product::paginate(12);
        //return $products;
        return view('livewire.category-component',['products'=> $products,'categories' => $categories])->layout("layouts.base");
    }
}

