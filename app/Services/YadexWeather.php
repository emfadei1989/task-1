<?php
namespace App\Services;


use App\City;
use App\Contracts\Weather;
use GuzzleHttp\ClientInterface;

class YandexWeather implements Weather
{
    protected $windSpeedFormat = 'м/с';

    protected $tempFormat = '&deg;C';

    protected $pressureFormat = 'мм рт. ст.';

    protected $url = 'https://api.weather.yandex.ru/v1/forecast';
    /**
     * @var string
     */
    protected $apiKey;
    /**
     * @var City
     */
    protected $city;
    /**
     * @var ClientInterface
     */
    protected $httpClient;


    public function __construct(ClientInterface $httpClient, string $apiKey, City $city)
    {
        $this->apiKey = $apiKey;
        $this->city = $city;
        $this->httpClient = $httpClient;
        $this->transformFormat();
    }

    /**
     * @return array|null
     */
    public function currentWeather(): ?array
    {
        try {
            $response = $this->getWeatherData($this->city->getLat(), $this->city->getLon());
        } catch (\Exception $e) {
            return null;
        }
        
        return [
            'temp' => "{$response->fact->temp} {$this->tempFormat}",
            'windSpeed' => "{$response->fact->wind_speed} {$this->windSpeedFormat}",
            'pressure' => "{$response->fact->pressure_mm} {$this->pressureFormat}",
        ];
    }

    /**
     * @param float $lat
     * @param float $lon
     *
     * @return \JsonSerializable
     *
     * @throws \Exception
     */
    protected function getWeatherData(float $lat, float $lon)
    {
        $url = $this->url . '?lat=' . $this->city->getLat() . '&lon=' . $this->city->getLon();
        $headers = ['X-Yandex-API-Key' => $this->apiKey];
        try {
            $response = $this->httpClient->request('GET', $url, ['headers' => $headers]);
        } catch (\GuzzleHttp\Exception\GuzzleException $exception) {
            throw new \Exception($exception->getMessage(), $exception->getCode());
        }
        return json_decode($response->getBody()->getContents());
    }

    protected function transformFormat()
    {
        $this->tempFormat = html_entity_decode($this->tempFormat);
    }
}