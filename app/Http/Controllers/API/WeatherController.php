<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Contracts\Weather;

class WeatherController extends Controller
{
    /**
     * @var Weather
     */
    private $weatherService;

    public function __construct(Weather $weatherService)
    {

        $this->weatherService = $weatherService;
    }

    public function currentWeather()
    {
        $currentWeather = $this->weatherService->currentWeather();

        if ($currentWeather) {
            return [
                'success' => true,
                'data' => $currentWeather,
            ];
        } else {
            return [
                'success' => false,
            ];
        }
    }

}