<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//route api were admin connexions needed
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    //group structures routes
    Route::prefix('structures')->group(function () {
        Route::get('/', [\App\Http\Controllers\Api\StructuresController::class, 'index'])->name('index');
        Route::post('/', [\App\Http\Controllers\Api\StructuresController::class, 'store'])->name('store')->middleware('auth:sanctum');
        Route::get('/{structure}', [\App\Http\Controllers\Api\StructuresController::class, 'show'])->name('show');
        Route::put('/{structure}', [\App\Http\Controllers\Api\StructuresController::class, 'update'])->name('update')->middleware('auth:sanctum');
        Route::delete('/{structure}', [\App\Http\Controllers\Api\StructuresController::class, 'delete'])->name('delete')->middleware('auth:sanctum');
    });

    //group adherent routes
    Route::prefix('adherents')->group(function () {
        Route::get('/', [\App\Http\Controllers\Api\AdherentController::class, 'index'])->name('index');
        Route::post('/', [\App\Http\Controllers\Api\AdherentController::class, 'store'])->name('store')->middleware('auth:sanctum');
        Route::get('/{adherent}', [\App\Http\Controllers\Api\AdherentController::class, 'show'])->name('show');
        Route::put('/{adherent}', [\App\Http\Controllers\Api\AdherentController::class, 'update'])->name('update')->middleware('auth:sanctum');
        Route::delete('/{adherent}', [\App\Http\Controllers\Api\AdherentController::class, 'delete'])->name('delete')->middleware('auth:sanctum');
    });

    //group delivery routes
    Route::prefix('livraisons')->group(function () {
        Route::get('/', [\App\Http\Controllers\Api\DeliveryController::class, 'index'])->name('index');
        Route::post('/', [\App\Http\Controllers\Api\DeliveryController::class, 'store'])->name('store')->middleware('auth:sanctum');
        Route::get('/{livraisons}', [\App\Http\Controllers\Api\DeliveryController::class, 'show'])->name('show');
        Route::put('/{livraisons}', [\App\Http\Controllers\Api\DeliveryController::class, 'update'])->name('update')->middleware('auth:sanctum');
        Route::delete('/{livraisons}', [\App\Http\Controllers\Api\DeliveryController::class, 'delete'])->name('delete')->middleware('auth:sanctum');
    });

    //group product routes
    Route::prefix('products')->group(function () {
        Route::get('/', [\App\Http\Controllers\Api\ProductController::class, 'index'])->name('index');
        Route::post('/', [\App\Http\Controllers\Api\ProductController::class, 'store'])->name('store')->middleware('auth:sanctum');
        Route::get('/{product}', [\App\Http\Controllers\Api\ProductController::class, 'show'])->name('show');
        Route::put('/{product}', [\App\Http\Controllers\Api\ProductController::class, 'update'])->name('update')->middleware('auth:sanctum');
        Route::delete('/{product}', [\App\Http\Controllers\Api\ProductController::class, 'delete'])->name('delete')->middleware('auth:sanctum');
    });

    //group staffs routes
    Route::prefix('staffs')->group(function () {
        Route::get('/', [\App\Http\Controllers\Api\StaffsController::class, 'index'])->name('index');
        Route::post('/', [\App\Http\Controllers\Api\StaffsController::class, 'store'])->name('store')->middleware('auth:sanctum');
        Route::get('/{staffs}', [\App\Http\Controllers\Api\StaffsController::class, 'show'])->name('show');
        Route::put('/{staffs}', [\App\Http\Controllers\Api\StaffsController::class, 'update'])->name('update')->middleware('auth:sanctum');
        Route::delete('/{staffs}', [\App\Http\Controllers\Api\StaffsController::class, 'delete'])->name('delete')->middleware('auth:sanctum');
    });


    //group subscription routes
    Route::prefix('abonnement')->group(function () {
        Route::get('/', [\App\Http\Controllers\Api\SubscriptionController::class, 'index'])->name('index');
        Route::post('/', [\App\Http\Controllers\Api\SubscriptionController::class, 'store'])->name('store')->middleware('auth:sanctum');
        Route::get('/{abonnement}', [\App\Http\Controllers\Api\SubscriptionController::class, 'show'])->name('show');
        Route::put('/{abonnement}', [\App\Http\Controllers\Api\SubscriptionController::class, 'update'])->name('update')->middleware('auth:sanctum');
        Route::delete('/{abonnement}', [\App\Http\Controllers\Api\SubscriptionController::class, 'delete'])->name('delete')->middleware('auth:sanctum');
    });

    //group cart routes
    Route::prefix('panier')->group(function () {
        Route::get('/', [\App\Http\Controllers\Api\CartController::class, 'index'])->name('index');
        Route::post('/', [\App\Http\Controllers\Api\CartController::class, 'store'])->name('store')->middleware('auth:sanctum');
        Route::get('/{panier}', [\App\Http\Controllers\Api\CartController::class, 'show'])->name('show');
        Route::put('/{panier}', [\App\Http\Controllers\Api\CartController::class, 'update'])->name('update')->middleware('auth:sanctum');
        Route::delete('/{panier}', [\App\Http\Controllers\Api\CartController::class, 'delete'])->name('delete')->middleware('auth:sanctum');
    });

    //group calendar routes
    Route::prefix('calendrier')->group(function () {
        Route::get('/', [\App\Http\Controllers\Api\CalendarController::class, 'index'])->name('index');
        Route::post('/', [\App\Http\Controllers\Api\CalendarController::class, 'store'])->name('store')->middleware('auth:sanctum');
        Route::get('/{calendrier}', [\App\Http\Controllers\Api\CalendarController::class, 'show'])->name('show');
        Route::put('/{calendrier}', [\App\Http\Controllers\Api\CalendarController::class, 'update'])->name('update')->middleware('auth:sanctum');
        Route::delete('/{calendrier}', [\App\Http\Controllers\Api\CalendarController::class, 'delete'])->name('delete')->middleware('auth:sanctum');
    });

    //group Deposit routes
    Route::prefix('depot')->group(function () {
        Route::get('/', [\App\Http\Controllers\Api\DepositoryController::class, 'index'])->name('index');
        Route::post('/', [\App\Http\Controllers\Api\DepositoryController::class, 'store'])->name('store')->middleware('auth:sanctum');
        Route::get('/{depot}', [\App\Http\Controllers\Api\DepositoryController::class, 'show'])->name('show');
        Route::put('/{depot}', [\App\Http\Controllers\Api\DepositoryController::class, 'update'])->name('update')->middleware('auth:sanctum');
        Route::delete('/{depot}', [\App\Http\Controllers\Api\DepositoryController::class, 'delete'])->name('delete')->middleware('auth:sanctum');
    });

    //group order routes
    Route::prefix('commande')->group(function () {
        Route::get('/', [\App\Http\Controllers\Api\CommandeController::class, 'index'])->name('index');
        Route::post('/', [\App\Http\Controllers\Api\CommandeController::class, 'store'])->name('store')->middleware('auth:sanctum');
        Route::get('/{commande}', [\App\Http\Controllers\Api\CommandeController::class, 'show'])->name('show');
        Route::put('/{commande}', [\App\Http\Controllers\Api\CommandeController::class, 'update'])->name('update')->middleware('auth:sanctum');
        Route::delete('/{commande}', [\App\Http\Controllers\Api\CommandeController::class, 'delete'])->name('delete')->middleware('auth:sanctum');
    });

    //group delivery tour routes
    Route::prefix('tourneeLivraison')->group(function () {
        Route::get('/', [\App\Http\Controllers\Api\DeliveryTourController::class, 'index'])->name('index');
        Route::post('/', [\App\Http\Controllers\Api\DeliveryTourController::class, 'store'])->name('store')->middleware('auth:sanctum');
        Route::get('/{tourneeLivraison}', [\App\Http\Controllers\Api\DeliveryTourController::class, 'show'])->name('show');
        Route::put('/{tourneeLivraison}', [\App\Http\Controllers\Api\DeliveryTourController::class, 'update'])->name('update')->middleware('auth:sanctum');
        Route::delete('/{tourneeLivraison}', [\App\Http\Controllers\Api\DeliveryTourController::class, 'delete'])->name('delete')->middleware('auth:sanctum');
    });


    //login route for admin
    Route::post('register',[\App\Http\Controllers\Api\StaffsApiAuthController::class,'register']);
    Route::post('login',[\App\Http\Controllers\Api\StaffsApiAuthController::class,'login']);
    Route::post('logout',[\App\Http\Controllers\Api\StaffsApiAuthController::class,'logout'])->middleware('auth:sanctum');





