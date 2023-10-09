<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('', [WebsiteController::class, 'index'])->name('home');
Route::middleware('auth')->group(function () {
    Route::post('load-more', [WebsiteController::class, 'loadMore'])->name('load_more');

    Route::prefix('applications')->name('applications')
        ->controller(ApplicationController::class)->group(function () {
        Route::get('', 'index');
        Route::post('load', 'load')->name('.load');
        Route::post('store', 'store')->name('.store');
        Route::get('{id}', 'edit')->name('.edit');
        Route::delete('{id}', 'destroy')->name('.destroy');
    });
});
