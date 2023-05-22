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
        $this->RenderView("Home/Index", $viewData);
    }

    //para cargar las fechas en la jcombo
    public function cargarConsulta()
    {
        if (!isset($_POST['dui'])) {
            header('location: ' . URL);
        }

        $numero_dui = $_POST['dui'];

        $viewData['datosConsulta'] = $this->homeModel->getUserByDUI($numero_dui);
        $viewData["title"] = "Busqueda de consultas";

        $this->RenderView("Home/Index", $viewData);
    }
}
