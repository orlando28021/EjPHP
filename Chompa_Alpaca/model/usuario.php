<?php

require_once '/../persistence/Persistence.php';
class usuario {
    private $_id;
    private $_nombre;
    private $_apellido;
    private $_usuario;
    private $_contrasenha;
    
    public function __construct($id="", $nombre="",$apellido="",$usuario="",$contrasenha="") {
        $this->_id = $id;
        $this->_nombre = $nombre;
        $this->_apellido = $apellido;
        $this->_usuario = $usuario;
        $this->_contrasenha = $contrasenha;
    }
    public function get_id() {
        return $this->_id;
    }

    public function get_nombre() {
        return $this->_nombre;
    }

    public function get_apellido() {
        return $this->_apellido;
    }

    public function get_usuario() {
        return $this->_usuario;
    }

    public function get_contrasenha() {
        return $this->_contrasenha;
    }
    
    public function  listar($table){
        $sql = new SQL();
        $sql->addTable($table);
        $sql->setOpcion('listar');
        $usuarios= array();
        $lista = Persistence::consultar($sql);
        foreach($lista as $usuario){
            $id = $usuario['id'];
            $nombre = $usuario['nombre'];
            $apellido = $usuario['apellido'];
            $usuario = $usuario['correo'];
            $contrasenha = $usuario['contrasenha'];
            $usuarios[] = new usuario($id, $nombre, $apellido, $usuario, $contrasenha);
        }
        return $usuarios;
    }


}

?>
