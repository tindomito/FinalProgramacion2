<?php
require_once("../../functions/autoload.php");


$postData = $_POST;
$datosArchivo = $_FILES['foto'];

echo "<pre>";
print_r($postData);
echo "</pre>";

echo "<pre>";
print_r($datosArchivo);
echo "</pre>";


try{
 $imagen = Imagen::subirImagen("../../img/productos", $datosArchivo);
    $idProducto = Producto::insert(
        $postData['id_marca'], 
        $postData['nombre'], 
        $postData['presentacion'],
        $postData['precio'],
        $imagen
    );

    echo $idProducto;
}catch (Exception $e){
    die("No se pudo cargar la marca.");
}

header('Location: ../index.php?sec=productos');
exit;
?>