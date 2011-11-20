<?php
require_once '../control/controlUsuario.php';
class session {
   public function run(){
       if(isset($_POST['iniciar'])){
           $usuario = $_POST['usuario'];
           $contra = $_POST['contra'];
           $mi = new controlUsuario();
           $lista = $mi->verificar($usuario, $contra);
           $this->_mostrarAdmin();
       }
   }
   
   private function _mostrarAdmin(){
       require_once 'principalAdmin.html';
   }
}
$mi = new session();
$mi->run();
?>
