<?php

class Usuario
{
    private $id_usuario;	
    private $usuario;	
    private $clave;	
    private $nombre;
    private $apellido;

    private static $createValues = ['id_usuario', 'usuario', 'clave', 'nombre', 'apellido'];

    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function getClave()
    {
        return $this->clave;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Encuentra un usuario por Username
     * @param string $username El nombre del usuario
     */
    public static function usuario_x_username(string $username): ?Usuario
    {
        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM usuarios WHERE usuario = ?";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute([$username]);

        $result = $PDOStatement->fetch();
        return $result ?: null;
    }

    /**
     * Obtiene un usuario por id
     */
    public static function get_x_id(int $id): ?Usuario
    {
        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM usuarios WHERE id_usuario = :id";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute(["id" => $id]);

        $result = $PDOStatement->fetch();
        return $result ?: null;
    }

    /**
     * Obtiene un usuario por id, solo su nombre
     */
    public static function get_x_id_nombre(int $id): ?Usuario
    {
        $conexion = Conexion::getConexion();
        $query = "SELECT id_usuario, nombre FROM usuarios WHERE id_usuario = :id";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute(["id" => $id]);

        $result = $PDOStatement->fetch();
        return $result ?: null;
    }
}
?>
