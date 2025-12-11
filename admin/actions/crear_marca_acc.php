<?php
require_once("../../functions/autoload.php");

$postData = $_POST;

try {
    Marca::insert(
        $postData['marca']
    );
} catch (Exception $e) {
    die("No se pudo cargar la marca.");
}

// Redirige al listado de marcas
header('Location: ../index.php?sec=marcas');
exit;
