<?php

use App\Models\Auth\User;
use Illuminate\Support\Facades\Route;

/**
 * 'guest' middleware applied to all routes
 *
 * @see \App\Providers\Route::mapGuestRoutes
 * @see \modules\PaypalStandard\Routes\guest.php for module example
 */

Route::get('register', function(){
    redirect('install/settings')->send();
})->name('register');

Route::get('register/pro', function(){
    redirect('install/settings/pro')->send();
})->name('register-pro');

Route::group(['prefix' => 'auth'], function () {
    Route::get('login', 'Auth\Login@create')->name('login');
    Route::post('login', 'Auth\Login@store');

    Route::get('forgot', 'Auth\Forgot@create')->name('forgot');
    Route::post('forgot', 'Auth\Forgot@store');

    //Route::get('reset', 'Auth\Reset@create');
    Route::get('reset/{token}', 'Auth\Reset@create')->name('reset');
    Route::post('reset', 'Auth\Reset@store')->name('reset.store');

    Route::get('register', function(){
        redirect('install/settings')->send();
    })->name('register');

    Route::get('register/pro', function(){
        redirect('install/settings/pro')->send();
    })->name('register-pro');

});
