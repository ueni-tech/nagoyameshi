<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\Auth\LoginController;
use App\Http\Controllers\Dashboard\RestaurantController;
use App\Http\Controllers\Dashboard\CompanyController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RestaurantController as mainRestaurantController;
use App\Http\Controllers\UserController as mainUserController;
use App\Http\Controllers\SubscriptionController;


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

// Route::get('/', function () {
//     $restaurants = Restaurant::all();
//     return view('index', compact('restaurants'));
// });

Route::get('/terms', function () {
    return view('terms');
})->name('terms');

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->middleware('auth:admins')->name('dashboard.index');

Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login.form');
    Route::post('login', [LoginController::class, 'login'])->name('login');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    Route::resource('categories', CategoryController::class)->middleware('auth:admins');
    Route::resource('restaurants', RestaurantController::class)->middleware('auth:admins');
    Route::get('restaurants/{restaurant}/reviews', [RestaurantController::class, 'reviews'])->middleware('auth:admins')->name('restaurants.reviews');
    Route::get('company', [CompanyController::class, 'index'])->middleware('auth:admins')->name('company.index');
    Route::put('company/{company}', [CompanyController::class, 'update'])->middleware('auth:admins')->name('company.update');
    Route::get('users', [UserController::class, 'index'])->middleware('auth:admins')->name('users.index');
    Route::get('users/{user}', [UserController::class, 'show'])->middleware('auth:admins')->name('users.show');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->middleware('auth:admins')->name('users.destroy');
});

Route::controller(mainRestaurantController::class)->group(function () {
    Route::get('restaurants', 'index')->name('restaurants.index');
    Route::get('restaurants/{restaurant}', 'show')->name('restaurants.show');
    Route::get('restaurants/{restaurant}/favorite', 'favorite')->middleware('auth')->name('restaurants.favorite');
});

Route::get('reservations/create/{restaurant}', [ReservationController::class, 'create'])->middleware(['auth', 'basic'])->name('reservations.create');
Route::post('reservations', [ReservationController::class, 'store'])->middleware('auth')->name('reservations.store');
Route::delete('reservations/{reservation}', [ReservationController::class, 'destroy'])->middleware('auth')->name('reservations.destroy');


Route::get('reviews/{restaurant}', [ReviewController::class, 'index'])->middleware('auth')->name('reviews.index');
Route::get('reviews/create/{restaurant}', [ReviewController::class, 'create'])->middleware('auth')->name('reviews.create');
Route::post('reviews', [ReviewController::class, 'store'])->middleware('auth')->name('reviews.store');
Route::get('reviews/{review}', [ReviewController::class, 'show'])->name('reviews.show');
Route::get('reviews/{review}/edit/{restaurant}', [ReviewController::class, 'edit'])->middleware('auth')->name('reviews.edit');
Route::put('reviews/{review}', [ReviewController::class, 'update'])->middleware('auth')->name('reviews.update');
// Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->middleware(['auth', 'auth:admins'])->name('reviews.destroy');
Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->middleware('auth_or_admin')->name('reviews.destroy');

Route::controller(mainUserController::class)->group(function () {
    Route::get('users/mypage', 'mypage')->middleware('auth')->name('mypage');
    Route::get('users/mypage/edit', 'edit')->middleware('auth')->name('mypage.edit');
    Route::put('users/mypage', 'update')->middleware('auth')->name('mypage.update');
    Route::get('user/mypage/reviews', 'reviews')->middleware('auth')->name('mypage.reviews');
    Route::get('user/mypage/favorite', 'favorite')->middleware('auth')->name('mypage.favorite');
    Route::get('user/mypage/reservations', 'reservations')->middleware('auth')->name('mypage.reservations');
    Route::delete('users/mypage/delete', 'destroy')->middleware('auth')->name('mypage.destroy');
});

Route::controller(SubscriptionController::class)->group(function(){
    Route::get('subscription', 'index')->middleware('auth')->name('subscription');
    Route::post('subscription', 'store')->middleware('auth')->name('subscription.post');
    Route::get('subscription/edit', 'edit')->middleware(['auth', 'basic'])->name('subscription.edit');
    Route::post('subscription/edit', 'update')->middleware(['auth', 'basic'])->name('subscription.update');
    Route::get('subscription/cancel', 'cancel')->middleware(['auth', 'basic'])->name('subscription.cancel');
    Route::post('subscription/cancel', 'destroy')->middleware(['auth', 'basic'])->name('subscription.delete');
    Route::post('subscription/resume', 'resume')->middleware(['auth', 'basic'])->name('subscription.resume');
});

Route::get('company', [App\Http\Controllers\CompanyController::class, 'index'])->name('company.index');