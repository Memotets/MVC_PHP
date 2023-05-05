<?php
    class OrdenesSegmentadas extends Controller{
        function __construct(){
            parent::__construct();
            $this->loadModel('ordenes');
            $this->view->datos = [];
        }

        function render($modelFunction = null){
            $estudios;
            if($modelFunction != null){
                $estudios = $modelFunction();
            }else{
                $estudios = $this->model->fetchDatosOrdenesPartidas();
            }
            $this->view->datos = $estudios;
            $this->view->render('ordenesSegmentadas/index');
        }

        function searchOrdenesPartidasByFolio(){
            $folio = $_POST['search'];
            $func = function() use ($folio){
                return $this->model->searchOrdenesPartidasByFolio($folio);
            };
            $this->render($func);
        }
    }
?>