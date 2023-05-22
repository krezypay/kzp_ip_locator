<?php

namespace Mds\IpLocator;

require_once("geoip2.phar");

use GeoIp2\Database\Reader;

/**
 * LocationService
 * 
 */
class LocationService
{

    /**
     * ip
     *
     * @var string
     */
    private $ip;

    /**
     * city
     *
     * @var string
     */
    private $city;

    /**
     * state
     *
     * @var string
     */
    private $state;

    /**
     * country
     *
     * @var string
     */
    private $country;

    /**
     * timezone
     *
     * @var string
     */
    private $timezone;

    /**
     * latitude
     *
     * @var float
     */
    private $latitude;

    /**
     * longitude
     *
     * @var float
     */
    private $longitude;


    /**
     * __construct
     *
     * @param  string $ip Ip Adress
     * @return void
     */
    public function __construct(string $ip)
    {
        $this->ip = $ip;
        $this->locate();
    }

    /**
     * getCity
     *
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * getState
     *
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * getCountry
     *
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * getTimezone
     *
     * @return string
     */
    public function getTimezone(): string
    {
        return $this->timezone;
    }

    /**
     * getLatitude
     *
     * @return float
     */
    public function getLatitude(): float
    {
        return $this->latitude;
    }

    /**
     * getLongitude
     *
     * @return float
     */
    public function getLongitude(): float
    {
        return $this->longitude;
    }


    /**
     * getReader
     *
     * @return GeoIp2\Database\Reader
     */
    private function getReader()
    {
        $path = dirname(__DIR__) . "/GeoIP/GeoLite2-City.mmdb";
        return new Reader($path);
    }

    /**
     * locate
     *
     * @return void
     */
    private function locate(): void
    {
        $reader = $this->getReader();
        $record = $reader->city($this->ip);

        $this->city = $record->city->name;
        $this->state = $record->mostSpecificSubdivision->name;
        $this->country = $record->country->name;
        $this->timezone = $record->location->timeZone;
        $this->latitude = $record->location->latitude;
        $this->longitude = $record->location->longitude;
    }
}
