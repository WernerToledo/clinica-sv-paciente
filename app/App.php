<?php

class App
{
    public function __construct()
    {
        //Obtener la url formateada { Controller/Action }
        $url = $this->ObtenerURL();

        $controller = $url['controller'];
        $classController = "{$controller}Controller";
        $action = $url['action'];

        // Ruta de los archivos
        $pathController = "controllers/{$classController}.php";

        // Verificar si existe el controlador
        if (file_exists($pathController)) :
            require_once $pathController;
        else :
            require_once "controllers/ErrorController.php";
            $classController = "ErrorController";
        endif;

        // Instancia del controlador
        $controllerObj = new $classController;

        // verificar si existe el action
        if (method_exists($controllerObj, $action)) {
            $controllerObj->{$action}();
        } else {
            header('location: ' . URL . 'Error/Index');
        }
    }

    private function ObtenerURL()
    {

        $url = $_GET['url'] ?? DEFAULT_URL;
        $url = rtrim($url, '/');
        $url = explode("/", $url);

        return array(
            "controller" => $url[0] ?? DEFAULT_CONTROLLER,
            "action" => $url[1] ?? DEFAULT_ACTION,
        );
    }
}
