<?php

class HomeModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    //metodo para cargar todas las consultas del paciente
    public function cargarFechas($dui)
    {
        $stm_id = $this->conexion->prepare("SELECT id_usuario FROM usuario WHERE dui = $dui");
        $stm_id->execute();
        $id = $stm_id->fetch();

        $lFechas = array();

        if ($id == false) {
            header("location: " . URL. "Home/index");
        }

        $id = $id['id_usuario'];

        $stm_lFechas = $this->conexion->prepare("SELECT  us.id_usuario, c.id_consulta, us.nombre, c.padecimientos, c.alergias, c.descripcion, c.fecha_consulta FROM consulta c
                                                JOIN usuario us ON c.id_usuario_paciente = us.id_usuario
                                                WHERE us.id_tipo_usuario IS NULL AND us.id_usuario = $id;");
        $stm_lFechas->execute();
        $lFechas = $stm_lFechas->fetchAll();

        return $lFechas;
    }

    //metodo para cargar las consultas en base a una fecha especifica y id del paciente
    public function cargarTablaConsultaFecha($fecha, $id)
    {
        $stm = $this->conexion->prepare("SELECT us.id_usuario, c.id_consulta, us.nombre, c.padecimientos, c.alergias, c.descripcion, c.fecha_consulta FROM consulta c
                                            JOIN usuario us ON c.id_usuario_paciente = us.id_usuario
                                            WHERE us.id_tipo_usuario IS NULL AND us.id_usuario = $id AND c.fecha_consulta = '$fecha';");
        $stm->execute();

        $lFechas = array();

        $lFechas = $stm->fetchAll();

        
        return $lFechas;
    }

    //metodo para cargar los medicamentos de un paciente 
    public function cargarMedicamentos($id)
    {
        $stm_medicamentos = $this->conexion->prepare("SELECT medicamento, preescripcion FROM receta
                                                    WHERE id_consulta = $id;");
        $stm_medicamentos->execute();
        $lmedicamentos = array();
        $lmedicamentos = $stm_medicamentos->fetchAll();

        return $lmedicamentos;
    }
}
