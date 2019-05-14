<?php

namespace App\Providers;

use App\City;
use App\Services\YandexWeather;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
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
        $this->app->singleton('App\Contracts\Weather', function ($app) {
            $city = new City(config('weather.yandex.defaultCity.name'),
                config('weather.yandex.defaultCity.coordinates.lat'),
                config('weather.yandex.defaultCity.coordinates.lon')
                );
            return new YandexWeather(
                new \GuzzleHttp\Client(),
                config('weather.yandex.apiKey'),
                config('weather.yandex.url'),
                $city
            );
        });
    }
}
