<?php
require_once '/../ds/SQL.php';
require_once '/../interface/IManejadorBaseDeDatos.php';
class MySQL implements IManejadorBaseDeDatos{
    const USUARIO = 'root';
    const CLAVE = '';
    const SERVIDOR = 'localhost';
    const BASE = 'Chompa_Alpaca';

    private $_conexion;

    public function conectar(){
        $this->_conexion = mysql_connect(self::SERVIDOR, self::USUARIO,self::CLAVE);
        mysql_select_db(self::BASE,$this->_conexion);
    }

    public function desconectar(){
        mysql_close($this->_conexion);

    }

    public function traerDatos(SQL $sql){
        $array = array();
        $resultado = mysql_query($sql,$this->_conexion);
        while($row = mysql_fetch_assoc($resultado,MYSQL_ASSOC)){
            $array[] = $row;
        }
        return $array;
    }


}

