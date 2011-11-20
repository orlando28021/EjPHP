<?php
require_once '../dm/Persistence.php';
require_once '../dm/Sql.php';
class Usuario {
    private $_usuarioId;
    private $_nombre;
    private $_apellidoPaterno;
    private $_apellidoMaterno;
    private $_dni;
    private $_contrasenha;
    private $_direccion;
    private $_distrito;
    private $_correoElectronico;
    private $_tipo;
    private $_telefono;
    private $_departamento;
    private $_referencia;
    
    private $_lista= array();
    
 public function __construct($usuarioId="", $nombre="", $apellidoPaterno="", $apellidoMaterno="", $dni="",$telefono="",$departamente="", $contrasenha="", $direccion="", $distrito="", $correoElectronico="",$referencia="") {
        $this->_usuarioId = $usuarioId;
        $this->_nombre = $nombre;
        $this->_apellidoPaterno = $apellidoPaterno;
        $this->_apellidoMaterno = $apellidoMaterno;
        $this->_dni = $dni;
        $this->_telefono = $telefono;
        $this->_contrasenha = $contrasenha;
        $this->_departamento = $departamente;
        $this->_direccion = $direccion;
        $this->_distrito = $distrito;
        $this->_referencia=$referencia;
        $this->_correoElectronico = $correoElectronico;
    }
    public function get_usuarioId() {
        return $this->_usuarioId;
    }

    public function get_nombre() {
        return $this->_nombre;
    }
    
    public function get_departamento() {
        return $this->_departamento;
    }

    public function get_referencia() {
        return $this->_referencia;
    }

    public function set_departamento($_departamento) {
        $this->_departamento = $_departamento;
    }

    public function set_referencia($_referencia) {
        $this->_referencia = $_referencia;
    }

        public function get_apellidoPaterno() {
        return $this->_apellidoPaterno;
    }

    public function get_apellidoMaterno() {
        return $this->_apellidoMaterno;
    }
    
    public function get_telefono() {
        return $this->_telefono;
    }

    public function set_telefono($_telefono) {
        $this->_telefono = $_telefono;
    }

    
    public function get_dni() {
        return $this->_dni;
    }

    public function get_contrasenha() {
        return $this->_contrasenha;
    }

    public function get_direccion() {
        return $this->_direccion;
    }

    public function get_distrito() {
        return $this->_distrito;
    }

    public function get_correoElectronico() {
        return $this->_correoElectronico;
    }
    
    public function set_nombre($_nombre) {
        $this->_nombre = $_nombre;
    }
    public function set_usuarioId($_usuarioId) {
        $this->_usuarioId = $_usuarioId;
    }

    public function set_tipo($_tipo) {
        $this->_tipo = $_tipo;
    }

    
    public function set_apellidoPaterno($_apellidoPaterno) {
        $this->_apellidoPaterno = $_apellidoPaterno;
    }

    public function set_apellidoMaterno($_apellidoMaterno) {
        $this->_apellidoMaterno = $_apellidoMaterno;
    }

    public function set_dni($_dni) {
        $this->_dni = $_dni;
    }

    public function set_contrasenha($_contrasenha) {
        $this->_contrasenha = $_contrasenha;
    }

    public function set_direccion($_direccion) {
        $this->_direccion = $_direccion;
    }

    public function set_distrito($_distrito) {
        $this->_distrito = $_distrito;
    }

    public function set_correoElectronico($_correoElectronico) {
        $this->_correoElectronico = $_correoElectronico;
    }
    
    private function _traerDatos(){
        $sql = new Sql();
        $sql->addTable('usuarios');
        $sql->setOpcion('listar');
        $lista = Persistence::consultar($sql);
        return $lista;
    }   
    
    public function getAll() {
        $lista = $this->_traerDatos();  
        $arreglo = array();
        foreach($lista as $value){
            $usuarioId  = $value['idUsuario'];
            $nombre = $value['nombre'];
            $apellidoPaterno = $value['apellidoPa'];
            $apellidoMaterno = $value['apellidoMa'];
            $dni = $value['dni'];
            $telefono = $value['telefono'];
            $contrasenha = $value['contrasenha'];
            $departamente =$value['departamento'];
            $direccion = $value['direccion'];
            $distrito = $value['distrito'];
            $referencia = $value['referencia'];
            $correoElectronico = $value['correo'];
            $arreglo[] = new Usuario($usuarioId,$nombre, $apellidoPaterno, $apellidoMaterno,$dni, $telefono,$departamente, $contrasenha, $direccion, $distrito, $correoElectronico,$referencia);
        }
        return $arreglo;
    }  
    
    
    public function insertarUsuario() {
        $sql = new Sql();
        $sql->addTable('usuarios');
        $sql->setOpcion('insert');
        
        $sql->addInto('idUsuario');
        $sql->addInto('correo');
        $sql->addInto('contrasenha');        
        $sql->addInto('nombre');
        $sql->addInto('apellidoPa');
        $sql->addInto('apellidoMa');
        $sql->addInto('dni');
        $sql->addInto('telefono');
        $sql->addInto('departamento');
        $sql->addInto('distrito');
        $sql->addInto('direccion');
        $sql->addInto('referencia');

        
        
        $sql->addValues($this->_usuarioId);
        $sql->addValues($this->_correoElectronico);
        $sql->addValues($this->_contrasenha);
        $sql->addValues($this->_nombre);
        print_r($this->_nombre);

        $sql->addValues($this->_apellidoPaterno);
        $sql->addValues($this->_apellidoMaterno);
        $sql->addValues($this->_dni);
        $sql->addValues($this->_telefono);
        $sql->addValues($this->_departamento);
        $sql->addValues($this->_distrito);        
        $sql->addValues($this->_direccion);
        $sql->addValues($this->_referencia);
        
        Persistence::insertar($sql);
    }
    
    public function eliminarUsuario($id) {
        $sql = new Sql();
        $sql->addTable('usuarios');
        $sql->setOpcion('delete');
        $sql->addWhere("`idUsuario` = ".$id);
        
        Persistence::eliminar($sql);
    }
   
    public function modificarUsuario($id) {
        $sql = new Sql();
        $sql->addTable('usuarios');
        $sql->setOpcion('update');
                
                    
        $sql->addSet("`".'nombre'."`"."="."'".$this->_nombre."'");        
        $sql->addSet("`".'apellidoPa'."`"."="."'".$this->_apellidoPaterno."'");
        $sql->addSet("`".'apellidoMa'."`"."="."'".$this->_apellidoMaterno."'");        
        $sql->addSet("`".'dni'."`"."="."'".$this->_dni."'");
        $sql->addSet("`".'telefono'."`"."="."'".$this->_telefono."'");
        $sql->addSet("`".'departamento'."`"."="."'".$this->_departamento."'");
        $sql->addSet("`".'distrito'."`"."="."'".$this->_distrito."'");        
        $sql->addSet("`".'direccion'."`"."="."'".$this->_direccion."'");
        $sql->addSet("`".'referencia'."`"."="."'".$this->_referencia."'");
        
        
        $sql->addWhere("`idUsuario`= ".$id);
        
        Persistence::modificar($sql);
    }

}

?>
