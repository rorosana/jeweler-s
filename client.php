<?php 
require_once("lib/nusoap.php");

$client = new SoapClient("http://localhost/devs_rosa/act05/jeweler-s/server.php?wsdl");
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Jeweler's</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"><link href="https://fonts.googleapis.com/css2?family=Mr+De+Haviland&family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
  </head>
  <body>

    <h1>Jeweler's</h1>

    <form action="#" method="POST">
      <input name="name_product" type="text" placeholder="Escribe el nombre del producto">
      <input name="category" type="number" placeholder="Indica la categoría del producto">
      <input name="submit" type="submit" value="Submit">
    </form>


<?php

if(isset($_POST['submit'])){
    $name_product = $_POST['name_product'] ?? '';
    $category = $_POST['category'] ?? '';
    $result = $client->insertProduct($name_product, $category);
}

$result = $client->categoryList();
print_r($result);
echo "<br/>";
?>

<form action="#" method="POST">
      <input name="category" type="number" placeholder="Indica la categoría del producto">
      <input name="submit" type="submit" value="Submit">
    </form>
<?php 

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
?>
</body>

  <!--Rosa Ana Patiño Caraballo-->
</html>
