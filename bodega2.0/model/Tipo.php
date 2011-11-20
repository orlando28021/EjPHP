<?php
require_once '../dm/Persistence.php';
require_once '../dm/Sql.php';
class Tipo {
    private $_tipoId;
    private $_categoriaId;
    private $_nombre;
    private $_lista = array();

    public function  __construct($tipoId="", $categoriaId="", $nombre="") {
        $this->_tipoId = $tipoId;
        $this->_categoriaId = $categoriaId;
        $this->_nombre = $nombre;
    }

    public function get_tipoId() {
        return $this->_tipoId;
    }
    public function get_categoriaId() {
        return $this->_categoriaId;
    }
    public function get_nombre() {
        return $this->_nombre;
    }

    public function set_tipoId($_tipoId) {
        $this->_tipoId = $_tipoId;
    }
    public function set_categoriaId($_categoriaId) {
        $this->_categoriaId = $_categoriaId;
    }
    public function set_nombre($_nombre) {
        $this->_nombre = $_nombre;
    }

    private function _traerDatos(){
        $sql = new Sql();
        $sql->addTable('tipos');
        $sql->setOpcion('listar');
        $lista = Persistence::consultar($sql);
        return $lista;
    }

    public function getAll(){
        $lista = $this->_traerDatos();      
        foreach($lista as $value){
            $tipoId  = $value['idTipo'];
            $categoriaId = $value['idCategoria'];
            $nombre = $value['nombre'];
            $arreglo[] = new Tipo($tipoId, $categoriaId, $nombre);
        }
        return $arreglo;
    }

    public function insertarTipo(){
        $sql = new Sql();
        $sql->addTable('tipos');
        $sql->setOpcion('insert');
        
        $sql->addInto('idTipo');
        $sql->addInto('idCategoria');
        $sql->addInto('nombre');
        
        $sql->addValues($this->_tipoId);
        $sql->addValues($this->_categoriaId);
        $sql->addValues($this->_nombre);
        
        Persistence::insertar($sql);
    }

    public function eliminarCategoria($id) {
        $sql = new Sql();
        $sql->addTable('tipos');
        $sql->setOpcion('delete');
        $sql->addWhere("`idTipo =`".$id);
        
        Persistence::eliminar($sql);
    }

    public function modificarTipo($id, $categoriaId, $nombre) {
     
    }

}
?>
