<?php

require_once '../model/Usuario.php';
class ControlUsuario {
    public function getAll()
    {
        try
        {
            $obj = new Usuario();
            $lista = $obj->getAll();
            return $lista;
        }
        catch(Exception $e)
        {
            throw $e;
        }
    }
    public function insertarUsuario($nombre, $apellidoPaterno, $apellidoMaterno, $dni, $telefono, $departamente, $contrasenha, $direccion, $distrito, $correoElectronico, $referencia){
        $ob = new Usuario(null, $nombre, $apellidoPaterno, $apellidoMaterno, $dni, $telefono, $departamente, $contrasenha, $direccion, $distrito, $correoElectronico, $referencia);
        $ob->insertarUsuario();
    }
    
    public function modificarUsuario($_usuarioId, $_nombre, $_apellidoPaterno, $_apellidoMaterno, $_dni,$direccion,$departamento, $distrito,$referencia){
        $obj= new Usuario($_usuarioId, $_nombre, $_apellidoPaterno, $_apellidoMaterno, $_dni,$direccion,$departamento, $distrito,$referencia);
        $obj->modificarUsuario($_usuarioId);
    }
    public function eliminarUsuario($id){
        $obj=new Usuario();
        $obj->eliminarUsuario($id);
    }
    public function buscarUsuario($id){
        $obj = new Usuario();
        $arreglo = $obj->getAll();
        $lista = array();
        foreach ($arreglo as $usuario){
            if($usuario->get_usuarioId() == $id){
                $lista[]= $usuario;
            }
        }
        return $lista;
    }
    
    public function buscarClientePorTexto($texto){
        $listaClientes = array();
        $clientes = $this->getAll();
        foreach($clientes as $cliente){
            switch(strtolower($texto)){
                case strtolower($cliente->get_usuarioId()):
                case strtolower($cliente->get_nombre()):
                case strtolower($cliente->get_apellidoPaterno()):
                case strtolower($cliente->get_apellidoMaterno()):
                case strtolower($cliente->get_dni()):
                    $listaClientes[] = $cliente;
                    break;
                default:
                    break;
            }
        }
        return $listaClientes;
    }
    
    
    public function verificarUsuario($user,$contrasenha){
        $obj = new Usuario();
        $arreglo = $obj->getAll();
        foreach ($arreglo as $usuario){
            if(($usuario->get_correoElectronico() == $user) && ($usuario->get_contrasenha() == $contrasenha) ){
                return 1;
            }else{
                return 0;
            }
        }
        
    }
    
    public function buscarPorUsuario($user){
        $obj = new Usuario();
        $arreglo = $obj->getAll();
        $lista = array();
        foreach ($arreglo as $usuario){
            if(($usuario->get_correoElectronico() == $user)){
                return $usuario;
            }
        }
    }
}

?>
