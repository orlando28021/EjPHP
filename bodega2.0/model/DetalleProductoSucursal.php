<?php
require_once '../dm/Persistence.php';
require_once '../dm/Sql.php';
class DetalleProductoSucursal {
    private $_sucursalId;
    private $_productoId;
    
    private $_lista;
    
    function __construct($_sucursalId="", $_productoId="") {
        $this->_sucursalId = $_sucursalId;
        $this->_productoId = $_productoId;
    }
    public function get_sucursalId() {
        return $this->_sucursalId;
    }

    public function get_productoId() {
        return $this->_productoId;
    }
    
    private function _traerDatos(){
        $sql = new Sql();
        $sql->addTable('detalleProductoSucursales');
        $sql->setOpcion('listar');
        $lista = Persistence::consultar($sql);
        return $lista;
    } 
    
    public function getAll() {
        $lista = $this->_traerDatos();      
        foreach($lista as $value){
            $_sucursalId = $value['sucursalId'];
            $_productoId = $value['productoId'];
            $arreglo[] = new DetalleProductoSucursal($_sucursalId, $_productoId);
        }
        return $arreglo;
    }   
    
    public function insertarDetalleProductoSucursal() {
        $sql = new Sql();
        $sql->addTable('detalleProductoSucursales');
        $sql->setOpcion('insert');
        
        $sql->addInto('sucursalId');
        $sql->addInto('productoId');
        
        $sql->addValues($this->_sucursalId);
        $sql->addValues($this->_productoId);
        
        Persistence::insertar($sql);
    }
    
    public function eliminarDetalleProductoSucursalBySucursalId($id) {
        $sql = new Sql();
        $sql->addTable('detalleProductoSucursales');
        $sql->setOpcion('delete');
        $sql->addWhere("`sucursalId =`".$id);
        
        Persistence::eliminar($sql);
    }
    
    public function eliminarDetalleProductoSucursalByProductolId($id) {
        $sql = new Sql();
        $sql->addTable('detalleProductoSucursales');
        $sql->setOpcion('delete');
        $sql->addWhere("`pedidoId =`".$id);
        
        Persistence::eliminar($sql);
    }

}

?>
