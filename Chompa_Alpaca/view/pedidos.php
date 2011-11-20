<?php

require_once '/../control/controlProducto.php';
require_once '/../control/controlPedido.php';
require_once '/../control/carrito.php';

class pedidos {
    
    public function run(){
               $controlPedido = new controlPedido();
                $control = new controlProducto();
                $carro = new carrito();
        if(isset($_POST['seleccionar'])){
            $id = $_POST['chompas'];
                $item = $control->buscarById($id);
                $cantidad = $_POST['cantidad'];
                if ($cantidad == null) {
                    echo 'Ingresar una Cantidad';
                } else {
                    $cantidadActual = $item->get_stock();
                    $nuevaCantidad = $cantidadActual - $cantidad;
                    $control->modificar($id, $nuevaCantidad);
                    if ($control->fueraDeStock($id, $nuevaCantidad)) {
                        $controlPedido->ingresar('0',date("Y-m-d") , $id);
                        $cantidadAPedir = $controlPedido->hacerPedido($id);
                        $cantidadActual = $item->get_stock();
                        $nuevaCantidad1 = $nuevaCantidad + $cantidadAPedir;
                        $control->modificar($id, $nuevaCantidad1);
                    } else {
                        $cantidadAPedir = 0;
                    }
                    //$pedidos = $controlPedido->listar();
                    $carro->agregarItem($item, $cantidad);
                    $items = $carro->getCarro();
                    $cantidades = $carro->getCantidad();
                    $this->_mostrarCarro($items, $cantidades);
                }
        }
    }
    public function _mostrarCarro($items,$cantidades){
        require_once 'carrito.html';
    }
    
}

$run = new pedidos;
$run->run();
?>
