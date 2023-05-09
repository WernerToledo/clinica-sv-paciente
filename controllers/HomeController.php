<?php

require_once "models/HomeModel.php";


class HomeController extends Controller
{
    private $homeModel;

    public function __construct()
    {
        $this->homeModel = new HomeModel();
    }

    public function Index()
    {
        $viewData["title"] = "Busqueda de consultas";
        $viewData["fechas"] = array();
        $this->RenderView("Home/Index", $viewData);
    }

    //para cargar las fechas en la jcombo
    public function cargarConsulta()
    {
        if (!isset($_POST['dui'])) {
            header("location: " . URL. "Home/index");
        }

        $dui = $_POST['dui'];
        $datos = $this->homeModel->cargarFechas($dui);

        $viewData["title"] = "Busqueda de consultas";
        $viewData["fechas"] = $datos;

        $this->RenderView("Home/Index", $viewData);
    }

    //controlador de la tabla consulta en base a fechas y id
    public function cargarConsultasFechas()
    {
        $stm;

        if (!isset($_POST['fecha']) && !isset($_POST['id'])) {
            header("location: " . URL);
        }

        $fecha = $_POST['fecha'];
        $id_consulta = $_POST['id'];
        

        $datos = $this->homeModel->cargarTablaConsultaFecha($fecha, $id_consulta);

        $viewData["title"] = "Filtrado de consultas";
        $viewData["fechas"] = $datos;

        $this->RenderView("Home/Index", $viewData);
    }

    public function vistaMedicamento(){
        if (!isset($_GET['id'])) {
            header("location: " . URL);
        }

        
        $id = $_GET['id'];
        $datos = $this->homeModel->cargarMedicamentos($id);
        

        $viewData["title"] = "Busqueda de medicamentos";
        $viewData["medicamentos"] = $datos;

        $this->RenderView("Home/medicamentos", $viewData);
    }
}
