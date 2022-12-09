<?php

require_once("lib/nusoap.php");

$namespace = "http://localhost/devs_rosa/act05/jeweler-s/server.php";
$server = new soap_server();
$server->configureWSDL("Misuperservicioweb", $namespace);
$server->schemTargetNamespace = $namespace;
$server->soap_defencoding = "UTF-8";


//FUNCIONES


?>