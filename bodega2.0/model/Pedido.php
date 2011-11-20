<?php
require_once '../dm/Persistence.php';
require_once '../dm/Sql.php';
class Pedido {
    private $_pedidoId;
    private $_fechaPedido;
    private $_estado;
    private $_total;

    public function __construct($id="", $fechaPedido="", $estado="",$total=""){
        $this->_id = $id;
        $this->_fechaPedido = $fechaPedido;
        $this->_estado = $estado;
        $this->_total= $total;
    }
    public function get_pedidoId() {
        return $this->_pedidoId;
    }
    public function get_fechaPedido() {
        return $this->_fechaPedido;
    }
    
    public function get_estado() {
        return $this->_estado;
    }

    public function get_total() {
        return $this->_total;
    }

    public function set_estado($_estado) {
        $this->_estado = $_estado;
    }

    public function set_total($_total) {
        $this->_total = $_total;
    }

        
    public function set_pedidoId($_pedidoId) {
        $this->_pedidoId = $_pedidoId;
    }
    public function set_fechaPedido($_fechaPedido) {
        $this->_fechaPedido = $_fechaPedido;
    }

    
    private function _traerDatos(){
        $sql = new Sql();
        $sql->addTable('pedidos');
        $sql->setOpcion('listar');
        $lista = Persistence::consultar($sql);
        return $lista;
    }  
    
    public function getAll() {
        $lista = $this->_traerDatos();      
        foreach($lista as $value){
            $id = $value['idPedido'];
            $fechaPedido = $value['fecha'];
            $estado = $value['estado'];
            $total = $value['total'];
            $arreglo[] = new Pedido($id, $fechaPedido, $estado,$total);
        }
        return $arreglo;
    }

    

    public function insertarProveedor() {
        $sql = new Sql();
        $sql->addTable('pedidos');
        $sql->setOpcion('insert');
        
        $sql->addInto('idPedido');
        $sql->addInto('fecha');
        $sql->addInto('estado');
        $sql->addInto('total');
        
        $sql->addValues($this->_id);
        $sql->addValues($this->_fechaPedido);
        $sql->addValues($this->_estado);
        $sql->addValues($this->_total);
        
        Persistence::insertar($sql);
    }

    public function eliminarPedido($id) {
        $sql = new Sql();
        $sql->addTable('pedidos');
        $sql->setOpcion('delete');
        $sql->addWhere("`idPedido =`".$id);
        
        Persistence::eliminar($sql);
    }


}
?>
