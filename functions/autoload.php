<?php
session_start();

spl_autoload_register('autoloadClasses');

function autoloadClasses($nombreClase){
    // echo "<p>NO SE CARGÓ LA CLASE: $nombreClase";
    
    //echo "<br>";
    //echo __DIR__;
    
    $archivoClase = __DIR__ . "/../classes/$nombreClase.php";
    
    //echo "<br>";
    //echo $archivoClase;
    
    if(file_exists($archivoClase)){
        require_once($archivoClase);
    }else{
        die("No se pudo cargar la calse: $nombreClase");
    }
}
?>