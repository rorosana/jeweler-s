<?php
$server = 'localhost';
$username = 'root';
$password = '';
$database = 'jewel';

function conectar(){
	$con = mysqli_connect($GLOBALS["server"], $GLOBALS["username"], $GLOBALS["password"], $GLOBALS["database"]) 
    or die("Error al conectar con la base de datos");
	return $con;
}

function cerrar_conexion($con){
	mysqli_close($con);
}

/* Otra manera de trabajar que he probado.  

Create connection MySQLi Object-oriented.
//https://www.w3schools.com/php/php_mysql_create.asp

$con = new mysqli($server, $username, $password, $database);
// Check connection
if ($con->connect_error) {
  die("Connection failed: " . $con->connect_error);
}*/

/*//Create database
$sql = "CREATE DATABASE IF NOT EXISTS jewel";
if ($con->query($sql) === TRUE) {
  echo "Database created successfully";
} else {
  echo "Error creating database: " . $con->error;
}

//Create category table
$sql = "CREATE TABLE IF NOT EXISTS category(id_category int primary key auto_increment, name_category varchar(50))";
if ($con->query($sql) === TRUE) {
  echo "Table created successfully";
} else {
  echo "Error creating table: " . $con->error;
}

//Create product table
$sql = "CREATE TABLE IF NOT EXISTS product(id_product int primary key auto_increment, name_product varchar(50), category int, foreign key (category) references category(id_category));";
if ($con->query($sql) === TRUE) {
  echo "Table created successfully";
} else {
  echo "Error creating table: " . $con->error;
}

$con->close();*/
?>
