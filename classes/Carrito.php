<?php
require_once "Producto.php";

class Carrito
{
    private const SESSION_KEY = 'carrito';

    /**
     * Inicializa el carrito en la sesión si no existe
     */
    private static function init(): void
    {
        if (!isset($_SESSION[self::SESSION_KEY])) {
            $_SESSION[self::SESSION_KEY] = [];
        }
    }

    /**
     * Agrega un producto al carrito
     */
    public static function agregar(int $id_producto, int $cantidad = 1): bool
    {
        self::init();

        $producto = Producto::get_x_id($id_producto);
        if (!$producto) {
            return false;
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

    /**
     * Elimina un producto del carrito
     */
    public static function eliminar(int $id_producto): bool
    {
        self::init();

        if (isset($_SESSION[self::SESSION_KEY][$id_producto])) {
            unset($_SESSION[self::SESSION_KEY][$id_producto]);
            return true;
        }

        return false;
    }

    /**
     * Actualiza la cantidad de un producto en el carrito
     */
    public static function actualizarCantidad(int $id_producto, int $cantidad): bool
    {
        self::init();

        if ($cantidad <= 0) {
            return self::eliminar($id_producto);
        }

        if (isset($_SESSION[self::SESSION_KEY][$id_producto])) {
            $_SESSION[self::SESSION_KEY][$id_producto]['cantidad'] = $cantidad;
            return true;
        }

        return false;
    }

    /**
     * Obtiene todos los items del carrito
     */
    public static function obtenerItems(): array
    {
        self::init();
        return $_SESSION[self::SESSION_KEY];
    }

    /**
     * Obtiene el total de items en el carrito
     */
    public static function contarItems(): int
    {
        self::init();
        $total = 0;
        foreach ($_SESSION[self::SESSION_KEY] as $item) {
            $total += $item['cantidad'];
        }
        return $total;
    }

    /**
     * Calcula el total del carrito
     */
    public static function calcularTotal(): float
    {
        self::init();
        $total = 0;
        foreach ($_SESSION[self::SESSION_KEY] as $item) {
            $total += $item['precio'] * $item['cantidad'];
        }
        return $total;
    }

    /**
     * Vacía completamente el carrito
     */
    public static function vaciar(): void
    {
        $_SESSION[self::SESSION_KEY] = [];
    }

    /**
     * Verifica si el carrito está vacío
     */
    public static function estaVacio(): bool
    {
        self::init();
        return empty($_SESSION[self::SESSION_KEY]);
    }
}
?>
