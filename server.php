<?php 
require_once("lib/nusoap.php");

$namespace = "http://localhost/devs_rosa/act05/jeweler-s/server.php";
$server = new soap_server();
$server->configureWSDL("Jeweler", $namespace);
$server->schemTargetNamespace = $namespace;
$server->soap_defencoding = "UTF-8";

//FUNCION PARA INSERTAR UN PRODUCTO
function insertProduct($name_product, $category){//la función recibe losparámetros del lado del cliente.
	require_once('database.php');
	$con = mysqli_connect($server, $username, $password, $database);
	$newProduct = mysqli_query($con, "insert into product(name_product, category) values('$name_product', $category);");
	mysqli_close($con);
}

$server->register(
	'insertProduct',
	array('name_product'=>'xsd:string', 'category'=>'xsd:int'),//entrada 
	array(),
	$namespace,
	false,
	'rpc',
	'encoded',
    'Método que inserta un producto en la bdd'
);

//FUNCIÓN ARRAY CATEGORÍAS
function categoryList(){
	require_once('database.php');
	$categories = array();
	$con = mysqli_connect($server, $username, $password, $database);
	$productsCats = mysqli_query($con, "SELECT * FROM category;");
	while($productCat = mysqli_fetch_assoc($productsCats)){
		$categories[] = $productCat;
	}
	mysqli_close($con);
	return $categories;
}

//DEFINICIÓN DE TIPOS COMPLEJOS
$server->wsdl->addComplexType(
	'Category', 		//name
	'complexType', 	//typeClass
	'struct', 		//PhpClass: array | struct(array asociativo)
	'sequence', 	//compositor: sequence | choice | all
	'', 			//restrictionBase
	array(			//elements
		'id_category'=>array('name'=>'id_category', 'type'=>'xsd:int'),
		'name_category'=>array('name'=>'name_category', 'type'=>'xsd:string')
		)
);

$server->wsdl->addComplexType(
	'ArrayCategories',
	'complexType',
	'array',
	'sequence',
	'SOAP-ENC:Array',
	array(),
	array(array('ref'=>'SOAP-ENC:arrayType', 'wsdl:arrayType'=>'tns:Category[]')),
	'tns:Category'
);
//Registro de la función
$server->register(
	'categoryList',
	array(),
	array('return'=>'tns:ArrayCategories'),
	$namespace,
	false,
	'rpc',
	'encoded',
	'Función que devuelve un array con los datos de las categorías almcenadas en la base de datos.'
);

//OBTENER TODOS LOS PRODUCTOS DE UNA DETERMINADA CATEGORÍA.
function get_products($category){
	$products = array();
	require_once('database.php');
	$con = mysqli_connect($server, $username, $password, $database);
	$resultado = mysqli_query($con, "SELECT category, name_product  FROM product WHERE category = $category");
	while($result = mysqli_fetch_assoc($resultado)){
		$products[] = $result;
	}
	mysqli_close($con);
	return $products;
}

//DEFINICIÓN DE TIPOS COMPLEJOS
$server->wsdl->addComplexType(
	'Product', 		//name
	'complexType', 	//typeClass
	'struct', 		//PhpClass: array | struct(array asociativo)
	'sequence', 	//compositor: sequence | choice | all
	'', 			//restrictionBase
	array(			//elements
		'category'=>array('name'=>'category', 'type'=>'xsd:int'),
		'name_product'=>array('name'=>'name_product', 'type'=>'xsd:string')
		)
);

$server->wsdl->addComplexType(
	'ArrayProducts',
	'complexType',
	'array',
	'sequence',
	'SOAP-ENC:Array',
	array(),
	array(array('ref'=>'SOAP-ENC:arrayType', 'wsdl:arrayType'=>'tns:Product[]')),
	'tns:Product'
);
//Registro de la función
$server->register(
	'get_products',
	array('category'=>'xsd:int'),
	array('return'=>'tns:ArrayProducts'),
	$namespace,
	false,
	'rpc',
	'encoded',
	'Función que devuelve un array con los datos de las categorías almcenadas en la base de datos.'
);

$server->service(file_get_contents("php://input"));
?>