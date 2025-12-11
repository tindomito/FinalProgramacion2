<?php
session_start();
require_once "../classes/Carrito.php";

$action = $_REQUEST['action'] ?? null;
$id_producto = isset($_REQUEST['id_producto']) ? (int)$_REQUEST['id_producto'] : null;
$cantidad = isset($_REQUEST['cantidad']) ? (int)$_REQUEST['cantidad'] : 1;
$redirect = $_REQUEST['redirect'] ?? 'carrito';

switch ($action) {
    case 'agregar':
        if ($id_producto) {
            Carrito::agregar($id_producto, $cantidad);
            header("Location: ../index.php?sec=$redirect&msg=agregado");
        } else {
            header("Location: ../index.php?sec=filtro");
        }
        break;

    case 'eliminar':
        if ($id_producto) {
            Carrito::eliminar($id_producto);
            header("Location: ../index.php?sec=carrito&msg=eliminado");
        } else {
            header("Location: ../index.php?sec=carrito");
        }
        break;

    case 'actualizar':
        if ($id_producto && $cantidad !== null) {
            Carrito::actualizarCantidad($id_producto, $cantidad);
            header("Location: ../index.php?sec=carrito&msg=actualizado");
        } else {
            header("Location: ../index.php?sec=carrito");
        }
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
?>
