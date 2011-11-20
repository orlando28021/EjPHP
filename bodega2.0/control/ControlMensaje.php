<?php

require_once '../model/Mensaje.php';
class ControlMensaje {
    public function getAll()
    {
            $obj = new Mensaje();
            $lista = $obj->getAll();
            return $lista;
    }
    public function insertarMensaje($_mensajeContenido, $_nombre, $_correo,$_asunto){
    
        $obj = new Mensaje(null,$_mensajeContenido, $_nombre, $_correo,$_asunto);
        $obj->insertarMensaje();
    }
    public function modificarMensaje($_mensajeId, $_mensajeContenido, $_nombre, $_correo){
        $obj= new Mensaje($_mensajeId, $_mensajeContenido, $_nombre, $_correo);
        $obj->modificarMensaje();
    }
    public function eliminarMensaje($id){
        $obj=new Mensaje();
        $obj->eliminarMensaje($id);
    }
    public function buscarMensaje($id){
        $obj = new Mensaje();
        $arreglo = $obj->getAll();
        $lista = array();
        foreach ($arreglo as $mensaje){
            if($mensaje->get_mensajeId() == $id){
                $lista[]= $mensaje;
            }
        }
        return $lista;
    }
}

?>
