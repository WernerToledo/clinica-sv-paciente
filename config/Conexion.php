<?php

class Conexion
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = new PDO("mysql:host=" . base64_decode(HOST) . ";dbname=" . base64_decode(DB_NAME) . "", base64_decode(USER), base64_decode(PASSWORD));
        $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if ($this->conexion == null) {
            echo "Error al hacer la conexion. Intente comunicarse con su desarrollador";
            exit(0);
        }
    }

    public function getConexion()
    {
        return $this->conexion;
    }
}
