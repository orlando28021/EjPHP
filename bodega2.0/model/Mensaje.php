<?php
require_once '../dm/Persistence.php';
require_once '../dm/Sql.php';
class Mensaje {
    private $_mensajeId;
    private $_mensajeContenido;
    private $_nombre;
    private $_correo;
    private $_asunto;
    
    private $_lista=array();

    function __construct($mensajeId="", $mensajeContenido="", $nombre="", $correo="",$asunto="") {
        $this->_mensajeId = $mensajeId;
        $this->_mensajeContenido = $mensajeContenido;
        $this->_nombre = $nombre;
        $this->_correo = $correo;
        $this->_asunto = $asunto;
    }
    public function get_mensajeId() {
        return $this->_mensajeId;
    }
    
    public function get_asunto() {
        return $this->_asunto;
    }

    
    
    public function get_mensajeContenido() {
        return $this->_mensajeContenido;
    }

    public function get_nombre() {
        return $this->_nombre;
    }

    public function get_correo() {
        return $this->_correo;
    }

    public function set_mensajeContenido($_mensajeContenido) {
        $this->_mensajeContenido = $_mensajeContenido;
    }

    public function set_nombre($_nombre) {
        $this->_nombre = $_nombre;
    }

    public function set_correo($_correo) {
        $this->_correo = $_correo;
    }
    
    public function set_mensajeId($_mensajeId) {
        $this->_mensajeId = $_mensajeId;
    }

    public function set_asunto($_asunto) {
        $this->_asunto = $_asunto;
    }

        
    private function _traerDatos(){
        $sql = new Sql();
        $sql->addTable('mensajes');
        $sql->setOpcion('listar');
        $lista = Persistence::consultar($sql);
        return $lista;
    }

    public function getAll() {
        $lista = $this->_traerDatos();
        $mensajes= array();
        foreach($lista as $mensaje){
            $id = $mensaje['idMensaje'];
            $nombre = $mensaje['nombre'];
            $correo = $mensaje['correo'];
            $asunto = $mensaje['asunto'];
            $descripcion = $mensaje['descripcion'];
            $mensajes[] = new Mensaje($id, $descripcion, $nombre, $correo,$asunto);
        }
        return $mensajes;
    }
    
    
    
    public function insertarMensaje() {
        $sql = new Sql();
        $sql->addTable('mensajes');
        $sql->setOpcion('insert');
        
        $sql->addInto('idMensaje');
        $sql->addInto('nombre');
        $sql->addInto('correo');
        $sql->addInto('asunto');
        $sql->addInto('descripcion');
        
        $sql->addValues($this->_mensajeId);
        $sql->addValues($this->_nombre);
        $sql->addValues($this->_correo);
        $sql->addValues($this->_asunto);
        $sql->addValues($this->_mensajeContenido);
        
        Persistence::insertar($sql);
    }
    
    public function eliminarMensaje($id) {
        $sql = new Sql();
        $sql->addTable('mensajes');
        $sql->setOpcion('delete');
        $sql->addWhere("`idMensaje` =".$id);
        
        Persistence::eliminar($sql);
    }
    

}

?>
