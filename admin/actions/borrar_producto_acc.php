<?php
require_once("../../functions/autoload.php");


$id = $_GET['id'] ?? FALSE;
echo "<pre>";
print_r($id);
echo "</pre>";

try{
    $producto = Producto::get_x_id($id);
    $producto->delete();
    Imagen::borrarImagen("../../img/productos/" . $producto->getFoto());

}catch (Exception $e){
    die("No se pudo borrar el producto.");
}

header('Location: ../index.php?sec=productos');

?>