<?php
    require_once("../classes/Conexion.php");
    require_once("includes/functions.php");
    require_once("../functions/autoload.php");
     
    $seccion = isset($_GET['sec']) ? $_GET['sec'] : 'inicio';
    if(!in_array($seccion, secciones_validas())){
        $vista = '404';
        $title_seccion = "Error 404 - Página no encontrada";

    }else{
        $vista = $seccion;
        $title_seccion = ucfirst(strtolower($seccion)) . " - Portal de Administración";
    }

    ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">    
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
