<?php

namespace Photogabble\Portcullis;

use Illuminate\Support\Facades\Route;
use Photogabble\Portcullis\Observers\UserObserver;
use Photogabble\Portcullis\Console\UserDelete;
use Illuminate\Support\ServiceProvider;
use Photogabble\Portcullis\Console\UserAdd;
use App\User;

class PortcullisServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'registration.php', 'registration'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'registration.php' => config_path('registration.php'),
        ]);

        $this->loadMigrationsFrom(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'migrations');

        Route::middleware('web')
            ->namespace('Photogabble\Portcullis\Http\Controllers')
            ->group(__DIR__ . '/routes.php');

        User::observe(UserObserver::class);

        if ($this->app->runningInConsole()) {
            $this->commands([
                UserAdd::class,
                UserDelete::class,
            ]);
        }
    }
}
