<?php

use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\Client\ClientOrderController;
use App\Http\Controllers\Dashboard\ClientController;
use App\Http\Controllers\Dashboard\OrderController;
use App\Http\Controllers\Dashboard\WelcomeController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\SidiController;
use App\Http\Controllers\Dashboard\CommandeController;
use App\Http\Controllers\Dashboard\BonComandeController;
use App\Http\Controllers\Dashboard\InvoicesController;
use App\Http\Controllers\Dashboard\Client\ClientComandeController;
use App\Http\Controllers\Dashboard\EmployeController;

use Illuminate\Support\Facades\Route;


Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function()
{
	Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function () {

        Route::get('/',[WelcomeController::class,'index'])->name('welcome');
        

        Route::resource('users',UserController::class)->except(['show']);

        Route::resource('categories',CategoryController::class)->except(['show']);

        Route::resource('products',ProductController::class)->except(['show']);

        Route::resource('clients',ClientController::class)->except(['show']);

        Route::resource('employe',EmployeController::class)->except(['show']);


        

        // Route::resource('bon',ClientController::class)->except(['show']);
        
        Route::resource('sidi',SidiController::class)->except(['show']);
        
        Route::resource('clients.orders',ClientOrderController::class)->except(['show']);

        // Route::get('Status_show',[ClientOrderController::class, 'show'])->name('Status_show');



        //Route::resource('invoices',ClientComandeController::class)->except(['show']);


        Route::resource('invoices',InvoicesController::class)->except(['show']);


       // Route::resource('invoices.coma.orders',ClientComandeController::class)->except(['show']);


        //  Route::post('invoices', function(Request $request){
        //       return invoices::create($request->all);
        //  });
        
        // Route::resource('bon.orders',ClientOrderController::class)->except(['show']);
        
        // Route::resource('bon.orders',ClientOrderController::class)->except(['show']);

        Route::resource('orders',OrderController::class);


        Route::get('export_order', [OrderController::class, 'export']);
        Route::get('export_product', [ProductController::class, 'export']);



       // Route::get('invoices/{order}/products', [ClientComandeController::class,'products'])->name('invoices.products');

        Route::get('orders/{order}/products', [OrderController::class,'products'])->name('orders.products');

        Route::get('invoices/{order}/products', [InvoicesController::class,'products'])->name('invoices.products');

        Route::get('employe/{employe}/products', [EmployeController::class,'products'])->name('employe.products');





    });// end route of dashborad


});

    