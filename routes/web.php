<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
// Admin
use App\Http\Controllers\admin\DashBoardController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\ProductController;
// Client
use App\Http\Controllers\client\ClientController;
use App\Http\Controllers\client\HomeController;
use App\Http\Controllers\client\OrderController;
use App\Http\Controllers\client\ProductBrandController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// CLIENT
// Route::middleware('auth')->group(function (){
//     Route::get('/',[HomeController::class, 'index']);
//     Route::get('/productDetail/{slug}',[HomeController::class, 'ProductDetail']);
// });

Route::get('/',[HomeController::class, 'index']);
Route::get('/chi-tiet-san-pham/{slug}',[HomeController::class, 'ProductDetail']);
Route::get('/thuong-hieu/{slug}',[ClientController::class, 'ProductBrand']);
Route::get('/shop',[ClientController::class, 'Allproduct']);
Route::get('/gio-hang',[OrderController::class, 'Cart']);
Route::get('/deletecart',[OrderController::class, 'deletcart']);
Route::get('/them-gio-hang/{id}',[OrderController::class, 'AddToCart']);
Route::get('/checkout',[OrderController::class,'checkout']);
Route::post('/addOrder',[OrderController::class, 'paypost']);
Route::post('/create_payment',[OrderController::class, 'create_payment']);
Route::get('/vnp_ReturnUrl',[OrderController::class, 'vnp_ReturnUrl'])->name('vnpay_return');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
 // Admin
Route::middleware('authAdmin')->group(function () {
// Admin Brand
Route::get('/admin/index',[DashBoardController::class, 'index']);
Route::get('/admin/brand/index',[BrandController::class, 'index']);
Route::get('/admin/brand/create',[BrandController::class, 'create']);
Route::post('/admin/brand/created',[BrandController::class, 'store']);
Route::get('/admin/brand/edit/{id}',[BrandController::class, 'edit']);
Route::post('/admin/brand/update/{id}',[BrandController::class, 'update']);
Route::get('/admin/brand/delete/{id}',[BrandController::class, 'delete']);

// ADMIN CATEGORY
Route::get('/admin/category/index',[CategoryController::class, 'index']);
Route::get('/admin/category/create',[CategoryController::class, 'create']);
Route::post('/admin/category/store',[CategoryController::class, 'store']);
Route::get('/admin/category/edit/{id}',[CategoryController::class, 'edit']);
Route::post('/admin/category/update/{id}',[CategoryController::class, 'update']);
Route::get('/admin/category/delete/{id}',[CategoryController::class, 'delete']);

// ADMIN PRODUCTS
Route::get('/admin/product/index',[ProductController::class, 'index']);
Route::get('/admin/product/create',[ProductController::class, 'create']);
Route::post('/admin/product/store',[ProductController::class, 'store']);
Route::get('/admin/product/edit/{id}',[ProductController::class, 'edit']);
Route::post('/admin/product/update/{id}',[ProductController::class, 'update']);
Route::get('/admin/product/delete/{id}',[ProductController::class, 'destroy']);
});

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
