<?php

require './vendor/autoload.php';


use Mds\IpLocator\LocationService;

$ip = '190.115.174.182';

$locationService = new LocationService($ip);

var_dump($locationService);