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

    public function BuscarConsulta($idConsulta)
    {
        $datos = [
            "datos" => array(),
            "estado" => 404,
            "mensaje" => "No existen datos en la tabla"
        ];

        try {

            $sql = "SELECT
                    us.dui , 
                    us.id_usuario , 
                    us.nombre,
                    us.carnet , 
                    re.medicamento,
                    con.fecha_consulta,
                    con.descripcion , 
                    con.padecimientos, 
                    con.alergias,
                    con.id_consulta,
                    (SELECT doc.nombre FROM usuario doc WHERE doc.id_usuario = con.id_doctor) as doctor
            FROM consulta con
            JOIN usuario us ON us.id_usuario = con.id_usuario_paciente
            JOIN receta re ON con.id_consulta = re.id_consulta
            WHERE con.estado = 'A' AND con.id_consulta = :idConsult";

            $stmt = $this->conexion->prepare($sql);

            $stmt->bindParam(':idConsult', $idConsulta);

            $stmt->execute();

            $consulta = $stmt->fetch();

            $datos["datos"] = $consulta;
            $datos["estado"] = 202;
            $datos["mensaje"] = "Peticion exitosa";
        } catch (\Throwable $th) {
            $datos["mensaje"] = "Sucedio un error al ejecutar la petición " . $th->getMessage();
        }

        return $datos;
    }
}
