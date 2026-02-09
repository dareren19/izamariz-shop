<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckoutController;

// Route::get("/", function () {
//     return view("home");
// });

Route::get("/", [ProductController::class, "home"])->name("home");
Route::get("/products", [ProductController::class, "index"])->name("products.index");
Route::get("/products/{slug}", [ProductController::class , "show"])->name("products.show");

Route::get("/cart", [CartController::class, "index"])-> name("cart.index");
Route::post("/cart/add", [CartController::class, "add"])-> name("cart.add");



Route::patch("/cart/update/{id}", [CartController::class, "update"])-> name("cart.update");
Route::delete("/cart/remove/{id}", [CartController::class, "remove"])-> name("cart.remove");
Route::delete("/cart/clear", [CartController::class, "clear"])-> name("cart.clear");


Route::get("/checkout", [CheckoutController::class, "index"])->name("checkout.index");
Route::post("/checkout", [CheckoutController::class, "process"])->name("checkout.process");
Route::get("/checkout/success", [CheckoutController::class, "success"])->name("checkout.success");
Route::get("/checkout/failed", [CheckoutController::class, "failed"])->name("checkout.failed");
Route::post("/webhook/hitpay", [CheckoutController::class, "webhook"])->name("webhook.hitpay");

Route::fallback(function() {
    return response()->view('error-404', [], 404);
});
// Route::get("/dashboard", function () {
//     return view("dashboard");
// })->middleware(["auth", "verified"])->name("dashboard");

// Route::middleware("auth")->group(function () {
//     Route::get("/profile", [ProfileController::class, "edit"])->name("profile.edit");
//     Route::patch("/profile", [ProfileController::class, "update"])->name("profile.update");
//     Route::delete("/profile", [ProfileController::class, "destroy"])->name("profile.destroy");
// });

require __DIR__."/auth.php";
