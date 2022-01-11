<?php

use App\Mail\ContactUs;
use Illuminate\Support\Facades\Artisan;
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

// if(!file_exists(storage_path('installed'))){
// 	return redirect('/install');
// }



Route::get('contact-us-email', function () {
    $data = ['first_name' => 'Umar', 'last_name' => 'Aslam', 'email' => 'umar@abc.com', 'message' => 'lorem ipsum', 'phone' => ''];
    return (new ContactUs($data))->render();
});
Route::get('test', function () {
    return 'hello';
});

// Route::get('install', function () {

// });

Route::get('clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');

});

Route::any('admin/{all}', function () {
    return view('layouts.admin-master');
})
    ->where(['all' => '.*']);

    // Route::group(['middleware' => ['general','installer']], function () {
    //     Route::get('/', function () {
    //         return redirect('/admin/login');
    //     });
    // });
    Route::get('/hyperpay', 'Web\IndexController@getcall');

Route::group(['middleware' => ['general','cache.headers:private;max_age=3600']], function () {

    Route::get('/', 'Web\IndexController@index');

    Route::get('/product/{id}/{slug}', 'Web\IndexController@productDetail');
    Route::get('search/product', 'Web\IndexController@searchProduct')->name('search-product');
    Route::get('/shop', 'Web\IndexController@shop');
    Route::get('/cart', 'Web\IndexController@cartPage');
    Route::get('/blog-detail/{slug}', 'Web\IndexController@blogDetail');
    Route::get('/blog', 'Web\IndexController@blog');
    Route::get('/checkout', 'Web\IndexController@checkout');
    Route::get('/login', 'Web\IndexController@login');
    Route::get('/register', 'Web\IndexController@register');
    Route::get('/compare', 'Web\IndexController@compare');
    Route::get('/orders', 'Web\IndexController@orders');
    Route::get('/orders/{id}', 'Web\IndexController@ordersDetail');
    Route::get('/profile', 'Web\IndexController@profile');
    Route::get('/thankyou', 'Web\IndexController@thankyou');
    Route::get('/shipping-address', 'Web\IndexController@shippingAddress');

    Route::get('/wishlist', 'Web\IndexController@wishlist');
    Route::get('/change-password', 'Web\IndexController@changePassword');

    Route::get('/page/{slug}', 'Web\IndexController@page');

    Route::get('/privacy', 'Web\IndexController@privacy');
    Route::get('/refund', 'Web\IndexController@refund');
    Route::get('/term', 'Web\IndexController@term');
    Route::get('/contact-us', 'Web\IndexController@contactUs');
    Route::get('/about-us', 'Web\IndexController@aboutUs');

    Route::get('set_currency/{currency}', 'Web\IndexController@setCurrency');

    Route::get('lang/{locale}', 'LocalizationController@index');
    
    Route::get('esewa-verify', 'Web\PaymentVerification@verify')->name('esewa-verify');

});
