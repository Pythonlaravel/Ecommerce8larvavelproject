<?php

use App\Http\Livewire\Admin\AdminDashboardComponent;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Homecomponent;
use App\Http\Livewire\Shopcomponent;
use App\Http\Livewire\Cartcomponent;
use App\Http\Livewire\CheckoutComponent;
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
Route::get('/cart',Cartcomponent::class);
Route::get('/checkout',Checkoutcomponent::class);




// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');


// For user or customer
Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    Route::get('/user/dasboard', UserDashboardComponent::class)->name('user.dashboard');
});

// For Admin
Route::middleware(['auth:sanctum', 'verified', 'authadmin'])->group(function(){
    Route::get('/admin/dasboard', AdminDashboardComponent::class)->name('admin.dashboard');
});

