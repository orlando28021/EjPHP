<?php
require_once '/../Interface/ManejadorBaseDeDatosInterface.php';
class MySQL implements ManejadorBaseDeDatosInterface
{
    const USUARIO = 'root';
    const CLAVE = '';
    const BASE = 'bodeguero';
    const SERVIDOR = 'localhost';

    private $_conexion;

    public function conectar()
    {
        $this->_conexion = mysql_connect(
            self::SERVIDOR,
            self::USUARIO,
            self::CLAVE);
        mysql_select_db(self::BASE,$this->_conexion);

    }

    public function desconectar()
    {
        mysql_close($this->_conexion);
    }

    public function traerDatos(Sql $sql)
    {
        
       //$v=$sql->__toString();
       //print_r($v);

        $resultado = mysql_query($sql,$this->_conexion);
        //print_r($resultado);
        $todo=array();
        if($sql->getOpcion()=='listar'){
            while($fila = mysql_fetch_array($resultado, MYSQL_ASSOC)){
                $todo[] = $fila;
            }
            return $todo;
        }        

    }


}
?>
