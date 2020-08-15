<?php

use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
Auth::routes(['verify' => true]);

Route::get("/", "HomeController")->name("index");
Route::get("/home", 'HomeController@home')->name("home");

Route::get('/market/{type?}', 'SaleController@showMarket')->name('market');
Route::post('/market/{type?}', 'SaleController@getSales')->name('market');

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/sell', 'SaleController@showForm')->name('sell');
    Route::post('/sell', 'SaleController@saveSale')->name('sell');
});


Route::fallback(function(){
    return view(RouteServiceProvider::VIEWS['404']);
});
