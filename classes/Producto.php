<?php
require_once "Conexion.php";
require_once "Marca.php";

class Producto
{
    private $id_producto;    
    private $id_marca;    
    private $nombre;    
    private $presentacion;
    private $precio;    
    private $foto;
    private $marca; //nombre de la marca

    private static $createValues = ['id_producto', 'id_marca', 'nombre', 'presentacion', 'precio', 'foto'];

    public function getIdProducto() { return $this->id_producto; }
    public function getIdMarca() { return $this->id_marca; }
    public function getMarca() { return $this->marca->getMarca(); }
    public function getNombre() { return $this->nombre; }
    public function getPresentacion() { return $this->presentacion; }
    public function getPrecio() { return $this->precio; }
    public function getFoto() { return $this->foto; }

    private static function createProducto($productoData): Producto
    {
        $producto = new self();
        foreach (self::$createValues as $value) {
            $producto->{$value} = $productoData[$value];
        }
        $producto->marca = Marca::get_x_id($productoData['id_marca']);
        return $producto;
    }

    public function todosProductos(): array
    {
        $conexion = (new Conexion())->getConexion();
        $query = "SELECT p.*, m.marca
                  FROM productos AS p
                  LEFT JOIN marcas AS m ON p.id_marca = m.id_marca";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
        $PDOStatement->execute();

        $catalogo = [];
        while ($result = $PDOStatement->fetch()) {
            $catalogo[] = self::createProducto($result);
        }

        return $catalogo;
    }

    public static function insert(int $id_marca, string $nombre, string $presentacion, float $precio, string $foto)
    {
        $conexion = Conexion::getConexion();
        $query = "INSERT INTO productos (`id_marca`, `nombre`, `presentacion`, `precio`, `foto`)
                  VALUES (:id_marca, :nombre, :presentacion, :precio, :foto)";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute([
            'id_marca' => $id_marca,
            'nombre' => $nombre,
            'presentacion' => $presentacion,
            'precio' => $precio,
            'foto' => $foto
        ]);
        return $conexion->lastInsertId();
    }

    public static function get_x_id(int $id): ?Producto
    {
        $conexion = Conexion::getConexion();
        $query = "SELECT p.id_producto, p.id_marca, m.marca, p.nombre, p.presentacion, p.precio, p.foto
                  FROM productos AS p
                  INNER JOIN marcas AS m ON p.id_marca = m.id_marca
                  WHERE p.id_producto = :id";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
        $PDOStatement->execute(["id" => $id]);

        while ($result = $PDOStatement->fetch()) {
            $producto = self::createProducto($result);
        }

        return $producto ?? null;
    }

    public function edit($id_marca, $nombre, $presentacion, $precio, $foto)
    {
        $conexion = (new Conexion())->getConexion();
        $query = "UPDATE productos
                  SET id_marca = :id_marca, nombre = :nombre, presentacion = :presentacion, precio = :precio, foto = :foto
                  WHERE id_producto = :id";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute([
            "id" => $this->id_producto,
            "id_marca" => $id_marca,
            "nombre" => $nombre,
            "presentacion" => $presentacion,
            "precio" => $precio,
            "foto" => $foto
        ]);
    }

    public function delete()
    {
        $conexion = (new Conexion())->getConexion();
        $query = "DELETE FROM productos WHERE id_producto = :id";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute(["id" => $this->id_producto]);
    }

    public function filtrarProductos($marca = null, $min = null, $max = null): array
    {
        $conexion = Conexion::getConexion();
        $query = "SELECT p.*, m.marca
                  FROM productos AS p
                  LEFT JOIN marcas AS m ON p.id_marca = m.id_marca
                  WHERE 1=1";

        $params = [];

        if ($marca) {
            $query .= " AND p.id_marca = :marca";
            $params['marca'] = $marca;
        }

        if ($min !== null && is_numeric($min)) {
            $query .= " AND p.precio >= :min";
            $params['min'] = $min;
        }

        if ($max !== null && is_numeric($max)) {
            $query .= " AND p.precio <= :max";
            $params['max'] = $max;
        }

        $stmt = $conexion->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute($params);

        $productos = [];
        while ($row = $stmt->fetch()) {
            $productos[] = self::createProducto($row);
        }

        return $productos;
    }
}
?>
