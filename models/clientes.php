<?php
require_once 'conexion.php';

class Cliente extends Conexion
{
    public $cli_id;
    public $cli_nombre;
    public $cli_apellido;
    public $cli_telefono;
    public $cli_email;
    public $cli_situacion;

    public function __construct($args = [])
    {
        $this->cli_id = $args['cli_id'] ?? null;
        $this->cli_nombre = $args['cli_nombre'] ?? '';
        $this->cli_apellido = $args['cli_apellido'] ?? '';
        $this->cli_telefono = $args['cli_telefono'] ?? '';
        $this->cli_email = $args['cli_email'] ?? '';
        $this->cli_situacion = $args['cli_situacion'] ?? '';
    }

    public function guardar(){
        $sql = "INSERT INTO Clientes(cli_nombre, cli_apellido, cli_telefono, cli_email) VALUES ('$this->cli_nombre', '$this->cli_apellido', '$this->cli_telefono', '$this->cli_email')";
        $resultado = $this->ejecutar($sql);
        return $resultado; 
    }

    public function buscar()
    {
        $sql = "SELECT * FROM Clientes WHERE cli_situacion = 1 ";

        if($this->cli_nombre != ''){
            $sql .= " AND cli_nombre LIKE '%$this->cli_nombre%' ";
        }
        if($this->cli_apellido != ''){
            $sql .= " AND cli_apellido LIKE '%$this->cli_apellido%' ";
        }

        $resultado = self::servir($sql);
        return $resultado;
    }

    public function modificar(){
        $sql = "UPDATE Clientes SET cli_nombre = '$this->cli_nombre', cli_apellido = '$this->cli_apellido', cli_telefono = '$this->cli_telefono', cli_email = '$this->cli_email' WHERE cli_id = $this->cli_id ";
        $resultado = $this->ejecutar($sql);
        return $resultado;
    }    
   
    public function eliminar(){
        $sql = "UPDATE Clientes SET cli_situacion = 0 WHERE cli_id = '$this->cli_id' ";
        $resultado = $this->ejecutar($sql);
        return $resultado; 
    }
}
