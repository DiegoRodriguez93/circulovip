<?php

$host = 'mysql1005.mochahost.com';
$user = 'platafo1_root';
$pass = 'Montevideo314';
$db = 'platafo1_circulovip';

date_default_timezone_set('America/Argentina/Buenos_Aires');
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);
