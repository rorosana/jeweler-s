<?php
require_once("lib/nusoap.php");

$namespace = "http://localhost/clase12/servidor_dani.php";
$server = new soap_server();
$server->configureWSDL("Jeweler", $namespace);
$server->schemTargetNamespace = $namespace;
$server->soap_defencoding = "UTF-8";


//FUNCIONES
function holaMundo(){
	return "HOLA MUNDO!!!";
}

function suma($a, $b){
	return $a + $b;
}

function resta($a, $b){
	return $a - $b;
}


//FUNCION PARA GESTIONAR LA BASE DE DATOS Y LISTAR LAS SERIES.
function listaSeries(){
	require_once('datos.php');
	$misSeries = array();
	$con = mysqli_connect($server, $username, $password, $database);
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

/*function listaPelis(){
	$misPelis = array();
	$con = mysqli_connect("localhost", "root", "",  "series");
	$pelis = mysqli_query($con, "select id_pelicula, titulo, sinopsis, nombre from pelicula, director where director=id_director");
	while($peli = mysqli_fetch_assoc($pelis)){
		$misPelis[] = $peli;
	}
	mysqli_close($con);
	return $misPelis;
}*/

//DEFINICIÓN DE TIPOS COMPLEJOS
//$server->wsdl->addComplexType();
//$server->wsdl->addComplexType();

//REGISTRO DE FUNCIONES
$server->register(
	'holaMundo',						//Nombre de la función a ejecutar
	array(),							//Parámetros de entrada
	array('return'=>'xsd:string'),		//Valores devueltos
	$namespace,
	false,								//soapaction
	'rpc',								//Cómo se envían los mensajes
	'encoded',							//Serialización
	'Función que devuelve un mensaje de bienvenida'
);

$server->register(
	'suma',
	array('a'=>'xsd:int', 'b'=>'xsd:int'),
	array('return'=>'xsd:int'),
	$namespace,
	false,
	'rpc',
	'encoded',
	'Función que recibe dos enteros y devuelve el resultado de la suma'
);

$server->register(
	'resta',
	array('a'=>'xsd:int', 'b'=>'xsd:int'),
	array('return'=>'xsd:int'),
	$namespace,
	false,
	'rpc',
	'encoded',
	'Función que recibe dos enteros y devuelve el resultado de la resta'
);

$server->service(file_get_contents("php://input"));
?>