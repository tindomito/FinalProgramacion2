<?php
class Marca
{
    private $id_marca;	
    private $marca;	

    public function getIdMarca()
    {
        return $this->id_marca;
    }
    
    public function getMarca()
    {
        return $this->marca;
    }
    
    /**
     * 
     * Obtiene todas las marcar de la base de datos
     */
    public function todasMarcas():array
    {
        // $conexion = (new Conexion())->getConexion
        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM marcas";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute();

        $lista = $PDOStatement->fetchAll();

        return $lista;
    }
    /**
     * Inserta una nueva marca en la base de datos
    */
    public static function insert(string $marca)
    {
        $conexion = Conexion::getConexion();
        // $conexion = (new Conexion())->getConexion();
        $query = "INSERT INTO marcas (`marca`) VALUES (:marca)";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute([
            'marca' => $marca
        ]);
    }



    /**
     * Obtiene una marca por id
     * 
    */
    public static function get_x_id(int $id): ?Marca
    {
        $conexion = Conexion::getConexion();
        // $conexion = (new Conexion())->getConexion();
        $query = "SELECT * FROM marcas WHERE id_marca = :id";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute(["id" => $id]);

        $lista = $PDOStatement->fetch();

        return !empty($lista) ? $lista : null;
    }
    /**
     * Edita una instancia de marca
     */
    public function edit($marca)
    {
        $conexion = Conexion::getConexion();
        // $conexion = (new Conexion())->getConexion();
        $query = "UPDATE marcas SET marca = :nombreMarca
          WHERE id_marca = :id";
        // print_r($this->id_marca);
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute([
                        "nombreMarca"   => $marca, 
                        "id"            => $this->id_marca
                        // "id"            => $id
                    ]);
    }

    /**
     * Borra una instancia de marca
     */
    public function delete()
    {
        $conexion = Conexion::getConexion();
        // $conexion = (new Conexion())->getConexion();
        $query = "DELETE FROM marcas WHERE id_marca = :id";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute([
                        "id"    => $this->id_marca
                    ]);
    }
}

?>