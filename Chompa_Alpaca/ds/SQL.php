<?php
class Sql {
    private $_colWhere = array();
    private $_colSelect = array('*');
    private $_colFrom = array();
    private $_colValues=array();
    private $_colInto=array();
    private $_colSet=array();
    private $_accion;

    public function addTable($table){
        $this->_colFrom[] = $table;
    }

    public function addSet($set){
        $this->_colSet[]=$set;
    }

    public function addWhere($where){
        $this->_colWhere[] =  $where;
    }
    public function addInto($into){
        $this->_colInto[]=$into;
    }
    public function addValues($value){
        $this->_colValues[]=$value;
    }

    public function setOpcion($accion){
        $this->_accion=$accion;
    }

    public function getOpcion(){return $this->_accion;}

    

    private function _generar(){
        switch ($this->_accion){
            case 'listar':
                $select = implode(',',array_unique($this->_colSelect));
                $from = implode(',',array_unique($this->_colFrom));
                $where = implode(' AND ', array_unique($this->_colWhere));
                if($where != null)
                {
                    return 'SELECT '.$select.' FROM '."`".$from."`".' WHERE '.$where;
                }else{
                    return 'SELECT '.$select.' FROM '."`".$from."`";
                }
                break;
            case 'insert':
                $insert=implode(',',  array_unique($this->_colFrom));
                $into=implode("`".','."`",  array_unique($this->_colInto));
                $values=implode("'".','."'",($this->_colValues));
                return 'INSERT INTO '."`".$insert."`".' ('."`".$into."`".')'.' VALUES('."'".$values."'".')';
                break;
            case 'update':
                $update=implode(',',array_unique($this->_colFrom));
                $set=implode(',',array_unique($this->_colSet));
                $where=implode('AND', array_unique($this->_colWhere));
                return 'UPDATE '."`".$update."`".' SET '.$set.' WHERE '.$where;
                break;
            case 'delete':
                $delete= implode(',',array_unique($this->_colFrom));
                $where=implode('AND', array_unique($this->_colWhere));
                return 'DELETE FROM '."`".$delete."`".' WHERE '.$where;
        }

    }

    public function __toString() {
        $sql=$this->_generar();
        return $this->_generar();
    }
}
?>