<?php

/* $host = 'mysql3001.mochahost.com';
$user = 'swsangel_root';
$pass = 'Compuexpress06';
$db = 'swsangel_circulovip';
 */

$host = 'mysql1005.mochahost.com';
$user = 'platafo1_root';
$pass = 'Montevideo314';
$db = 'platafo1_circulovip';

$mysqli = new mysqli($host, $user, $pass, $db) or die($mysqli->error);

date_default_timezone_set('America/Argentina/Buenos_Aires');
