<?php
require_once '/../db/BaseDeDatos.php';
require_once '/../ds/MySQL.php';
abstract class Persistence {
   static private function _conectarBD()
   {
        $cn = new BaseDeDatos(new MySQL());
        return $cn;
   }
   static public function consultar(Sql $sql)
   {
       
        $db = Persistence::_conectarBD();
        $respuesta = $db->ejecutar($sql);
        return $respuesta;
   }
    static public function insertar(Sql $sql)
   {
        $db = Persistence::_conectarBD();
        $db->ejecutar($sql);
        
   }
    static public function modificar(Sql $sql)
   {
        $db = Persistence::_conectarBD();
        $db->ejecutar($sql);

   }

   static public function eliminar(Sql $sql){
       $db = Persistence::_conectarBD();
       $db->ejecutar($sql);
   }


}
?>
