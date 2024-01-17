<?php

use App\Http\Controllers\StaffsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\AdherentController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DepotController;
use App\Http\Controllers\TourneeController;
use App\Http\Middleware\StaffsMiddleware;
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



//-------route combine--------

// Route home
Route::get('/', [IndexController::class, 'home'])->name('home');
Route::get('/presentation', [IndexController::class, 'about'])->name('about');
Route::get('/faq', [IndexController::class, 'faq'])->name('faq');
Route::get('/contact', [IndexController::class, 'contact'])->name('contact');

// Route products
Route::get('/produits', [ProductController::class, 'index'])->name('products.index');


// Route subscription
Route::get('/abonnement', [SubscriptionController::class, 'subscription'])->name('subscription');
Route::post('/abonnement', [SubscriptionController::class, 'subscription'])->name('subscription.add');

//------- Route Adherents --------//

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', [AdherentController::class, 'dashboard'])->name('dashboard');
    Route::get('/compte', [AdherentController::class, 'account'])->name('dashboard.account');
    Route::get('/boutique', [AdherentController::class, 'shop'])->name('dashboard.shop');
    Route::get('/panier', [CartController::class, 'displayCart'])->name('dashboard.cart');
    Route::get('/calendrier', [AdherentController::class, 'calendar'])->name('dashboard.calendar');

    Route::get('/adhesion', [SubscriptionController::class, 'membership'])->name('dashboard.membership');
    Route::post('/adhesion', [SubscriptionController::class, 'membership'])->name('dashboard.membership.add');

    Route::get('/historique', [AdherentController::class, 'history'])->name('dashboard.history');

    Route::post('/update', [AdherentController::class, 'update'])->name('adherents.update');
    Route::post('/update-photo', [AdherentController::class, 'updatePhoto'])->name('adherents.update.photo');
    Route::post('/delete-photo', [AdherentController::class, 'deletePhoto'])->name('adherents.delete.photo');

});



//-------- Route Admin --------//

Route::middleware(StaffsMiddleware::class)->group(function () {
    Route::get('staffs/panel', [StaffsController::class, 'panel'])->name('staffs.panel');
    Route::get('staffs/compte', [StaffsController::class, 'account'])->name('staffs.account');
    Route::post('staffs/compte', [StaffsController::class, 'update'])->name('staffs.update');

    Route::get('staffs/adherents', [StaffsController::class, 'adherents'])->name('staffs.adherents');
    Route::get('staffs/adherents/{id}', [StaffsController::class, 'adherent'])->name('staffs.adherent');
    Route::post('staffs/adherents/{id}/edit', [StaffsController::class, 'updateAdherent'])->name('staffs.adherent.update');

    Route::delete('staffs/adherents/{id}/delete', [StaffsController::class, 'deleteAdherent'])->name('staffs.adherent.delete');
    Route::post('staffs/adherents/{id}/delete/photo', [StaffsController::class, 'deletePhotoAdherent'])->name('staffs.adherent.delete.photo');

    Route::get('staffs/calendriers', [StaffsController::class, 'calendars'])->name('staffs.calendars');
    Route::get('staffs/calendriers/{structures_id}', [CalendarController::class, 'calendar'])->name('staffs.calendar');
    Route::get('staffs/calendrier/{structures_id}/edit', [CalendarController::class, 'editCalendar'])->name('staffs.calendar.edit');
    Route::post('staffs/calendrier/livraison/edit', [CalendarController::class, 'updateLivraison'])->name('staffs.livraison.update');
    Route::post('staffs/calendrier/livraison/delete', [CalendarController::class, 'deleteLivraison'])->name('staffs.livraison.delete');
    Route::post('staffs/calendrier/livraison/store', [CalendarController::class, 'storeLivraison'])->name('staffs.livraison.store');
    Route::post('staffs/calendrier/livraison/generer', [CalendarController::class, 'genererLivraison'])->name('staffs.livraison.generer');

    Route::get('staffs/depots', [DepotController::class, 'depots'])->name('staffs.depots');
    Route::get('staffs/depots/{structures_id}', [DepotController::class, 'depot'])->name('staffs.depot');
    Route::post('staffs/depots/edit', [DepotController::class, 'updateDepot'])->name('staffs.depot.update');
    Route::post('staffs/depots/delete', [DepotController::class, 'deleteDepot'])->name('staffs.depot.delete');
    Route::post('staffs/depots/store', [DepotController::class, 'storeDepot'])->name('staffs.depot.store');

    Route::get('staffs/tournees', [TourneeController::class, 'tournees'])->name('staffs.tournees');
    Route::get('staffs/tournees/{structures_id}', [TourneeController::class, 'tournee'])->name('staffs.tournee');
    Route::get('staffs/tournees/{structures_id}/edit/{tournee_id}', [TourneeController::class, 'editTournee'])->name('staffs.tournee.edit');
    Route::post('staffs/tournees/edit', [TourneeController::class, 'updateTournee'])->name('staffs.tournee.update');

});


//route setting
Route::get('/parametre', [StaffsController::class, 'account'])->name('account');

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




require __DIR__.'/auth.php';
