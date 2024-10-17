<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\TransactionController;


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

Route::get('/',[HomeController::class,'home'])->name('home');
Route::get('/index',[HomeController::class,'index'])->name('index');
Route::get('/search', [HomeController::class, 'search'])->name('search.results');



Route::get('/category/{id}', [HomeController::class, 'showCategoryProducts'])->name('category.products');
// Route to show new products
Route::get('/new-products', [HomeController::class, 'newProducts'])->name('new.products');
Route::get('/product/{id}', [HomeController::class, 'show'])->name('product.view');
// routes/cart

Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
Route::post('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
Route::get('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');

    // Newsletter Subscription Route
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])
->name('subscribe')
->middleware('auth');  // Ensure only authenticated users can subscribe

// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);
Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);



Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);


Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END



Route::get('/register', [UserAuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [UserAuthController::class, 'register'])->name('register.store');
Route::get('/user/login', [UserAuthController::class, 'showLoginForm'])->name('user.login');
Route::post('/login', [UserAuthController::class, 'login'])->name('login.store');


// Profile routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [UserAuthController::class, 'showProfileForm'])->name('profile');
    Route::put('/profile', [UserAuthController::class, 'updateProfile'])->name('profile.update');
    
    Route::get('/checkout', [CheckoutController::class, 'showCheckout'])->name('checkout');
    Route::post('/checkout/placeorder', [CheckoutController::class, 'placeOrder'])->name('checkout.placeOrder');
    Route::get('/transaction',[TransactionController::class,'transaction'])->name('transaction');
    

 
    Route::post('/user/logout', [UserAuthController::class, 'logout'])->name('user.logout');


   
   
});










// Admin Panel

// Show login form
Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('login');

// Handle login request
Route::post('/admin/login', [AuthController::class, 'login'])->name('login.process');



// Group routes under 'auth' and 'admin' middleware to ensure only admins can access
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin',[AdminController::class,'dashboard'])->name('dashboard');


Route::get('/admin/categories', [AdminController::class, 'categories'])->name('admin.categories');
Route::post('/admin/categories', [AdminController::class, 'createCategory'])->name('admin.categories.create');
Route::get('/admin/categories/delete/{id}', [AdminController::class, 'deleteCategory'])->name('admin.categories.delete');

Route::get('/admin/categories/edit/{id}', [AdminController::class, 'editCategory'])->name('admin.categories.edit');

Route::post('/admin/categories/update/{id}', [AdminController::class, 'updateCategory'])->name('admin.categories.update');
// Show a single category by ID
Route::get('/admin/categories/{id}', [AdminController::class, 'showCategory'])->name('admin.categories.show');

// routes/web.php

// Product Routes
Route::get('/admin/products', [ProductController::class, 'products'])->name('admin.products');
Route::get('/admin/products/create', [ProductController::class, 'createProductForm'])->name('admin.products.create');
Route::post('/admin/products/store', [ProductController::class, 'createProduct'])->name('admin.products.store');
Route::get('/admin/products/edit/{id}', [ProductController::class, 'editProduct'])->name('admin.products.edit');
Route::post('/admin/products/update/{id}', [ProductController::class, 'updateProduct'])->name('admin.products.update');
Route::delete('/admin/products/delete/{id}', [ProductController::class, 'deleteProduct'])->name('admin.products.delete');
Route::get('/admin/products/show/{id}', [ProductController::class, 'showProduct'])->name('admin.products.show');
Route::get('/admin/transactions', [AdminController::class, 'transactionHistory'])->name('admin.transactions');
Route::get('/admin/categories/{id}/products', [AdminController::class, 'showProductsUnderCategory'])->name('productundercategory');
Route::get('/admin/orders', [AdminController::class, 'showOrders'])->name('admin.orders');

Route::get('/admin/user',[AdminController::class,'user'])->name('admin.user');
Route::get('/admin/subscriber',[AdminController::class,'subscriber'])->name('admin.subscriber');


// Handle logout
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('logout');

});
