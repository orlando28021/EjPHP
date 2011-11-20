<?php
require_once '../dm/Persistence.php';
require_once '../dm/Sql.php';
class DetallePedidoProducto {
    private $_pedidoId;
    private $_productoId;
    private $_cantidad;

    public function __construct($pedidoId="", $productoId="", $cantidad=""){
        $this->_pedidoId = $pedidoId;
        $this->_productoId = $productoId;
        $this->_cantidad = $cantidad;
    }
    
    public function get_pedidoId() {return $this->_pedidoId;}
    public function get_productoId() {return $this->_productoId;}
    public function get_cantidad() {return $this->_cantidad;}

    public function set_pedidoId($_pedidoId) {
        $this->_pedidoId = $_pedidoId;
    }
    public function set_productoId($_productoId) {
        $this->_productoId = $_productoId;
    }
    public function set_cantidad($_cantidad) {
        $this->_cantidad = $_cantidad;
    }
    
    private function _traerDatos(){
        $sql = new Sql();
        $sql->addTable('detallePedidoProductos');
        $sql->setOpcion('listar');
        $lista = Persistence::consultar($sql);
        return $lista;
    } 
    
    public function getAll(){
        $lista = $this->_traerDatos();      
        foreach($lista as $value){
            $pedidoId = $value['pedidoId'];
            $productoId = $value['productoId'];
            $cantidad = $value['cantidad'];
            $arreglo[] = new DetallePedidoProducto($pedidoId, $productoId, $cantidad);
        }
        return $arreglo;
    }
    
    public function insertarDetallePedidoProducto(){
        $sql = new Sql();
        $sql->addTable('detallePedidoProductos');
        $sql->setOpcion('insert');
        
        $sql->addInto('pedidoId');
        $sql->addInto('productoId');
        $sql->addInto('cantidad');
        
        $sql->addValues($this->_pedidoId);
        $sql->addValues($this->_productoId);
        $sql->addValues($this->_cantidad);
        
        Persistence::insertar($sql);
    }

    public function eliminarDetallePedidoProductoByPedidoId($id) {
        $sql = new Sql();
        $sql->addTable('detallePedidoProductos');
        $sql->setOpcion('delete');
        $sql->addWhere("`pedidoId =`".$id);
        
        Persistence::eliminar($sql);
    }
    
    public function eliminarDetallePedidoProductoByProductoId($id) {
        $sql = new Sql();
        $sql->addTable('detallePedidoProductos');
        $sql->setOpcion('delete');
        $sql->addWhere("`productoId =`".$id);
        
        Persistence::eliminar($sql);
    } 

}
?>
