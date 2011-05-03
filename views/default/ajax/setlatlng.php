<?php

require_once(dirname(dirname(dirname(dirname(dirname(dirname(__FILE__)))))) . "/engine/start.php");

$latitude = get_input('latitude');
$longitude = get_input('longitude');

$company_guid = get_input('company_guid');
$company = get_entity($company_guid);

$company->latitude = $latitude;
$company->longitude = $longitude;

die();
?>
