<?php

date_default_timezone_set('America/Bogota');
$fecha = date("Y-m-d");
$host = "localhost";
$db = "konecta_products";
$user = "root";
$pw = ""; 
$con = mysqli_connect($host, $user, $pw) or die("Error en la conexion al host");
mysqli_select_db($con, $db) or die("Error en la conexion al base datos");
