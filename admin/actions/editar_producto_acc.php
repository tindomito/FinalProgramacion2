<?php
require_once("../../functions/autoload.php");


$postData = $_POST;
$datosArchivo = $_FILES['foto'];


try{
    $producto = Producto::get_x_id($postData['id_producto']);

    if(!empty($datosArchivo['tmp_name'])){
        //El usuario decidió reemplazar la imágen

        //borramos la foto anterior.
        Imagen::borrarImagen("../../img/productos/" . $producto->getFoto());
        //actualizamos por la nueva foto.
        $imagen = Imagen::subirImagen("../../img/productos", $datosArchivo);
    }else{
        //El usuario se quedo con la foto original
        $imagen = $postData['imagen_og'];
    }
    $producto->edit(
        $postData['id_marca'],
        $postData['nombre'],
        $postData['presentacion'],
        $postData['precio'],
        $imagen
    );
}catch (Exception $e){
    // die("No se pudo editar el prodcuto.");
    Alerta::add_alerta("warning", "Hubo un problema al editar el producto.");
    Alerta::add_alerta("secondary", $e->getMessage());
}

Alerta::add_alerta("success","Se editó correctamente el producto: " .$postData['nombre'] . "(". $postData['id_producto'] .")" );

header('Location: ../index.php?sec=productos');

?>