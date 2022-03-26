<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\CommentsRepository\CommentsRepositoryInterface;
use App\Http\CommentsRepository\CommentsRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind( CommentsRepositoryInterface::class, CommentsRepository::class );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
