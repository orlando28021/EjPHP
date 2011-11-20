<?php
require_once '/../model/Pedido.php';
class controlPedido {
    public function listar(){
        $model = new Pedido();
        $listar = $model->listar('pedido');
        return $listar;
    }
    public function ingresar($estado,$fecha,$productoId){
        $model = new Pedido(NULL, $estado,$fecha,$productoId);
        $model->ingresar('pedido', $estado, $fecha, $productoId);
    }

    public function hacerPedido($idProducto){
        switch($idProducto){
            case '1':return 200;
                break;
            case '2':return 100;
                break;
            case '3':return 100;
                break;
            case '4':return 180;
                break;
            case '5':return 150;
                break;
            case '6':return 200;
        }
    }
}
?>
