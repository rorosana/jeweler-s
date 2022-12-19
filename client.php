<?php 
require_once("lib/nusoap.php");

$client = new SoapClient("http://localhost/devs_rosa/act05/jeweler-s/server.php?wsdl");
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Jeweler's</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mr+De+Haviland&family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
  </head>
  <body>

    <h1>Jeweler's</h1>
    <hr>
    <p>
      Con el siguiente formulario puedes insertar un producto en la base de datos.
    </p>
    <hr>

    <form action="#" method="POST">
      <input name="name_product" type="text" placeholder="Escribe el nombre del producto">
      <p>Las categorías disponibles son: </br>
        <b>1</b> - Earrings &nbsp;  <b>2</b> - Necklaces &nbsp;  <b>3</b> - Bracelets &nbsp; <b>4</b> - Rings
      </p>
      <div class="quantity">
      <label> Indica la categoría:</label>
      <input name="category" type="number" min="1" max="4"placeholder="">
      </div>
</br><input name="submit" type="submit" value="Submit">
    <hr>
    </form>


<?php
//Parte del cliente para ejecutar la función de insertar producto cuando se envíe el formulario.
if(isset($_POST['submit'])){
    $name_product = $_POST['name_product'] ?? '';
    $category = $_POST['category'] ?? '';
    $result = $client->insertProduct($name_product, $category);
}


?>

<form action="#" method="POST">
      <p>Tabla que muestra los productos clasificados por categoría:</p>
      <hr>
      <div class="quantity">
      <label> Indica la categoría:</label>
      <input name="category" type="number" min="1" max="4"placeholder="">
      </div>
</br><input name="submit" type="submit" value="Submit">
    </form>
<?php 
//Parte del cliente para ejecutar la función listar productos según la categoría que indica el user.
if(isset($_POST['submit'])){
    $category = $_POST['category'] ?? '';
    $result = $client->get_products($category);
    echo "<table border='1'>";
    foreach($result as $product){
      echo "<tr>";
      echo "<td>$product->name_product</td>";
      echo "</tr>";
    }
}
echo "<hr>";
//Parte del cliente para ejecutar la función que lista las categorías.
$result = $client->categoryList();
echo "<table border='1'>";
    foreach($result as $cat){
      echo "<tr>";
      echo "<td>$cat->id_category</td>";
      echo "<td>$cat->name_category</td>";
      echo "</tr>";
    }
?>
</body>

  <!--Rosa Ana Patiño Caraballo-->
</html>
