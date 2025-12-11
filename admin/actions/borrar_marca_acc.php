<?php
require_once("../../functions/autoload.php");



$id = $_GET['id'] ?? FALSE;
echo "<pre>";
print_r($id);
echo "</pre>";

try{
    $marca = Marca::get_x_id($id);

    echo "<pre>";
    print_r($marca);
    echo "</pre>";

    $marca->delete();
}catch (Exception $e){
    die("No se pudo borrar la marca.");
}

header('Location: ../index.php?sec=marcas');

?>