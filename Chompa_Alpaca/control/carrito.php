<?php

require_once 'controlProducto.php';
require_once '../model/productos.php';
session_start();

class carrito {

    private $array = array();
    private $cantidad = array();
    public function agregarItem(productos $producto,$cantidad) {
        $this->array = unserialize($_SESSION['carro']);
        $this->cantidad = unserialize($_SESSION['cantidad']);
        $this->array[$producto->get_id()] = $producto;
        $this->cantidad[$producto->get_id()] = $cantidad;
        $_SESSION['cantidad'] = serialize($this->cantidad);
        $_SESSION['carro'] = serialize($this->array);
    }
    public function getCantidad(){
        return $this->cantidad;
    }
    
    public function getCarro(){
        return $this->array;
    }
    
    public function elimiar($id){
        $this->array = unserialize($_SESSION['carro']);
        unset ($this->array[$id]);
        $_SESSION['carro']= serialize($this->array);
    }

}

?>
