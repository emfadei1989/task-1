<?php
namespace App\Contracts;


interface Weather
{
    /**
     * @return array|null
     */
    function currentWeather(): ?array;
}