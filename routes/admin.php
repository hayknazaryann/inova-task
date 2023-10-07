<?php


use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function(){
    Route::prefix('login')->group(function(){
        Route::get('', [LoginController::class, 'showLoginForm'])->name('admin.login');
        Route::post('', [LoginController::class, 'login']);
    });

    Route::middleware('admin.auth')->name('admin.')->group(function(){
        Route::post('logout', [LoginController::class, 'logout'])->name('logout');

        Route::get('dashboard',[DashboardController::class, 'index'])->name('dashboard');
        foreach (\App\Enums\ResourcesEnum::all() as $name => $class) {
            if (class_exists($class)) {
                Route::resource($name, $class);
            }
        }

    });
});

Route::get('admin/{any}', function ($any) {
    return redirect()->route('admin.dashboard');
})->where('any', '.*');
