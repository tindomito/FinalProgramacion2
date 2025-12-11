<?php
require_once __DIR__ . "/Producto.php";

class Carrito
{
    private const SESSION_KEY = 'carrito';

    public static function agregar(int $id_producto, int $cantidad = 1): bool
    {
        $producto = Producto::get_x_id($id_producto);
        if (!$producto) {
            return false;
        }

        if (!isset($_SESSION[self::SESSION_KEY])) {
            $_SESSION[self::SESSION_KEY] = [];
        }

        if (isset($_SESSION[self::SESSION_KEY][$id_producto])) {
            $_SESSION[self::SESSION_KEY][$id_producto]['cantidad'] += $cantidad;
        } else {
            $_SESSION[self::SESSION_KEY][$id_producto] = [
                'id_producto' => $id_producto,
                'nombre' => $producto->getNombre(),
                'precio' => $producto->getPrecio(),
                'foto' => $producto->getFoto(),
                'cantidad' => $cantidad
            ];
        }

        return true;
    }

    public static function eliminar(int $id_producto): bool
    {
        if (isset($_SESSION[self::SESSION_KEY][$id_producto])) {
            unset($_SESSION[self::SESSION_KEY][$id_producto]);
            return true;
        }
        return false;
    }

    public static function actualizarCantidad(int $id_producto, int $cantidad): bool
    {
        if ($cantidad <= 0) {
            return self::eliminar($id_producto);
        }

        if (isset($_SESSION[self::SESSION_KEY][$id_producto])) {
            $_SESSION[self::SESSION_KEY][$id_producto]['cantidad'] = $cantidad;
            return true;
        }
        return false;
    }

    public static function obtenerItems(): array
    {
        return $_SESSION[self::SESSION_KEY] ?? [];
    }

    public static function contarItems(): int
    {
        $total = 0;
        foreach (self::obtenerItems() as $item) {
            $total += $item['cantidad'];
        }
        return $total;
    }

    public static function calcularTotal(): float
    {
        $total = 0;
        foreach (self::obtenerItems() as $item) {
            $total += $item['precio'] * $item['cantidad'];
        }
        return $total;
    }

    public static function vaciar(): void
    {
        $_SESSION[self::SESSION_KEY] = [];
    }

    public static function estaVacio(): bool
    {
        return empty($_SESSION[self::SESSION_KEY]);
    }
}
