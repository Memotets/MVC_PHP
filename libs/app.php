<?php
require_once('controllers/error404.php');
class App{
    function __construct(){
        $url = isset($_GET['url']) ? $_GET['url']:null;
        $url = rtrim($url, '/');
        $url = explode('/', $url);

        //inicio sin controlador definido
        if(empty($url[0])){
            $archivoController = 'controllers/main.php';
            require_once($archivoController);
            $controller = new Main();
            $controller->loadModel('main');
            $controller->render();
            return false;
        }else{
            $controller = $url[0];
            $archivoController = 'controllers/' . $controller . '.php';
            if(file_exists($archivoController)){
                require_once($archivoController);
                $controller = new $controller();
                $controller->loadModel($url[0]);
                //si exite un metodo por cargar
                if(isset($url[1])){
                    $controller->{$url[1]}();
                }else{
                    $controller->render();
                }
            }else{
                $controller = new Error404();
            }

        }
    }
}
?>