<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->bind(\App\Repositories\OrderInfoRepository::class, \App\Repositories\OrderInfoRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\OrderTwdInfoRepository::class, \App\Repositories\OrderTwdInfoRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\OrderJpyInfoRepository::class, \App\Repositories\OrderJpyInfoRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\OrderUsdInfoRepository::class, \App\Repositories\OrderUsdInfoRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\OrderRmbInfoRepository::class, \App\Repositories\OrderRmbInfoRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\OrderMyrInfoRepository::class, \App\Repositories\OrderMyrInfoRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\OrderMyrInfosRepository::class, \App\Repositories\OrderMyrInfosRepositoryEloquent::class);
        //:end-bindings:
    }
}
