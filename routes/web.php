<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [\App\Http\Controllers\Redirect::class, 'index'])->name("welcome");

Route::get('/dashboard', [\App\Http\Controllers\Redirect::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post("/product-add", [\App\Http\Controllers\ProductsController::class, 'create']);
Route::get("/product/{product_name}", [\App\Http\Controllers\Redirect::class, 'certainProduct']);

Route::prefix("cart")->group(function() {
    Route::post("/delete", [\App\Http\Controllers\CartController::class, "deleteFromCart"]);
    Route::get("/", [\App\Http\Controllers\Redirect::class, 'toCart'])->name("cart");
    Route::get("/add-to-cart/{name}", [\App\Http\Controllers\CartController::class, 'addToCart']);
    Route::post("/checkout", [\App\Http\Controllers\OrderController::class, "checkoutStripe"]);
});

Route::get("/succes", [\App\Http\Controllers\OrderController::class, "succes"])->name("checkout.succes");
Route::get("/cancel", [\App\Http\Controllers\OrderController::class, "cancel"])->name("checkout.cancel");

Route::prefix("/reviews")->group(function() {
    Route::post("add/{id}", [\App\Http\Controllers\ReviewController::class, "create"]);
});
Route::prefix("/event")->group(function() {
   Route::post("add", [\App\Http\Controllers\EventController::class, "create"]);
});
require __DIR__.'/auth.php';
