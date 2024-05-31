<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/hotels','App\Http\Controllers\hotelrsvController@index')->name('hotels.index');

Route::get('/hotels/create','App\Http\Controllers\hotelrsvController@create')->name('hotel.create')->middleware('auth');
Route::post('/hotels/store/','App\Http\Controllers\hotelrsvController@store')->name('hotel.store')->middleware('auth');

Route::get('/hotels/edit/{hotel}', 'App\Http\Controllers\hotelrsvController@edit')->name('hotel.edit')->middleware('auth');
Route::put('/hotels/edit/{hotel}','App\Http\Controllers\hotelrsvController@update')->name('hotel.update')->middleware('auth');

