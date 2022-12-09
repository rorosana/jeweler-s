<?php
//Variables de conexión a la database.
$server = 'localhost';
$username = 'root';
$password = '';
$database = 'jewel';

function conectar(){
	$con = mysqli_connect($GLOBALS["server"], $GLOBALS["username"], $GLOBALS["password"], $GLOBALS["database"]) 
    or die("Error al conectar con la base de datos");
	return $con;
}



?>