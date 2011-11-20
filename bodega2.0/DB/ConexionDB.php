<?php

class ConexionDB {
    const USUARIO = 'root';
    const DB = 'bodeguero';
    const SERVER = 'localhost';

    private $_conexion;

    public function conectar(){
        $this->_conexion = mysql_connect(self::SERVER, self::USUARIO);
        mysql_select_db(self::DB, $this->_conexion);
    }

    public function desconectar(){
        mysql_close($this->_conexion);
    }

    public function traerDatos($sql){
        $result = mysql_query($sql, $this->_conexion);
        while($row = mysql_fetch_assoc($result)){
            $lista[] = $row;
        }
        return $lista;
    }

    public function actualizar($sql){
        $result = mysql_query($sql, $this->_conexion);
    }
}
?>
