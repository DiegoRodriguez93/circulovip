<?php

$host = 'localhost';
$user = 'root';
$pass = 'sist.2k8';
$db =   'vidapesos';

date_default_timezone_set('America/Argentina/Buenos_Aires');
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);
