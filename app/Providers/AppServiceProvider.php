<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\BirthdayRepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\BirthdayRepository;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services or repositories.
     *
     * This method binds interfaces to their concrete implementations.
     * It ensures that whenever the application requires an implementation of
     * these interfaces, the appropriate class will be provided.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class,UserRepository::class);
        $this->app->bind(BirthdayRepositoryInterface::class,BirthdayRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
