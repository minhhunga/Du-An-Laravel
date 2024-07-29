<?php

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

Route::get('/', function () {
    return view('welcome');
}); 


Route::get('/Frontend/index', [App\Http\Controllers\Frontend\IndexController::class, 'index']);

Route::group(['middleware' => 'memberNotLogin'], function () {

    Route::get('/Frontend/member/register', [App\Http\Controllers\Frontend\MemberController::class, 'register'])->name('Registerr');
    Route::post('/Frontend/member/register', [App\Http\Controllers\Frontend\MemberController::class, 'postRegister'])->name('Registerr');
    Route::get('/Frontend/member/login', [App\Http\Controllers\Frontend\MemberController::class, 'login'])->name('login');
    Route::post('/Frontend/member/login', [App\Http\Controllers\Frontend\MemberController::class, 'postLogin'])->name('Loginn');
    Route::get('/logout', [App\Http\Controllers\Frontend\MemberController::class, 'logout']);
 });

 
Route::group(['middleware' => 'member'], function () {

    Route::get('/Frontend/blog', [App\Http\Controllers\Frontend\BlogController::class, 'blog'])->name('blog.blog');
    Route::get('/Frontend/blog/{id}', [App\Http\Controllers\Frontend\BlogController::class, 'show'])->name('blog.show');
    Route::post('Frontend/blog/rate',[App\Http\Controllers\Frontend\BlogController::class, 'rateBlog'])->name('blog.rate'); 
    Route::post('Frontend/blog/cmt',[App\Http\Controllers\Frontend\BlogController::class, 'saveComment'])->name('blog.cmt'); 

    Route::get('/Frontend/account/update', [App\Http\Controllers\Frontend\AccountController::class, 'index'])->name('account');
    Route::post('/Frontend/account/update', [App\Http\Controllers\Frontend\AccountController::class, 'updateaccount']);

    Route::get('/Frontend/account/my-product', [App\Http\Controllers\Frontend\ProductController::class, 'product'])->name('myproduct');
    Route::get('/Frontend/product/add', [App\Http\Controllers\Frontend\ProductController::class, 'getAdd'])->name('addproduct');
    Route::post('/Frontend/product/add', [App\Http\Controllers\Frontend\ProductController::class, 'postAdd'])->name('addproduct');
    Route::get('/Frontend/product/my-product', [App\Http\Controllers\Frontend\ProductController::class, 'showproduct'])->name('myproduct');

    Route::get('/Frontend/product/edit/{id}', [App\Http\Controllers\Frontend\ProductController::class, 'editproduct']);
    Route::post('/Frontend/product/edit/{id}', [App\Http\Controllers\Frontend\ProductController::class, 'updateproduct'])->name('editproduct');
     Route::get('/Frontend/product/delete/{id}', [App\Http\Controllers\Frontend\ProductController::class, 'deleteProduct']);

    Route::get('/Frontend/product/search', [App\Http\Controllers\Frontend\ProductController::class, 'search'])->name('search'); 
    Route::get('/Frontend/product/search-advanced', [App\Http\Controllers\Frontend\ProductController::class, 'searchAdvanced'])->name('search-advanced'); 
    Route::get('/Frontend/product/search-price', [App\Http\Controllers\Frontend\ProductController::class, 'searchPrice'])->name('search-price'); 

    Route::get('/Frontend/my-product/product-detail/{id}', [App\Http\Controllers\Frontend\IndexController::class, 'showdetail'])->name('product.detail');

    Route::post('/Frontend/Add-cart', [App\Http\Controllers\Frontend\CartController::class, 'addCart'])->name('addcart');
    Route::get('/Frontend/cart-product', [App\Http\Controllers\Frontend\CartController::class, 'cart'])->name('cart.product');
    Route::post('/Frontend/cart-product/update', [App\Http\Controllers\Frontend\CartController::class, 'updateCart'])->name('update-cart');
    Route::post('Frontend/cart-product/delete', [App\Http\Controllers\Frontend\CartController::class, 'deleteCart'])->name('delete-cart');
});

Route::get('/Frontend/cart-product/checkout', [App\Http\Controllers\Frontend\CartController::class, 'checkout'])->name('checkout');
Route::post('/Frontend/cart-product/checkout', [App\Http\Controllers\Frontend\CartController::class, 'postRegister'])->name('Registerr');
Route::get('/Frontend/cart-product/sendemail', [App\Http\Controllers\Frontend\MailController::class, 'index'])->name('sendemail');
 




// frontend/member/login 
// ..


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/bong-da', [App\Http\Controllers\DemoController::class, 'index']);

//  Route::get('/minh_hung', [MinhhungController::class,'index']);
Route::group([
    'middleware' => ['admin']
], function () {

 Route::get('/admin/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);
 Route::get('/admin/profile', [App\Http\Controllers\Admin\UserController::class, 'index']);
 Route::post('/admin/profile', [App\Http\Controllers\Admin\UserController::class, 'updateprofile']);

 Route::get('/admin/country', [App\Http\Controllers\Admin\CountryController::class, 'index'])->name('admin/country');
 Route::get('/admin/country/add', [App\Http\Controllers\Admin\CountryController::class, 'getCountry']);
 Route::post('/admin/country/add', [App\Http\Controllers\Admin\CountryController::class, 'postCountry'])->name('add');
Route::get('/admin/country/delete/{id}', [App\Http\Controllers\Admin\CountryController::class, 'deleteCountry']);

Route::get('/admin/category', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('admin/category');
 Route::get('/admin/category/add', [App\Http\Controllers\Admin\CategoryController::class, 'getCategory']);
 Route::post('/admin/category/add', [App\Http\Controllers\Admin\CategoryController::class, 'postCategory'])->name('add');
Route::get('/admin/category/delete/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'deleteCategory']);

Route::get('/admin/brand', [App\Http\Controllers\Admin\BrandController::class, 'index'])->name('admin/brand');
 Route::get('/admin/brand/add', [App\Http\Controllers\Admin\BrandController::class, 'getBrand']);
 Route::post('/admin/brand/add', [App\Http\Controllers\Admin\BrandController::class, 'postBrand'])->name('add');
Route::get('/admin/brand/delete/{id}', [App\Http\Controllers\Admin\BrandController::class, 'deleteBrand']);

 Route::get('/admin/blog', [App\Http\Controllers\Admin\BlogController::class, 'index'])->name('admin/blog');
 Route::get('/admin/blog/add', [App\Http\Controllers\Admin\BlogController::class, 'getBlog']);
 Route::post('/admin/blog/add', [App\Http\Controllers\Admin\BlogController::class, 'postBlog'])->name('add');

 Route::get('/admin/blog/edit/{id}', [App\Http\Controllers\Admin\BlogController::class, 'editBlog']);
 Route::post('/admin/blog/edit/{id}', [App\Http\Controllers\Admin\BlogController::class, 'updateBlog'])->name('edit');
 Route::get('/admin/blog/delete/{id}', [App\Http\Controllers\Admin\BlogController::class, 'deleteBlog']);
});
 