<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\TransactionController;
use App\Models\History;

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

Route::get('/', function () {
    return view('login');
});

// //idk dibawah buat url2 nyas
// Route::get('/addItem', function () {
//     return view('home');
// });

// Route::get('/home', function () {
//     return view('home');
// });

// Route::get('/login', function () {
//     return view('login');
// });

// Route::get('/register', function () {
//     return view('register');
// });


//yang bawah ini buat login register, masih on work
Route::post('login', [AuthController::class, 
    'login'])->name('login');

    Route::post('register', [AuthController::class, 
    'register'])->name('register');

    Route::post('logout', [AuthController::class, 
    'actionlogout'])->name('logout');

// Login -> Register Register -> login
Route::get('register', [AuthController::class, 
    'index_register'])->name('index_register')
    ;

Route::get('login', [AuthController::class, 
'index_login'])->name('index_login')
;

// Route::get('/profile', [UserController::class, 'index_profile'])->name('profile')->middleware('auth');
// Route::post('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update')->middleware('auth');

//Mavbar
Route::get('/profile', [HomeController::class,'showProfile'])->name('showProfile')->middleware('auth');
Route::get('/profile/edit', [UserController::class, 'editProfile'])->name('editProfile')->middleware('auth');
Route::post('/profile/update', [UserController::class, 'updateProfile'])->name('updateProfile')->middleware('auth');
Route::get('/history', [HistoryController::class, 'showHistory'])->name('showHistory')->middleware('auth');

//Homepage
Route::get('main', [HomeController::class,'index_home'])->name('index_home')->middleware('auth');
Route::get('main/search', [HomeController::class, 'viewPageSearch'])->name('viewPageSearch')->middleware('auth');
Route::get('addItem', [HomeController::class,'index_addItem'])->name('index_addItem')->middleware('auth');
Route::get('/addItem/create', [ItemController::class, 'createProduct'])->name('createProduct')->middleware('auth');
Route::post('/addItem', [ItemController::class, 'insertProduct'])->name('insertProduct')->middleware('auth');

Route::get('/productDetail/{id}', [ItemController::class, 'viewProductDetail'])->name('productDetail')->middleware('auth');
Route::patch('/productDetail/{id}', [ItemController::class, 'updateStock'])->name('updateStock')->middleware('auth');
Route::delete('/productDetail/{id}', [ItemController::class, 'deleteProduct'])->name('deleteProduct')->middleware('auth');

Route::get('/checkout', [CheckoutController::class, 'viewCheckout'])->name('viewCheckout');
Route::patch('/checkout/update-quantity/{id}', [CheckoutController::class, 'updateQuantity'])->name('updateQuantity');
Route::post('/checkout/add/{id}', [CheckoutController::class, 'addToCheckout'])->name('addToCheckout');
Route::get('checkout/search', [CheckoutController::class, 'checkoutviewPageSearch'])->name('checkoutviewPageSearch')->middleware('auth');
Route::delete('/checkout/remove-item/{id}', [CheckoutController::class, 'removeItem'])->name('removeItem');
Route::post('/checkout/process', [CheckoutController::class, 'processCheckout'])->name('processCheckout');

Route::get('/checkouts', [CheckoutController::class, 'viewCheckouts'])->name('viewCheckouts');
Route::get('/checkouts/{id}', [CheckoutController::class, 'checkoutsDetails'])->name('checkoutsDetails');

Route::get('/add-stock', [ItemController::class, 'addStockPage'])->name('addStockPage')->middleware('auth');
Route::post('/add-stock', [ItemController::class, 'processAddStock'])->name('processAddStock')->middleware('auth');
Route::post('/updateStock/{id}', [ItemController::class, 'updateStock'])->name('updateStock');

Route::get('/product/{id}/edit', [ItemController::class, 'editProduct'])->name('editProduct')->middleware('auth');
Route::patch('/product/{id}', [ItemController::class, 'updateProduct'])->name('updateProduct')->middleware('auth');

Route::post('/suppliers/{id}', [UserController::class, 'addSupplier'])->middleware('auth');
Route::delete('/suppliers/{id}', [UserController::class, 'removeSupplier'])->middleware('auth');

// Display the restock page
Route::get('/restock', [ItemController::class, 'showRestockPage'])->name('restockPage');

// Process the restock form
Route::post('/restock', [ItemController::class, 'processRestock'])->name('processRestock');

// Display the transactions page
Route::get('/transactions', [TransactionController::class, 'viewTransactions'])->name('viewTransactions');
Route::get('/transactions/add', [TransactionController::class, 'create'])->name('addTransaction');
Route::post('/transactions/store', [TransactionController::class, 'store'])->name('storeTransaction');

