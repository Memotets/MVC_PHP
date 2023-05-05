<?php
    require_once 'models/clientesModel.php';
    require_once 'models/estudiosModel.php';

    class Ordenes extends Controller{
        function __construct(){
            parent::__construct();
            $this->view->clientes = [];
            $this->view->estudios = [];
            $this->view->response = "";
        }

        function render($response = null){
            $clientesModel = new ClientesModel();
            $clientes = $clientesModel->fetchDatosClientes(); 
            $this->view->clientes = $clientes;
            $estudiosModel = new EstudiosModel();
            $estudios = $estudiosModel->fetchDatosEstudios();
            $this->view->estudios = $estudios;

            if ($response != null) {
                $this->view->response = $response;
            }

            $this->view->render('ordenes/index');
        }

        function realizarOrdenes(){
            $folio = $_POST['folio'];
            $cliente = $_POST['cliente'];
            $estudios = $_POST['estudios'];

            $estudiosArt = array();
            $preciosUnitarios = array();
            $total = 0;

            if (isset($_POST['estudios'])) {
                
                foreach ($estudios as $estudio) {
                  list($claveArt, $precio) = explode('-', $estudio);
                  // hacer algo con $claveArt y $precio
                  array_push($estudiosArt, $claveArt);
                  array_push($preciosUnitarios, $precio);
                  $total += $precio;
                }
            }

            if (empty($folio) || empty($cliente) || empty($estudios)) {
                echo "<script>alert('Favor de llenar todos los campos');</script>";
                $this->render();
                return;
            }
            $msg = "";
            if ($this->model->setOrden($folio, $cliente, $total)){
                $msg = "Orden creada con exito";
            }else{
                $msg = "Error al crear la orden";
            }

            if ($this->model->setOrdenesPartidas($folio, $estudiosArt, $preciosUnitarios)){
                $msg = $msg." Y Estudios agregados con exito";
            }else{
                $msg = $msg." Pero hubo un error al agregar los estudios";
            }


            $this->render($msg);
        }
    }
?>