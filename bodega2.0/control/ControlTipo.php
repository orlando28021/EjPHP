<?php
require_once '/../model/Tipo.php';
class ControlTipo {
    public function getAll(){
        try
        {
            $obj = new Tipo();
            $lista = $obj->getAll();
            return $lista;
        }
        catch(Exception $e)
        {
            throw $e;
        }
    }


    public function insertarTipo($tipoId, $nombre){
        $tipo = new Tipo();
        $nuevoId=$tipo->IncrementarId();
        $obj = new Tipo($categoriaId, $nombre);
        $obj->insertarTipo();
    }

    public function modificarTipo($tipoId, $nombre)
    {
        $tipo = new Tipo($categoriaId, $nombre);
        $tipo->modificarTipo();
    }

    public function eliminarTipo($id)
    {
        $obj = new Tipo();
        $obj->eliminarTipo($id);
    }

    public function getNombrePorId($id){
        $tipos = $this->getAll();
        foreach($tipos as $tipo){
            if($tipo->get_tipoId() == $id){
                
                $nombre = $tipo->get_nombre();
            }
        }       
        return $nombre;
    }
    
    public function getIdPorTipo($nombre){
        $tipos = $this->getAll();
        foreach($tipos as $tipo){
            if(strtolower($tipo->get_nombre()) == strtolower($nombre)){
                return $tipo->get_tipoId();
            }
        }
    }

     public function obtenerCategoriaPorTipo($tipoId){
       $tipos = $this->getAll();
       foreach($tipos as $tipo){
           if($tipoId == $tipo->get_tipoId()){
               $categoria = $tipo->get_categoriaId();
           }
       }
       return $categoria;
    }
    
    public function obtenerTipoporCategoria($categoria){
       $tipos = $this->getAll();
       $array = array();
       foreach($tipos as $tipo){
           if($categoria == $tipo->get_categoriaId()){
               $tipos = $tipo->get_tipoId();
               $array[]= $tipos;
               
           }
       }
       return $array;
    }

}
?>
