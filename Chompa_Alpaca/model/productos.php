<?php
require_once '/../persistence/Persistence.php';
class productos {

    private $_id;
    private $_nombre;
    private $_stock;
    private $_precio;
    private $_insumo;

    public function __construct($id="", $nombre="", $stock="", $precio="", $insumo="") {
        $this->_id = $id;
        $this->_nombre = $nombre;
        $this->_stock = $stock;
        $this->_precio = $precio;
        $this->_insumo = $insumo;
    }

    public function get_id() {
        return $this->_id;
    }

    public function get_nombre() {
        return $this->_nombre;
    }

    public function get_stock() {
        return $this->_stock;
    }

    public function get_precio() {
        return $this->_precio;
    }

    public function get_insumo() {
        return $this->_insumo;
    }
    
    public function  listar($table){
        $sql = new SQL();
        $sql->addTable($table);
        $sql->setOpcion('listar');
        $productos= array();
        $lista = Persistence::consultar($sql);
        foreach($lista as $producto){
            $id = $producto['id'];
            $nombre = $producto['nombre'];
            $stock = $producto['stock'];
            $precio = $producto['precio'];
            $insumo = $producto['insumo'];
            $productos[] = new productos($id, $nombre, $stock, $precio, $insumo);
        }
        return $productos;
    }

    public function modificar($table){
        $sql = new SQL();
        $sql->addTable($table);
        $sql->setOpcion('update');
        $sql->addSet("`".'stock'."`"."="."'".$this->_stock."'");
        $sql->addWhere("`id`= ".$this->_id);
        Persistence::modificar($sql);
    }

}

?>
