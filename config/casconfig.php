<?php
require_once( __DIR__ . '/../vendor/autoload.php');
$casservername = 'seguridad.espoch.edu.ec';
$casport = 443;
$casbaseuri = '/cas';
$caslogouturl = '/logout?service=';
$casprotocol = 'https://';
phpCAS::client(CAS_VERSION_3_0, $casservername, $casport, $casbaseuri);
phpCAS::setNoCasServerValidation();
?>