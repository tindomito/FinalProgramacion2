<?php
class Persona
{
    private $_id;
    private $_nombre;
    private $_telefono;
    private $_email;
    private $_pais;
    private $_edad;

    public function getId(){
        return $this->_id;
    }
    public function getNombre(){
        return $this->_nombre;
    }
    public function getTelefono(){
        return $this->_telefono;
    }
    public function getEmail(){
        return $this->_email;
    }
    public function getPais(){
        return $this->_pais;
    }
    public function getEdad(){
        return $this->_edad;
    }

    public function setId($id){
        $this->_id = $id;
    }
    public function setNombre($nombre){
        $this->_nombre = $nombre;
    }
    public function setTelefono($telefono){
        $this->_telefono = $telefono;
    }
    public function setEmail($email){
        $this->_email = $email;
    }
    public function setPais($pais){
        $this->_pais = $pais;
    }
    public function setEdad($edad){
        $this->_edad = $edad;
    }



}
?>