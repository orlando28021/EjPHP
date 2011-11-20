<?php

/* En la tabla de la BD faltan poner los campos correo y apellidoContacto */
require_once '../dm/Persistence.php';
require_once '../dm/Sql.php';
class Proveedor {

    private $_proveedorId;
    private $_nombreEmpresa;
    private $_ruc;
    private $_correo;
    private $_nombreContacto;
    private $_apellidoContacto;
    private $_dniContacto;
    private $_telefonoContacto;
    private $_lista = array();

    public function __construct($proveedorId="", $nombreEmpresa="", $ruc="", $correo="", $nombreContacto="", $apellidoContacto="", $dniContacto="", $telefonoContacto="") {
        $this->_proveedorId = $proveedorId;
        $this->_nombreEmpresa = $nombreEmpresa;
        $this->_ruc = $ruc;
        $this->_correo = $correo;
        $this->_nombreContacto = $nombreContacto;
        $this->_apellidoContacto = $apellidoContacto;
        $this->_dniContacto = $dniContacto;
        $this->_telefonoContacto = $telefonoContacto;
    }

    public function get_proveedorId() {
        return $this->_proveedorId;
    }

    public function get_nombreEmpresa() {
        return $this->_nombreEmpresa;
    }

    public function get_ruc() {
        return $this->_ruc;
    }

    public function get_correo() {
        return $this->_correo;
    }

    public function get_nombreContacto() {
        return $this->_nombreContacto;
    }

    public function get_apellidoContacto() {
        return $this->_apellidoContacto;
    }

    public function get_dniContacto() {
        return $this->_dniContacto;
    }

    public function get_telefonoContacto() {
        return $this->_telefonoContacto;
    }

    public function set_nombreEmpresa($_nombreEmpresa) {
        $this->_nombreEmpresa = $_nombreEmpresa;
    }

    public function set_ruc($_ruc) {
        $this->_ruc = $_ruc;
    }

    public function set_correo($_correo) {
        $this->_correo = $_correo;
    }

    public function set_nombreContacto($_nombreContacto) {
        $this->_nombreContacto = $_nombreContacto;
    }

    public function set_apellidoContacto($_apellidoContacto) {
        $this->_apellidoContacto = $_apellidoContacto;
    }

    public function set_dniContacto($_dniContacto) {
        $this->_dniContacto = $_dniContacto;
    }

    public function set_telefonoContacto($_telefonoContacto) {
        $this->_telefonoContacto = $_telefonoContacto;
    }
    
    public function set_productoId($_productoId) {
        $this->_productoId = $_productoId;
    }
    
    private function _traerDatos(){
        $sql = new Sql();
        $sql->addTable('proveedores');
        $sql->setOpcion('listar');
        $lista = Persistence::consultar($sql);
        return $lista;
    }  
    
    public function getAll() {
        $lista = $this->_traerDatos();      
        foreach($lista as $value){
            $proveedorId = $value['idProveedor'];
            $nombre = $value['nombre'];
            $apellido = $value['apellido'];
            $dni = $value['dni'];
            $telefono = $value['telefono'];
            $empresa = $value['empresa'];
            $ruc = $value['ruc'];
            $correo = $value['correo'];        
            $arreglo[] = new Proveedor($proveedorId, $empresa, $ruc, $correo, $nombre, $apellido, $dni, $telefono);
        }
        return $arreglo;
    }

    public function insertarProveedor() {
        $sql = new Sql();
        $sql->addTable('proveedores');
        $sql->setOpcion('insert');
     
        $sql->addInto('idProveedor');
        $sql->addInto('nombre');
        $sql->addInto('apellido');
        $sql->addInto('dni');
        $sql->addInto('telefono');
        $sql->addInto('empresa');        
        $sql->addInto('ruc');
        $sql->addInto('correo');

        
        $sql->addValues($this->_proveedorId);
        $sql->addValues($this->_nombreContacto);
        $sql->addValues($this->_apellidoContacto);
        $sql->addValues($this->_dniContacto);
        $sql->addValues($this->_telefonoContacto);
        $sql->addValues($this->_nombreEmpresa);
        $sql->addValues($this->_ruc);
        $sql->addValues($this->_correo);
        
        Persistence::insertar($sql);
    }

    public function eliminarProveedor($id) {
        $sql = new Sql();
        $sql->addTable('proveedores');
        $sql->setOpcion('delete');
        $sql->addWhere("`idProveedor`=".$id);
        Persistence::eliminar($sql);
    }

    public function modificarProveedor($id) {
        $sql = new Sql();
        $sql->addTable('proveedores');
        $sql->setOpcion('update');

        $sql->addSet("`".'nombre'."`"."="."'".$this->_nombreContacto."'");
        $sql->addSet("`".'apellido'."`"."="."'".$this->_apellidoContacto."'");
        $sql->addSet("`".'dni'."`"."="."'".$this->_dniContacto."'");
        $sql->addSet("`".'telefono'."`"."="."'".$this->_telefonoContacto."'");
        $sql->addSet("`".'empresa'."`"."="."'".$this->_nombreEmpresa."'");
        $sql->addSet("`".'ruc'."`"."="."'".$this->_ruc."'");
        $sql->addSet("`".'correo'."`"."="."'".$this->_correo."'");
        $sql->addWhere("`idProveedor` =".$id);
        Persistence::modificar($sql);
    }

}
