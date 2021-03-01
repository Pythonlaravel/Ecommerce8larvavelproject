<?php

use App\Http\Livewire\Admin\AdminDashboardComponent;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Homecomponent;
use App\Http\Livewire\Shopcomponent;
use App\Http\Livewire\Cartcomponent;
use App\Http\Livewire\CategoryComponent;
use App\Http\Livewire\CheckoutComponent;
use App\Http\Livewire\DetailsComponent;
use App\Http\Livewire\SearchComponent;
use App\Http\Livewire\User\UserDashboardComponent;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/',Homecomponent::class);
Route::get('/shop',Shopcomponent::class);
Route::get('/cart',CartComponent::class)->name('product.cart');
Route::get('/checkout',Checkoutcomponent::class);

Route::get('/product-category/{category_slug}',CategoryComponent::class)->name('product.category');

Route::get('/search', SearchComponent::class)->name('product.search');

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');


// There is a closed issue present in laravel github issues however you can try something like this:
// Route::get('products/{product:slug}', 'ProducController@show')->name('product.show'); // Finds product by slug.
// Route::get('products/{product}', 'ProducController@show')->name('product.show'); // Finds Product by ID (or whatever is defined in getRouteKeyName()).

// route('product.show', $product) -> store.com/product/my-awesome-product
// route('product.show', $product) -> store.com/product/1
Route::get('/product/{slug}', DetailsComponent::class)->name('product.details');


// For user or customer
Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    Route::get('/user/dasboard', UserDashboardComponent::class)->name('user.dashboard');
});

// For Admin
Route::middleware(['auth:sanctum', 'verified', 'authadmin'])->group(function(){
    Route::get('/admin/dasboard', AdminDashboardComponent::class)->name('admin.dashboard');
    Route::get('/admin/categories',AdminCategoryComponent::class)->name('admin.categories');
});
