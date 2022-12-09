<?php

require_once("lib/nusoap.php");

$namespace = "http://localhost/devs_rosa/act05/jeweler-s/server.php";
$server = new soap_server();
$server->configureWSDL("Jeweler", $namespace);
$server->schemTargetNamespace = $namespace;
$server->soap_defencoding = "UTF-8";


//FUNCIONES

function crear_pelicula($con, $titulo, $director, $sinopsis){
	$resultado = mysqli_query($con, "insert into pelicula(titulo, director, sinopsis) values('$titulo', $director, '$sinopsis')");
	return $resultado;
}

//FUNCION PARA INSERTAR NUEVOS PRODUCTOS EN LA BASE DE DATOS JEWEL.
function insertProduct(){
	require_once('database.php');
	$misSeries = array();
	$conn = mysqli_connect($server, $username, $password, $database);
	$series = mysqli_query($con, "select * from serie");
	while($serie = mysqli_fetch_assoc($series)){
		$misSeries[] = $serie;
	}
	mysqli_close($con);
	return $misSeries;
}

//DEFINICIÓN DE TIPOS COMPLEJOS

$server->wsdl->addComplexType(
	'Serie',
	'complexType',
	'struct',
	'all',
	'',
	array(
             'codigo' => 
             array('name'=>'codigo','type'=>'xsd:int'),
             'nombre' => 
             array('name'=>'nombre','type'=>'xsd:string'),
             'genero' => 
             array('name'=>'genero','type'=>'xsd:string'),
             'anyo' => 
             array('name'=>'anyo','type'=>'xsd:int'),
             'canal' => 
             array('name'=>'canal','type'=>'xsd:int')
	)
);

$server->wsdl->addComplexType(
	'ArraySeries',
	'complexType',
	'array',
	'',
	'SOAP-ENC:Array',
	array(),
	array(
	array('ref'=>'SOAP-ENC:arrayType', 
	'wsdl:arrayType'=>'tns:Serie[]')),
	'tns:Serie'
	
	);


//REGISTRO DEL MÉTODO

$server->register(
	'listaSeries',
	array(),
	array('return'=>'tns:ArraySeries'),
	$namespace,
	false,
	'rpc',
	'encoded',
    'Método que devuelve una array con las series de una base de datos'
);

?>