<?php
require_once 'conexion.php';

class cliente extends Conexion
{
    public $cli_id;
    public $cli_nombre;
    public $cli_apellido;
    public $cli_nit;
    public $cli_telefono;
    public $cli_situacion;


    public function __construct($args = [])
    {
        $this->cli_id = $args['cli_id'] ?? null;
        $this->cli_nombre = $args['cli_nombre'] ?? '';
        $this->cli_apellido = $args['cli_apellido'] ?? '';
        $this->cli_nit = $args['cli_nit'] ?? '';
        $this->cli_telefono = $args['cli_telefono'] ?? '';
        $this->cli_situacion = $args['cli_situacion'] ?? '';
    }

    public function guardar()
    {
        $sql = "INSERT INTO clientes(cli_nombre, cli_apellido, cli_nit, cli_telefono) values('$this->cli_nombre', '$this->cli_apellido', '$this->cli_nit', '$this->cli_telefono')";
        $resultado = self::ejecutar($sql);
        return $resultado;
    }

    public function buscar()
    {
        $sql = "SELECT * from clientes where cli_situacion = 1 ";

        if ($this->cli_nombre != '') {
            $sql .= " and cli_nombre like '%$this->cli_nombre%' ";
        }

        if ($this->cli_apellido != '') {
            $sql .= " and cli_apellido like '%$this->cli_apellido%' ";
        }

        if ($this->cli_nit != '') {
            $sql .= " and cli_nit = $this->cli_nit ";
        }

        if ($this->cli_telefono != '') {
            $sql .= " and cli_telefono = $this->cli_telefono ";
        }

        if ($this->cli_id != null) {
            $sql .= " and cli_id = $this->cli_id ";
        }

        $resultado = self::servir($sql);
        return $resultado;
        
    }

    public function modificar()
    {
    $sql = "UPDATE clientes SET cli_nombre = '$this->cli_nombre', cli_apellido = '$this->cli_apellido', cli_nit = '$this->cli_nit', cli_telefono = '$this->cli_telefono' where cli_id = '$this->cli_id'";

    $resultado = self::ejecutar($sql);
    return $resultado;
    }

    public function eliminar()
    {
         $sql = "UPDATE clientes SET cli_situacion = 0 where cli_id = $this->cli_id";

         $resultado = self::ejecutar($sql);
         return $resultado;
     }
}
