<?php
session_start();

require_once __DIR__ . "/../classes/Carrito.php";

$action = $_GET['action'] ?? $_POST['action'] ?? null;
$id_producto = isset($_REQUEST['id_producto']) ? (int)$_REQUEST['id_producto'] : null;
$cantidad = isset($_REQUEST['cantidad']) ? (int)$_REQUEST['cantidad'] : 1;

switch ($action) {
    case 'agregar':
        if ($id_producto) {
            Carrito::agregar($id_producto, $cantidad);
        }
        // Redirigir a la página anterior o al carrito
        $referer = $_SERVER['HTTP_REFERER'] ?? '../index.php?sec=carrito';
        // Agregar mensaje de éxito
        if (strpos($referer, '?') !== false) {
            $referer .= '&msg=agregado';
        } else {
            $referer .= '?msg=agregado';
        }
        header("Location: $referer");
        break;

    case 'eliminar':
        if ($id_producto) {
            Carrito::eliminar($id_producto);
        }
        header("Location: ../index.php?sec=carrito&msg=eliminado");
        break;

    case 'actualizar':
        if ($id_producto !== null) {
            Carrito::actualizarCantidad($id_producto, $cantidad);
        }
        header("Location: ../index.php?sec=carrito&msg=actualizado");
        break;

    case 'vaciar':
        Carrito::vaciar();
        header("Location: ../index.php?sec=carrito&msg=vaciado");
        break;

    default:
        header("Location: ../index.php?sec=carrito");
        break;
}

exit;
