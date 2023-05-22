<?php

class HomeModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    // OBTENER DATOS POR DUI
    public function getUserByDUI($numero_dui)
    {
        try {

            $sql = "SELECT * FROM consulta C
            JOIN USUARIO U ON C.id_usuario_paciente = U.id_usuario
            JOIN receta R ON R.id_consulta = C.id_consulta
            WHERE u.dui = :dui AND c.estado != 'C'";

            $stmt = $this->conexion->prepare($sql);

            $stmt->bindParam(':dui', $numero_dui);

            $stmt->execute();

            $datos = $stmt->fetchAll();

            return $datos;
        } catch (\Throwable $th) {
            return array();
        }

        return array();
    }
}
