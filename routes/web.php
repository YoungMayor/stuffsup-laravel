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

Route::get('/agent/{user}/market', 'SaleController@showUserMarket')->name('user.market');
Route::post('/agent/{user}/market', 'SaleController@getUserSales')->name('user.market');

Route::get('/item_{item}', 'SaleController@showItem')->name('item');
Route::post('/item_{item}', 'SaleController@getItemDetails')->name('item');

Route::post('/item_{item}/offers', 'OfferController@getOffers')->name('item.offers');

Route::get('/item_{item}/offer_{offer}', 'OfferController@showOffer')->name('offer');
Route::post('/item_{item}/offer_{offer}', 'OfferController@getOfferDetails')->name('offer');

Route::post('/item_{item}/offer_{offer}/replies', 'ReplyController@getReplies')->name('offer.replies');

Route::get('/agent/{user}', 'ProfileController@showProfile')->name('profile');
Route::post('/agent/{user}/peek/market', 'ProfileController@peekMarket')->name('profile.peek.market');
Route::post('/agent/{user}/peek/reviews', 'ProfileController@peekReviews')->name('profile.peek.reviews');

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/sell', 'SaleController@showForm')->name('item.create');
    Route::post('/sell', 'SaleController@saveSale')->name('item.create');

    Route::post('/item_{item}/create_offer', 'OfferController@createOffer')->name('offer.create');
    Route::post('/item_{item}/close/{token}', 'SaleController@closeSale')->name('sale.close');

    Route::post('/item_{item}/offer_{offer}/create_reply', 'ReplyController@createReply')->name('reply.create');
    Route::post('/item_{item}/offer_{offer}/close/{token}', 'OfferController@closeOffer')->name('offer.close');

    Route::post('/item_{item}/offer_{offer}/reply_{reply}/edit/{token}', 'ReplyController@editReply')->name('reply.edit');
    Route::post('/item_{item}/offer_{offer}/reply_{reply}/delete/{token}', 'ReplyController@deleteReply')->name('reply.delete');
    Route::post('/item_{item}/offer_{offer}/reply_{reply}/edit/{token}', 'ReplyController@editReply')->name('reply.edit');
    Route::post('/item_{item}/offer_{offer}/reply_{reply}/delete/{token}', 'ReplyController@deleteReply')->name('reply.delete');


    Route::get('/profile', 'ProfileController@selfProfile')->name('profile.self');
    Route::get('/profile/edit', 'ProfileController@showEditor')->name('profile.edit')->middleware('password.confirm');

    Route::post('/profile/edit/{token}/about', 'ProfileEditController@editAbout')->name('profile.edit.about');
    Route::post('/profile/edit/{token}/contact', 'ProfileEditController@editContact')->name('profile.edit.contact');
    Route::post('/profile/edit/{token}/location', 'ProfileEditController@editLocation')->name('profile.edit.location');
    Route::post('/profile/edit/{token}/password', 'ProfileEditController@editPassword')->name('profile.edit.password');

    Route::post('/agent/{user}/create/review', 'ReviewController@createReview')->name('user.create.review');
    Route::post('/agent/{user}/create/report', 'ReportController@createReport')->name('user.create.report');


    Route::post('/api/agent/{user}/notifications/get_count', 'Api\NotificationController@getNotificationCount')->name('api.get_notification_count');
    Route::post('/api/agent/{user}/notifications/get_notification', 'Api\NotificationController@getNotifications')->name('api.get_notifications');
});



Route::fallback(function(){
    return view(RouteServiceProvider::VIEWS['404']);
});
