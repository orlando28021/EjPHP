<?php
require_once '/../model/usuario.php';
class controlUsuario {
    public function listar(){
        $model = new usuario();
        $listar = $model->listar('usuarios');
        return $listar;
    }
    
    public function verificar($usuario,$contra){
        $lista = $this->listar();
        foreach($lista as $usuario){
            if(($usuario->get_usuario() == $usuario)){
               return $usuario; 
            }
        }
    }
}

?>
