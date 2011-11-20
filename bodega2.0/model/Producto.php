<?php
require_once '../dm/Persistence.php';
require_once '../dm/Sql.php';
class Producto {

    private $_productoId;
    private $_proveedorId;
    private $_marca;
    private $_tipoId;
    private $_costo;
    private $_precio;
    private $_cantidad;
    private $_categoria;
    

    public function __construct($productoId="", $proveedorId="",$marca="", $tipoId="", $costo="",$precio="",$cantidad="",$idCategoria=""){
        $this->_productoId = $productoId;
        $this->_proveedorId = $proveedorId;
        $this->_marca = $marca;
        $this->_tipoId = $tipoId;
        $this->_costo = $costo;
        $this->_precio = $precio;
        $this->_cantidad = $cantidad;
        $this->_categoria= $idCategoria;
    }

    public function get_productoId() {
        return $this->_productoId;
    }
    public function get_proveedorId() {
        return $this->_proveedorId;
    }
    public function get_marca() {
        return $this->_marca;
    }
    public function get_tipoId() {
        return $this->_tipoId;
    }
    public function get_costo() {
        return $this->_costo;
    }
    public function get_precio() {
        return $this->_precio;
    }
    public function get_cantidad() {
        return $this->_cantidad;
    }
    public function get_categoria() {
        return $this->_categoria;
    }

    public function set_categoria($_categoria) {
        $this->_categoria = $_categoria;
    }

    
    public function set_productoId($_productoId) {
        $this->_productoId = $_productoId;
    }
    public function set_proveedorId($_proveedorId) {
        $this->_proveedorId = $_proveedorId;
    }
    public function set_marca($_marca) {
        $this->_marca = $_marca;
    }
    public function set_tipoId($_tipoId) {
        $this->_tipoId = $_tipoId;
    }
    public function set_costo($_costo) {
        $this->_costo = $_costo;
    }
    public function set_precio($_precio) {
        $this->_precio = $_precio;
    }
    public function set_cantidad($_cantidad) {
        $this->_cantidad = $_cantidad;
    }


    private function _traerDatos(){
        $sql = new Sql();
        $sql->addTable('productos');
        $sql->setOpcion('listar');
        $lista = Persistence::consultar($sql);
        return $lista;
    }  

    public function getAll(){
        $lista = $this->_traerDatos();      
        foreach($lista as $value){
            $productoId  = $value['idProducto'];
            $proveedorId = $value['idProveedor'];
            $marca = $value['marca'];
            $tipoId = $value['idTipo'];
            $costo = $value['precioCompra'];
            $precio = $value['precioVenta'];
            $cantidad = $value['cantidad'];
            $descripcion = $value['descripcion'];
            $arreglo[] = new Producto($productoId, $proveedorId, $marca, $tipoId, $costo, $precio, $cantidad, $descripcion);
        }
        return $arreglo;
    }


    public function insertarProducto(){
        $sql = new Sql();
        $sql->addTable('productos');
        $sql->setOpcion('insert');
        
        $sql->addInto('idProducto');
        $sql->addInto('idProveedor');
        $sql->addInto('idTipo');
        $sql->addInto('marca');
        $sql->addInto('cantidad');
        $sql->addInto('precioCompra');
        $sql->addInto('precioVenta');;
        
        $sql->addValues($this->_productoId);
        $sql->addValues($this->_proveedorId);
        $sql->addValues($this->_tipoId);
        $sql->addValues($this->_marca);
        $sql->addValues($this->_cantidad);
        $sql->addValues($this->_costo);
        $sql->addValues($this->_precio);
        

        
        Persistence::insertar($sql);
    }

    public function eliminarProducto($id) {
        $sql = new Sql();
        $sql->addTable('productos');
        $sql->setOpcion('delete');
        $sql->addWhere("`idProducto` =".$id);
        
        Persistence::eliminar($sql);
    }
    
    public function modificar($id){
        $sql = new SQL();
        $sql->addTable('productos');
        $sql->setOpcion('update');
        $sql->addSet("`".'cantidad'."`"."="."'".$this->_cantidad."'");
        $sql->addWhere("`idProducto`= ".$id);
        Persistence::modificar($sql);
    }

    public function modificarProducto($id) {
        $sql = new Sql();
        $sql->addTable('productos');
        $sql->setOpcion('update');

        $sql->addSet("`".'idProveedor'."`"."="."'".$this->_proveedorId."'");
        $sql->addSet("`".'idTipo'."`"."="."'".$this->_tipoId."'");
        $sql->addSet("`".'marca'."`"."="."'".$this->_marca."'");
        $sql->addSet("`".'cantidad'."`"."="."'".$this->_cantidad."'");
        $sql->addSet("`".'precioCompra'."`"."="."'".$this->_costo."'");
        $sql->addSet("`".'precioVenta'."`"."="."'".$this->_precio."'");
        $sql->addSet("`".'descripcion'."`"."="."'".$this->_descripcion."'");
        $sql->addWhere("`productoId` =".$id);

        Persistence::modificar($sql);
    }
}
?>
