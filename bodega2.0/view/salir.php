<?php
class salir {

    public function out(){
        session_start();
        session_destroy();       
        header('location:../index.php');
    }
    
}
$miSalir = new salir();
$miSalir->out();
?>
