<?php

require_once '/../control/controlProducto.php';
require_once '/../control/controlPedido.php';
require_once '/../control/carrito.php';

class view {

    public function run() {
        if (!isset($_GET['op'])) {
            $this->_mostrarPrincipal();
        } else {
            if (isset($_POST['seleccionar'])) {
            }           
            $controlPedido = new controlPedido();
                $control = new controlProducto();
                $carro = new carrito();
            $op = $_GET['op'];
            switch ($op) {
                case 'Comprar':
                    $this->_mostrarComprar();
                    break;
                case 'iniciar':
                    $this->_mostrarIniciarSesion();
                    break;
                case 'volver':
                    $this->_mostrarPrincipal();
                    break;
                case 'volverCompra':
                    $this->_mostrarComprar();
                    break;
                case 'productos':
                    $lista = $control->listar();
                    $this->_mostrarProductos($lista);
                    break;
                case 'pedidos':
                    $lista = $controlPedido->listar();
                    $this->_mostrarPedidos($lista);
                    break;
            }
            
        }
    }
    private function _mostrarPedidos($lista){
        require_once 'pedidos.html';
    }
    
    private function _mostrarProductos($lista){
        require_once 'productos.html';
    }

    private function _mostrarCarro($items, $cantidades) {
        require_once 'carrito.html';
    }

    private function _mostrarPrincipal() {
        require_once 'Home.html';
    }

    private function _mostrarComprar() {
        require_once 'principal.html';
    }

    private function _mostrarIniciarSesion() {
        require_once 'iniciarSession.html';
    }

}

$mi = new view();
$mi->run();
?>