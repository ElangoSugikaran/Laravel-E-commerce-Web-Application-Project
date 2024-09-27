<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\AdminController;


route::get('/', [HomeController::class,'home']);

route::get('/dashboard', [HomeController::class,'login_home'])->middleware(['auth', 'verified'])->name('dashboard');

route::get('/myorders', [HomeController::class,'myorders'])->middleware(['auth', 'verified']);

route::get('shop', [HomeController::class,'shop'])->middleware(['auth', 'verified']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

route::get('admin/dashboard',[HomeController::class,'index'])->
middleware(['auth','admin']);


// Category route
Route::middleware(['auth', 'admin'])->group(function () {
    route::get('view_category',[AdminController::class,'view_category']);
    route::post('add_category',[AdminController::class,'add_category']);
    route::get('delete_category/{id}',[AdminController::class,'delete_category']);
    route::get('edit_category/{id}',[AdminController::class,'edit_category']);
    route::post('update_category/{id}',[AdminController::class,'update_category']);

});


// Product route
Route::middleware(['auth', 'admin'])->group(function () {
    route::get('view_product',[AdminController::class,'view_product']);
    route::get('add_product',[AdminController::class,'add_product']);
    route::post('insert_product',[AdminController::class,'insert_product']);
    route::get('delete_product/{id}',[AdminController::class,'delete_product']);
    Route::get('edit_product/{id}', [AdminController::class, 'edit_product']);
    Route::post('update_product/{id}', [AdminController::class, 'update_product']);
    Route::get('search_product', [AdminController::class, 'search_product']);

});

// Order route
Route::middleware(['auth', 'admin'])->group(function () {
    route::get('view_orders',[AdminController::class,'view_orders']);
    route::get('on_the_way/{id}',[AdminController::class,'on_the_way']);
    route::get('delivered/{id}',[AdminController::class,'delivered']);
    route::get('print_pdf/{id}',[AdminController::class,'print_pdf']);

});


//home client side
route::get('product_details/{id}',[HomeController::class,'product_details']);

route::get('add_cart/{id}', [HomeController::class, 'add_cart'])->
middleware(['auth','verified']);

route::get('mycart', [HomeController::class,'mycart'])->
middleware(['auth','verified']);

route::get('delete_cart/{id}', [HomeController::class, 'delete_cart'])->
middleware(['auth','verified']);

route::post('confirm_order', [HomeController::class, 'confirm_order'])->
middleware(['auth','verified']);

Route::controller(HomeController::class)->group(function(){

    Route::get('stripe/{value}', 'stripe');

    Route::post('stripe/{value}', 'stripePost')->name('stripe.post');

});
    




