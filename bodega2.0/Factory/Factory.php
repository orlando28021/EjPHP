<?php
require_once '../model/Categoria.php';
require_once '../model/DetallePedidoProducto.php';
require_once '../model/DetalleProductoSucursal.php';
require_once '../model/Mensaje.php';
require_once '../model/Pedido.php';
require_once '../model/Producto.php';
require_once '../model/Proveedor.php';
require_once '../model/Tipo.php';
require_once '../model/Usuario.php';

class Factory {
    
    public function crearCategoria(){
        $categoria = new Categoria();
        return $categoria;
    }
    public function crearDetallePedidoProducto(){
        $detalle = new DetallePedidoProducto();
        return $detalle;
    }


    public function crearDetalleProductoSucursal(){
        $detalle = new DetalleProductoSucursal();
        return $detalle;
    }
    
    public function crearMensaje(){
        $mensaje = new Mensaje();
        return $mensaje;
    }
    public function crearPedido(){
        $pedido = new Pedido();
        return $pedido;
    }
    
    public function crearProducto(){
        $producto =  new Producto();
        return $producto;
    }
    public function crearProveedor(){
        $proveedor = new Proveedor();
        return $proveedor;
    }

    
    public function  crearTipo(){
        $tipo = new Tipo();
        return $tipo;
    }
    public function crearUsuario($usuarioId, $nombre, $apellidoPaterno, $apellidoMaterno,$dni, $telefono,$departamente, $contrasenha, $direccion, $distrito, $correoElectronico,$referencia){
        $usuario = new Usuario();
        return $usuario;
    }
    
}
?>
