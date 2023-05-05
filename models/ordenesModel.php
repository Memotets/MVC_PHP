<?php
Class Orden{
    public $id;
    public $folio;
    public $cliente;
    public $precio;

    public function __construct($id, $folio, $cliente, $precio){
        $this->id = $id;
        $this->folio = $folio;
        $this->cliente = $cliente;
        $this->precio = $precio;
    }
}

Class OrdenPartida{
    public $id;
    public $venta;
    public $articulo;
    public $precioUnitario;

    public function __construct($id, $venta, $articulo, $precioUnitario){
        $this->id = $id;
        $this->venta = $venta;
        $this->articulo = $articulo;
        $this->precioUnitario = $precioUnitario;
    }
}

Class OrdenesModel extends Model{
    public function __construct(){
        parent::__construct();
    }

    function fetchDatosOrdenes(){
        $items = [];
        try{
            $query = $this->db->connect()->query("SELECT * FROM ordenes");
            while($row = $query->fetch()){
                $item = new Orden($row['id'], $row['folio'], $row['cliente'], $row['precio']);
                array_push($items, $item);
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }

    function setOrden($folio, $cliente, $precio){
        try{
            $query = $this->db->connect()->prepare('INSERT INTO ordenes (folio, cliente, precio) VALUES (:folio, :cliente, :precio)');
            $query->execute(['folio' => $folio, 'cliente' => $cliente, 'precio' => $precio]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }

    function fetchDatosOrdenesPartidas(){
        $items = [];
        try{
            $query = $this->db->connect()->query("SELECT * FROM ordenes_partidas");
            while($row = $query->fetch()){
                $item = new OrdenPartida($row['id'], $row['venta'], $row['articulo'], $row['precioUnitario']);
                array_push($items, $item);
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }

    function searchOrdenesPartidasByFolio($venta){
        $items = [];
        try{
            $query = $this->db->connect()->prepare("SELECT * FROM ordenes_partidas WHERE venta = :venta");
            $query->execute(['venta' => $venta]);
            while($row = $query->fetch()){
                $item = new OrdenPartida($row['id'], $row['venta'], $row['articulo'], $row['precioUnitario']);
                array_push($items, $item);
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }

    function setOrdenPartida($venta, $articulo, $precio){
        try{
            $query = $this->db->connect()->prepare('INSERT INTO ordenes_partidas (venta, articulo, precio) VALUES (:venta, :articulo, :precio)');
            $query->execute(['venta' => $venta, 'articulo' => $articulo, 'precio' => $precio]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }

    function setOrdenesPartidas($venta, $litaArticulos, $preciosUnitarios){
        try{
            $query = $this->db->connect()->prepare('INSERT INTO ordenes_partidas (venta, articulo, precioUnitario) VALUES (:venta, :articulo, :precioUnitario)');
            for ($i=0; $i < count($litaArticulos); $i++) { 
                $query->execute(['venta' => $venta, 'articulo' => $litaArticulos[$i], 'precioUnitario' => $preciosUnitarios[$i]]);
            }
            return true;
        }catch(PDOException $e){
            echo "<script>alert('".$e->getMessage()."');</script>";
            return false;
        }
    }
}
?>