<?php
$server = 'localhost';
$username = 'root';
$password = '';
$database = 'jewel';


// Create connection MySQLi Object-oriented.
//https://www.w3schools.com/php/php_mysql_create.asp

$conn = new mysqli($server, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS jewel";
if ($conn->query($sql) === TRUE) {
  echo "Database created successfully";
} else {
  echo "Error creating database: " . $conn->error;
}

//Create category table
$sql = "CREATE TABLE IF NOT EXISTS category(id_category int primary key auto_increment, name_category varchar(50))";
if ($conn->query($sql) === TRUE) {
  echo "Table created successfully";
} else {
  echo "Error creating table: " . $conn->error;
}

//Create product table
$sql = "CREATE TABLE IF NOT EXISTS product(id_product int primary key auto_increment, name_product varchar(50), category int, foreign key (category) references category(id_category));";
if ($conn->query($sql) === TRUE) {
  echo "Table created successfully";
} else {
  echo "Error creating table: " . $conn->error;
}

$conn->close();
?>
