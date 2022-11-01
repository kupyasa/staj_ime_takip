<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrapFive();

        Gate::define('ogrenci', function (User $user) {
            return ($user->rol == "ogrenci");
        });

        Gate::define('ogretmen', function (User $user) {
            return ($user->rol == "ogretmen");
        });

        Gate::define('komisyon', function (User $user) {
            return ($user->rol == "komisyon");
        });

        Gate::define('yonetici', function (User $user) {
            return ($user->rol == "yonetici");
        });

        Gate::define('superyonetici', function (User $user) {
            return ($user->rol == "superyonetici");
        });

        Blade::if('ogrenci', function () {
            return request()->user()?->can('ogrenci');
        });

        Blade::if('ogretmen', function () {
            return request()->user()?->can('ogretmen');
        });

        Blade::if('komisyon', function () {
            return request()->user()?->can('komisyon');
        });

        Blade::if('yonetici', function () {
            return request()->user()?->can('yonetici');
        });

        Blade::if('superyonetici', function () {
            return request()->user()?->can('superyonetici');
        });

        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
    }
}
