<?php
require_once("lib/nusoap.php");
$client = new SoapClient("http://localhost/devs_rosa/act05/jeweler-s/server.php?wsdl");
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
  </head>
  <body>

    <h1>Login</h1>

    <form action="#" method="POST">
      <input name="nombre_usuario" type="text" placeholder="Escribe tu nombre">
      <input name="pass" type="password" placeholder="Introduce tu contraseña">
      <input type="submit" value="Submit">
    </form>
  </body>

  <!--Rosa Ana Patiño Caraballo-->
</html>