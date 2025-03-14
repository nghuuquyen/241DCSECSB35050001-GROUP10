<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use Dedoc\Scramble\Scramble;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

Route::get('/', function () {
    return view('home');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/account/{tab}', [UserController::class, 'showAccountTab'])->name('user.account.tab');
    Route::get('/cart', action: [CartController::class, 'index'])->name('cart.index');
    Route::get('/checkout/{step}', [CheckoutController::class, 'showCheckoutStep'])->name('checkout.step');
    Route::post('/checkout/{step}', [CheckoutController::class, 'processStep'])->name('checkout.process');
    Route::get('/order-details/{orderId}', [CheckoutController::class, 'show'])->name('order.details');
    

});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/product/{product}', [DetailController::class, 'show'])->name('detail');
Route::get('/about', [AboutController::class, 'index'])->name('about');





// IN THE FUTURE, UPON DEPLOYMENT, CHANGE THIS FOR SCRAMBLE
Route::domain('docs.example.com')->group(function () {
    Scramble::registerUiRoute('api');
    Scramble::registerJsonSpecificationRoute('api.json');
});

Route::get('/test-sentry', function () {
    throw new Exception('Testing Sentry...');
});
require __DIR__ . '/auth.php';