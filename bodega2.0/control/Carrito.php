<?php
require_once '../model/Producto.php';
class Carrito {
   
    private $_colItems=null;
    private $_cantidadProducto=array();
    public function __construct() {
            $this->_cantidadProducto = unserialize($_SESSION['cantidades']);
            $this->_colItems = unserialize($_SESSION['carrito']);
        
    }

    public function deleteItem($id){
        
        foreach ($this->_colItems as $index => $item){
            
            if($item->get_productoId() == $id){

                unset($this->_colItems[$index]);
                unset ($this->_cantidadProducto[$index]);
        }
        
        }
        
        $_SESSION['cantidades']= serialize($this->_cantidadProducto);
        $_SESSION['carrito'] = serialize($this->_colItems);
        
    }
    
    public function cantidad(){
        $longitud= count($this->_colItems);
        return $longitud;
    }
    
    public function cantidadPorProducto(){
        return $this->_cantidadProducto;
    } 

    public function addItem(Producto $item){
        
        $this->_colItems[$item->get_productoId()] = $item;
        $this->_cantidadProducto[$item->get_productoId()] = $this->_cantidadProducto[$item->get_productoId()] + 1;
        
        $_SESSION['cantidades']= serialize($this->_cantidadProducto);
        $_SESSION['carrito'] = serialize($this->_colItems);
    }
    
    public function vaciar(){
        $this->_cantidadProducto= $_SESSION['cantidades'];
        $this->_colItems = $_SESSION['carrito'];
        $this->_cantidadProducto = null;
        $this->_colItems = null;
    }

    public function getItems(){
        return $this->_colItems;
    }
    public function getTotal(){
        $total = 0;
        $prod = $this->_colItems;
        $cantidad  =$this->_cantidadProducto;
        foreach($prod as $productos){
            $total += $productos->get_precio() * $this->_cantidadProducto[$productos->get_productoId()];
        }
        return $total;
    }
}
?>
