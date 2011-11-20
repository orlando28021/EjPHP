<?php

require_once '../model/DetalleProductoSucursal.php';
class ControlDetalleProductoSucursal {
    public function getAll()
    {
        try
        {
            $obj = new DetalleProductoSucursal();
            $lista = $obj->getAll();
            return $lista;
        }
        catch(Exception $e)
        {
            throw $e;
        }
    }
    public function insertarDetalleProductoSucursal($_sucursalId, $_productoId){
        $_sucursalId=null;
        $_productoId=null;
        $obj = new DetalleProductoSucursal($_sucursalId, $_productoId);
        $obj->insertarDetalleProductoSucursal();
    }
    public function eliminarDetalleProductoSucursalBySucursalId($id){
        $obj=new DetalleProductoSucursal();
        $obj->eliminarDetalleProductoSucursalBySucursalId($id);
    }
    public function eliminarDetalleProductoSucursalByProductoId($id){
        $obj=new DetalleProductoSucursal();
        $obj->eliminarDetalleProductoSucursalByProductolId($id);
    }
    
}

?>
