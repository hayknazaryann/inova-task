<?php

namespace App\Providers;

use App\Repositories\Eloquent\ApplicationRepository;
use App\Repositories\Interfaces\ApplicationInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    public $bindings = [
        // Eloquent
        ApplicationInterface::class => ApplicationRepository::class,
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
