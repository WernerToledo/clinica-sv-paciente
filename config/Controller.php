<?php

class Controller
{

    public function __construct()
    {
    }

    public function RenderView($view = 'Index', $viewData = array())
    {
        $view = strtolower($view);

        if (file_exists("views/{$view}.php")) {
            require_once "views/{$view}.php";
        }
    }
}
