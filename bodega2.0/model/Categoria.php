<?php
require_once '../dm/Persistence.php';
require_once '../dm/Sql.php';
class Categoria {
    private $_categoriaId;
    private $_nombre;
    private $_lista = array();

    public function __construct($categoriaId="",$nombre=""){
        $this->_categoriaId = $categoriaId;
        $this->_nombre = $nombre;
    }

    public function get_categoriaId() {return $this->_categoriaId;}
    public function get_nombre() {return $this->_nombre;}

    public function set_nombre($_nombre) {$this->_nombre = $_nombre;}
    
    private function _traerDatos(){
        $sql = new Sql();
        $sql->addTable('categorias');
        $sql->setOpcion('listar');
        $lista = Persistence::consultar($sql);
        return $lista;
    } 

    public function getAll(){
        $lista = $this->_traerDatos();      
        foreach($lista as $value){
            $categoriaId = $value['idCategoria'];
            $nombre = $value['nombre'];    
            $arreglo[] = new Categoria($categoriaId, $nombre);
        }
        return $arreglo;
    }

    public function insertarCategoria(){
        $sql = new Sql();
        $sql->addTable('categorias');
        $sql->setOpcion('insert');
        
        $sql->addInto('idCategoria');
        $sql->addInto('nombre');
        
        $sql->addValues($this->_categoriaId);
        $sql->addValues($this->_nombre);
        
        Persistence::insertar($sql);
    }

    public function eliminarCategoria($id) {
        $sql = new Sql();
        $sql->addTable('categorias');
        $sql->setOpcion('delete');
        $sql->addWhere("`idCategoria =`".$id);
        
        Persistence::eliminar($sql);
    }

    public function modificarCategoria($id) {
        $sql = new Sql();
        $sql->addTable('categorias');
        $sql->setOpcion('update');
        
        $sql->addSet("`".'nombre'."`"."="."'".$this->_nombre."'");
        
        $sql->addWhere("`idCategoria =`".$id);
        
        Persistence::modificar($sql);
    }
    

}
?>
