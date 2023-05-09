<?php

require_once "Conexion.php";

class Model 
{

    public $conexion;

    public function __construct()
    {
        $conexionOb = new Conexion();
        $this->conexion = $conexionOb->getConexion();
    }
}