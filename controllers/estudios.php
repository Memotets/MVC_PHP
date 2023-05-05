<?php
    class Estudios extends Controller{
        function __construct(){
            parent::__construct();
            $this->view->datos = [];
        }
        
        function render($modelFunction = null){
            $estudios;
            if($modelFunction != null){
                $estudios = $modelFunction();
            }else{
                $estudios = $this->model->fetchDatosEstudios();
            }
            $this->view->datos = $estudios;
            $this->view->render('estudios/index');
        }

        function searchEstudioByDescription(){
            $descrip = $_POST['search'];
            $func = function() use ($descrip){
                return $this->model->searchEstudioByDescription($descrip);
            };
            $this->render($func);
        }
    }

?>