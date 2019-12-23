<?php

$host = 'mysql3001.mochahost.com';
$user = 'swsangel_root';
$pass = 'Compuexpress06';
$db =   'swsangel_circulovip';

date_default_timezone_set('America/Argentina/Buenos_Aires');
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);
