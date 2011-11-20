<?php

require_once '/../model/productos.php';
class controlProducto {
    
    public function listar(){
        $model = new productos();
        $listar = $model->listar('productos');
        return $listar;
    }

    public function modificar($id,$stock){
        $model = new productos($id, $nombre="", $stock, $precio="", $insumo="");
        $model->modificar('productos');
    }
    
    public function buscarById($id) {
        $mi = new controlProducto();
        $lista = $mi->listar();
        foreach ($lista as $proc) {
            if ($proc->get_id() == $id) {
                return $proc;
            }
        }
    }

    public function fueraDeStock($id,$cantidadRestante){
        switch($id){
            case '1':
                if($cantidadRestante < 100){
                    return true;
                }
                break;
            case '2':
                if($cantidadRestante < 80){return true;}else{return false;}
                break;
            case '3':
                if($cantidadRestante < 80){return true;}else{return false;}
                break;
            case '4':
                if($cantidadRestante < 120){return true;}else{return false;}
                break;
            case '5':
                if($cantidadRestante < 100){return true;}else{return false;}
                break;
            case '6':
                if($cantidadRestante < 150){return true;}else{return false;}
        }
    }
}

?>


