<?php

use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Exception\HttpException;

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

Route::get('/item_{item}', 'SaleController@showItem')->name('item');
Route::post('/item_{item}', 'SaleController@getItemDetails')->name('item');

Route::post('/item_{item}/offers', 'OfferController@getOffers')->name('item.offers');

Route::get('/item_{item}/offer_{offer}', 'OfferController@showOffer')->name('offer');
Route::post('/item_{item}/offer_{offer}', 'OfferController@getOfferDetails')->name('offer');


Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/sell', 'SaleController@showForm')->name('item.create');
    Route::post('/sell', 'SaleController@saveSale')->name('item.create');

    Route::post('/item_{item}/create_offer', 'OfferController@createOffer')->name('offer.create');

    Route::post('/item_{item}/close/{token}', 'SaleController@closeSale')->name('sale.close');
});


Route::fallback(function(){
    return view(RouteServiceProvider::VIEWS['404']);
});
