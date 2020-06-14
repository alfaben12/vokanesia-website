<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\Invoice;

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

Route::get('/', 'HomeController@index')->name('home');

Route::get('/pages/{slug}','PageController@index')->name('page');

Route::group(['prefix' => 'shop'], function() {
  Route::get('{type}', 'ShopController@index')->name('shop.index');
  Route::get('{type}/{kategori}/{title}', 'ShopController@show')->name('shop.show');
  Route::get('{type}/search', 'ShopController@search')->name('shop.search');
});

Route::group(['prefix' => 'blog'], function() {
  Route::get('/{kategori?}', 'BlogController@index')->name('blog.index');
  Route::get('/{kategori}/{slug}', 'BlogController@show')->name('blog.show');
});

Route::group(['prefix' => 'auth'], function() {
  Route::get('login', 'Customers\Auth\LoginController@index')->name('auth.login');
  Route::post('login/do', 'Customers\Auth\LoginController@do_login')->name('auth.do_login');
  Route::get('register', 'Customers\Auth\RegisterController@index')->name('auth.register');
  Route::post('register/do', 'Customers\Auth\RegisterController@do')->name('auth.do_register');
});

Route::post('payment/notification', 'Customers\PaymentController@notification');
Route::get('payment/{type}/{id}/{invoice}', 'Customers\PaymentController@accept_or_decline_payment');

// Route Customers
Route::group(['as'=>'customers.', 'prefix' => 'customers', 'middleware' => ['auth:web_customers']], function() {
  // Email
  Route::get("email", function () {
    return view("customers.email");
  });
  Route::get("email/tes", function () {
    $user = Auth::user();
    Mail::to($user)->send(new Invoice());
  });

  //Routing Untuk Otp
  Route::get('otp', 'Customers\Auth\OtpController@index')->name('otp');
  Route::post('otp/verief', 'Customers\Auth\OtpController@verify');
  Route::post('send', 'Customers\Auth\OtpController@send');

  Route::post('logout', 'Customers\DashboardController@logout');
  //Customers Yang Sudah No WhatsApp nya Terverifikasi
  Route::group(['middleware' => ['verified_phone']], function() {

    Route::group(['prefix' => 'shop'], function() {
      Route::get('/', 'Customers\ShopController@index')->name('shop.index');
      Route::get('search', 'Customers\ShopController@search');
      Route::get('{type}/{kategori}/{title}', 'Customers\ShopController@show')->name('shop.show');
    });
    Route::resource('settings', 'Customers\PengaturanController');
    Route::resource('cart', 'Customers\CartController');
    Route::resource('checkout', 'Customers\CheckoutController@index');
    Route::post('video/soal', 'Customers\VideoController@soal');
    Route::group(['middleware' => ['produk_guard']], function() {
      Route::get('video/{video}/{prod_id}', 'Customers\VideoController@show')->name('video.show');
      Route::get('video/{video}', 'Customers\VideoController@kelas')->name("video.kelas");
      Route::get('ebook/{pdf}', 'Customers\EbookController@show')->name("pdf.read");
    });
    Route::resource('library', 'Customers\LibraryController');
    Route::get('messages', 'Customers\MessagesController@index')->name('messages.index');
    Route::post('messages/create', 'Customers\MessagesController@create')->name('messages.create');
    Route::post('messages/replay/{id}', 'Customers\MessagesController@replay')->name('messages.replay');
    Route::resource('history', 'Customers\HistoryController');
    Route::resource('certificate', 'Customers\CertificateController');
    Route::post('quiz/pilihjawaban', 'Customers\QuizController@pilihjawaban');
    Route::resource('quiz', 'Customers\QuizController');
    Route::get('dashboard', 'Customers\DashboardController@index')->name('c.dashboards');
    Route::get('invoice/{id}', 'Customers\InvoiceController@index')->name('invoice');
    Route::group(['as' => 'payment.', 'prefix' => 'payment'], function() {
      Route::get('/{invoice}', 'Customers\PaymentController@index');
      Route::post('/confirm/{invoice}', 'Customers\PaymentController@uploadFilePayment');
      Route::post('pay', 'Customers\PaymentController@create');
      Route::post('check_coupon', 'Customers\PaymentController@checkCoupon');
      Route::get('error', 'Customers\PaymentController@error');
      Route::get('success', 'Customers\PaymentController@success');
    });
  });
});


Route::group(['prefix' => 'admin'], function () {
  Voyager::routes();
  Route::group(['middleware' => 'admin.user'], function() {
    Route::get('/', 'Admin\Ecommerce\DashboardController@showDashboard')->name('voyager.dashboard');
    Route::post('video-produks/create/upload-video', 'Admin\VideoController@storeVideo');
    Route::post('video-produks/create/upload-pdf', 'Admin\VideoController@storePdf');
    Route::post('video-produks/create/store', 'Admin\VideoController@storeAssetsCourse')->name('store-course');
    Route::post('check-user-income', 'Admin\CheckUserIncome@check');
    Route::post('reply-ticket/{id}', 'Admin\RelplyTicketController@reply');
    Route::get('resolve-case/{id}', 'Admin\RelplyTicketController@resolve');
  });

});
