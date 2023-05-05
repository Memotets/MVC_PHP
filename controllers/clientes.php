<?php
    class Clientes extends Controller{
        function __construct(){
            parent::__construct();
            $this->view->datos = [];
        }

        function render($modelFunction = null){
            $clientes;
            if($modelFunction != null){
                $clientes = $modelFunction();
            }else{
                $clientes = $this->model->fetchDatosClientes();
            }
            $this->view->datos = $clientes;
            $this->view->render('clientes/index');
        }

        function searchClienteByName(){
            $name = $_POST['search'];
            $func = function() use ($name){
                return $this->model->searchClienteByName($name);
            };
            $this->render($func);
        }


    }


?>