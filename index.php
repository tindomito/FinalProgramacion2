<?php
    session_start();

    // $secciones_validas = ["inicio", "productos", "detalle", "filtro", "contacto"];
    /*Reemplazamos el array por la información asociado en el json y obtenemos los datos desde el objeto Secciones*/

    require_once "classes/Secciones.php";
    $secciones_validas = Secciones::secciones_validas();
    // echo "<pre>";
    // var_dump($secciones_validas);
    // echo "</pre>";
    
    $secciones_menu = Secciones::secciones_menu();
    // echo "<pre>";
    // var_dump($secciones_menu);
    // echo "</pre>";
    
    
    $seccion = isset($_GET['sec']) ? $_GET['sec'] : 'inicio';
    if(!in_array($seccion, $secciones_validas)){
        $vista = '404';
    }else{
        $vista = $seccion;
    }
    
    
    $secciones = Secciones::secciones_del_sitio();
    $title_seccion = "";
    foreach ($secciones as $value) {
        if($value->getVinculo() == $vista){
            $title_seccion = $value->getTitle();
        }
    }
    // echo "<pre>";
    // var_dump($title_seccion);
    // echo "</pre>";

    ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    
    <title><?= $title_seccion; ?></title>
</head>
<body>
    <?php
        require_once "includes/header.php";
    ?>
    <main class="container-fluid">
    <?php 
        require_once "views/$vista.php";
    ?>
    </main>
    <?php
        require_once "includes/footer.php";
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="js/carrito.js"></script>
</body>
</html>
