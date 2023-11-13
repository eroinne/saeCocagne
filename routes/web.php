<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\UserController;
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
    return view('index');
});


//-------route combine--------

// Route home
Route::get('/', [IndexController::class, 'home'])->name('home');
Route::get('/presentation', [IndexController::class, 'about'])->name('about');
Route::get('/faq', [IndexController::class, 'faq'])->name('faq');
Route::get('/contact', [IndexController::class, 'contact'])->name('contact');

// Route products
Route::get('/produits', [ProductController::class, 'index'])->name('products.index');

// Route auth
Route::get('/connexion', [AuthController::class, 'login'])->name('login');
Route::post('/connexion', [AuthController::class, 'authenticate'])->name('login.authenticate');
Route::get('/inscription', [AuthController::class, 'register'])->name('register');
Route::post('/inscription/cree', [AuthController::class, 'create'])->name('register.add');


// Route subscription
Route::get('/abonnement', [SubscriptionController::class, 'subscription'])->name('subscription');
Route::post('/abonnement', [SubscriptionController::class, 'subscription'])->name('subscription.add');

//------- Route User --------//

//TODO: Middleware

//route setting
Route::get('/parametre', [UserController::class, 'setting'])->name('dashboard.setting');

//route membership
Route::get('/Adhesion', [SubscriptionController::class, 'membership'])->name('dashboard.membership');
Route::post('/Adhesion', [SubscriptionController::class, 'membership'])->name('dashboard.membership.add');

//route history of order
Route::get('/historique', [UserController::class, 'history'])->name('dashboard.history');
//route calendar of delivery
Route::get('/calendrier', [CalendarController::class, 'calendar'])->name('dashboard.calendar');



//--------route  admin--------
//route setting
Route::get('/parametre', [AdminController::class, 'account'])->name('account');

//route visulisation of delivery turn
Route::get('/visualisationDelivery', [DeliveryController::class, 'visualisation'])->name('delivery.visualisation');

//route modification of delivery turn
Route::get('/modificationDelivery', [DeliveryController::class, 'modification'])->name('delivery.modification');
Route::post('/modificationDelivery', [DeliveryController::class, 'modification'])->name('delivery.modification.add');

//route add product
Route::get('/ajouterProduits', [ProductController::class, 'add'])->name('products.add');
Route::post('/ajouterProduits', [ProductController::class, 'add'])->name('products.add.add');

//route delete product
Route::post('/ajouterProduits', [ProductController::class, 'add'])->name('products.delete');

//route modification of product
Route::post('/modificationProduits', [ProductController::class, 'modification'])->name('products.modification');
//route summary of orders to prepare and deliver
Route::get('/resume', [DeliveryController::class, 'summary'])->name('summary');




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
