<?php
Class Estudio{
    public $id;
    public $clave_art;
    public $descrip;
    public $precio;

    public function __construct($id, $clave_art, $descrip, $precio){
        $this->id = $id;
        $this->clave_art = $clave_art;
        $this->descrip = $descrip;
        $this->precio = $precio;
    }
}

Class EstudiosModel extends Model {
    public function __construct(){
        parent::__construct();
    }

    function fetchDatosEstudios(){
        $items = [];
        try{
            $query = $this->db->connect()->query("SELECT * FROM estudios");
            while($row = $query->fetch()){
                $item = new Estudio($row['id'], $row['clave_art'], $row['descrip'], $row['precio']);
                array_push($items, $item);
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }

    function searchEstudioByDescription($descrip){
        $items = [];
        try{
            $query = $this->db->connect()->query("SELECT * FROM estudios WHERE descrip LIKE '%$descrip%'");
            while($row = $query->fetch()){
                $item = new Estudio($row['id'], $row['clave_art'], $row['descrip'], $row['precio']);
                array_push($items, $item);
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    } 
}