<?php
require_once '/../persistence/Persistence.php';
class Pedido {
    private $_id;
    private $_estado;
    private $_fecha;
    private $_productoId;

    public function __construct($id="", $estado="", $fecha="", $productoId=""){
        $this->_id = $id;
        $this->_estado = $estado;
        $this->_fecha = $fecha;
        $this->_productoId = $productoId;
    }
    public function get_id() {
        return $this->_id;
    }

    public function get_estado() {
        return $this->_estado;
    }

    public function get_fecha() {
        return $this->_fecha;
    }

    public function get_productoId() {
        return $this->_productoId;
    }

    public function  listar($table){
        $sql = new SQL();
        $sql->addTable($table);
        $sql->setOpcion('listar');
        $pedidos= array();
        $lista = Persistence::consultar($sql);
        foreach($lista as $pedido){
            $id = $pedido['id'];
            $estado = $pedido['estado'];
            $fecha = $pedido['fecha'];
            $productoId = $pedido['idProducto'];
            $pedidos[] = new Pedido($id, $estado, $fecha, $productoId);
        }
        return $pedidos;
    }

    public function ingresar($table, $estado, $fecha, $productoId){
        $sql = new SQL();
        $sql->addTable($table);
        $sql->setOpcion('insert');
        $sql->addInto('id'."`,`".'estado'."`,`".'fecha'."`,`".'idProducto');
        $sql->addValues('NULL'."','".$estado."','".$fecha."','".$productoId);
        Persistence::insertar($sql);
    }
}
?>
