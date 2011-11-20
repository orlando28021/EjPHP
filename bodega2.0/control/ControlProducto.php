<?php

require_once '../model/Producto.php';
require_once 'ControlTipo.php';

class ControlProducto {

    public function getAll() {
        try {
            $obj = new Producto();
            $lista = $obj->getAll();
            return $lista;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getProductoPorTipo($tipoId) {
        $lista = $this->getAll();
        $arreglo = array();
        foreach ($lista as $producto) {
            if ($producto->get_tipoId() == $tipoId) {
                $productoId = $producto->get_productoId();
                $proveedorId = $producto->get_nombre();
                $marca = $producto->get_marca();
                $tipoId = $producto->get_tipoId();
                $costo = $producto->get_costo();
                $precio = $producto->get_precio();
                $cantidad = $producto->get_cantidad();
                $descripcion = $producto->get_descripcion();
                $prod = new Producto($productoId, $proveedorId, $marca, $tipoId, $costo, $precio, $cantidad, $descripcion);
                $arreglo[] = $prod;
            }
        }
        return $arreglo;
    }

    public function findProductoPorCategoria($categoriaId) {
        $lista = $this->getAll();
        $cntrl = new ControlTipo();
        $tipo = $cntrl->obtenerTipoporCategoria($categoriaId);
        $longitud = count($tipo);
        $arreglo = array();
        foreach ($lista as $producto) {
            for ($i = 0; $i < $longitud; $i++) {
                if ($producto->get_tipoId() == $tipo[$i]) {
                    $arreglo[] = $producto;
                }
            }
        }
        return $arreglo;
    }

    public function buscarProductoPorTexto($texto) {
        $listaProductos = array();
        $productos = $this->getAll();
        foreach ($productos as $producto) {
            switch (strtolower($texto)) {
                case strtolower($producto->get_productoId()):
                case strtolower($producto->get_marca()):
                    $listaProductos[] = $producto;
                    break;
                default:
                    break;
            }
        }
        return $listaProductos;
    }

    public function buscarProducto($id) {
        $obj = new Producto();
        $arreglo = $obj->getAll();
        $lista = array();
        foreach ($arreglo as $producto) {
            if ($producto->get_productoId() == $id) {
                $productoEncontrado = $producto;
            }
        }
        return $productoEncontrado;
    }

    public function buscarPorProveedor($id) {
        $obj = new Producto();
        $arreglo = $obj->getAll();
        $lista = array();
        foreach ($arreglo as $producto) {
            if ($producto->get_proveedorId() == $id) {
                $lista[] = $producto;
            }
        }
        return $lista;
    }

    public function insertarProducto($proveedorId, $marca, $tipoId, $costo, $precio, $cantidad, $idCategoria) {
        $prod = new Producto();
        $obj = new Producto(null, $proveedorId, $marca, $tipoId, $costo, $precio, $cantidad, $idCategoria);
        $obj->insertarProducto();
    }
    public function modificar($id,$stock){
        $model = new Producto($id, $proveedorId="", $marca="", $tipoId="", $costo="", $precio="", $stock, $descripcion="");
        $model->modificar($id);
    }
    

    public function modificarProducto($productoId, $proveedorId, $marca, $tipoId, $costo, $precio, $cantidad, $descripcion)
    {
        $prod = new Producto($productoId, $proveedorId, $marca, $tipoId, $costo, $precio, $cantidad, $descripcion);
        $prod->modificarProducto($productoId);
    }

    

    public function eliminarProducto($id) {
        $obj = new Producto();
        $obj->eliminarProducto($id);
    }

}

?>
