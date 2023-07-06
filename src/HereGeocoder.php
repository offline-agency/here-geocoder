<?php

namespace Thiagoprz\HereGeocoder;

use GuzzleHttp\Client;

class HereGeocoder
{
    /**
     * @see Geocoder API Documentation: https://developer.here.com/documentation/geocoder/topics/quick-start-geocode.html
     */
    const API_GEOCODER_URL = 'https://geocoder.api.here.com/6.2/geocode.json';
    const API_REVERSE_GEOCODER_URL = 'https://reverse.geocoder.ls.hereapi.com/6.2/reversegeocode.json';


    /**
     * HereGeocoder constructor.
     */
    public function __construct()
    {
        $this->app_id = env('HERE_API_ID');
        $this->app_code = env('HERE_APP_CODE');
    }

    /**
     * Makes a GET request to the API
     *
     * @param string $url
     * @param array $params
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function get($url, $params = null)
    {
        $client = new Client();
        if ($params) {
            $url = $url . '?' . http_build_query($params);
        }
        $data = $client->request('GET', $url);
        $output = json_decode($data->getBody());

        $output->Response->View = $output->Response->View[0];
        return $output;
    }

    /**
     * Geocode an address
     * @param $address
     * @return \stdClass
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function geocode($address)
    {
        return $this->get(self::API_GEOCODER_URL, [
            'searchtext' => $address,
            'app_id' => $this->app_id,
            'app_code' => $this->app_code,
        ]);
    }

    /**
     * Geocode an address
     * @param double $latitude
     * @param double $longitude
     * @param double $radius
     * @return \stdClass
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function reverseGeocode($latitude, $longitude, $radius)
    {
        return $this->get(self::API_REVERSE_GEOCODER_URL, [
            'apiKey' => env("HERE_API_KEY"),
            'prox' => "$latitude,$longitude,$radius",
            'mode' => "retrieveAddresses",
        ]);
    }

    /* @todo Batch geolocation */
    /* @todo Batch places */
}
