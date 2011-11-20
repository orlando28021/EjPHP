<?php
require_once '/../model/Pedido.php';
class ControlPedido {
     public function getAll(){
        try
        {
            $obj = new Pedido();
            $lista = $obj->getAll();
            return $lista;
        }
        catch(Exception $e)
        {
            throw $e;
        }
    }


    public function insertarPedido($fechaPedido, $fechaEntrega){
        $prod = new Pedido();
        $nuevoId=$prod->IncrementarId();
        $obj = new Pedido($fechaPedido, $fechaEntrega);
        $obj->insertarPedido();
    }

    public function modificarPedido($fechaPedido, $fechaEntrega)
    {
        $prod = new Pedido($fechaPedido, $fechaEntrega);
        $prod->modificarPedido();
    }

    public function eliminarPedido($id)
    {
        $obj = new Pedido();
        $obj->eliminarPedido($id);
    }
}
?>
