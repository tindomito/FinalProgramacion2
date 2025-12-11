<?php
require_once("../../functions/autoload.php");


$postData = $_POST;
$marca = Marca::get_x_id($postData["id_marca"]);

echo "<pre>";
print_r($postData);
echo "</pre>";

echo "<pre>";
print_r($marca);
echo "</pre>";


try{
    $marca->edit(
        $postData['marca']
    );
}catch (Exception $e){
    die("No se pudo editar la marca.");
}

header('Location: ../index.php?sec=marcas');

?>