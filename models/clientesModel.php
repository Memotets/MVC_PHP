<?php
Class Cliente{
    public $id;
    public $clave_cli;
    public $nombre;
    public $email;

    public function __construct($id, $clave_cli, $nombre, $email){
        $this->id = $id;
        $this->clave_cli = $clave_cli;
        $this->nombre = $nombre;
        $this->email = $email;
    }
}

Class ClientesModel extends Model {
    public function __construct(){
        parent::__construct();
    }

    function fetchDatosClientes(){
        $items = [];
        try{
            $query = $this->db->connect()->query("SELECT * FROM clientes");
            while($row = $query->fetch()){
                $item = new Cliente($row['id'], $row['clave_cli'], $row['nombre'], $row['email']);
                array_push($items, $item);
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }

    function searchClienteByName($name){
        $items = [];
        try{
            $query = $this->db->connect()->query("SELECT * FROM clientes WHERE nombre LIKE '%$name%'");
            while($row = $query->fetch()){
                $item = new Cliente($row['id'], $row['clave_cli'], $row['nombre'], $row['email']);
                array_push($items, $item);
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    } 
}