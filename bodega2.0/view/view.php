<?php
require_once '/../control/ControlUsuario.php';
require_once '/../model/Usuario.php';
require_once '/../control/ControlProducto.php';
require_once '/../control/ControlCategoria.php';
require_once '../control/Carrito.php';
require_once '../control/ControlMensaje.php';
session_start();
class view {
    private $_usuario=null;
    public function run(){
        $usuarioControl = new ControlUsuario();
        if (isset($_POST['ingresar'])) {
            $usuario = $_POST['usuario'];
            $password = $_POST['contrasenha'];
            if ($usuario =="administrador")
            {

                    header("location:adminView.php");
                    
                   
            }
            else
            {
            $result = $usuarioControl->verificarUsuario($usuario, $password);
            if ($result == 1) {
                $this->_usuario = $usuarioControl->buscarPorUsuario($usuario);
                $_SESSION['us'] = $this->_usuario;
                $_GET['opcion'] = "PMiPerfil";
                
            }else {
                    $opcion =$_GET['opcion']= "PLogin";
                    echo 'Usuario y/o Constrase&ntilde;a Incorrecta';
                }
            }
        }
        
         if (!isset($_GET['opcion'])) {
            $this->_mostrarPrincipal(null);
        }else{
            $opcion = $_GET['opcion'];
            switch($opcion){
            case'PLogin':
                $this->_mostrarPrincipal(null);
                break;
            case 'PMiPerfil':
                $this->_usuario = $_SESSION['us'];
                $this->_mostrarPrincipal($this->_usuario);
                break;
            case 'principal':
                $this->_usuario = $_SESSION['us'];
                $this->_mostrarPrincipal($this->_usuario);
                break;
             case 'nosotros':
                 $this->_usuario = $_SESSION['us'];
                 $this->_mostrarNosotros($this->_usuario);
                 break;
             case 'bCategoria':
                 $this->_usuario = $_SESSION['us'];
                 if($this->_usuario == null){
                    $this->_mostrarFallo();
                }else{
                 $id = $_POST['comboCategoria'];
                 print_r($id);
                 $contro = new ControlProducto();
                 $controlCategoria = new ControlCategoria();
                 $categoria = $controlCategoria->getAll();
                 $productos = $contro->findProductoPorCategoria($id);
                 $this->_mostrarCatalogo($this->_usuario,$productos,$categoria);
                }
                 break;
                 
             case 'catalogo':
                 $this->_usuario = $_SESSION['us'];
                if($this->_usuario == null){
                    $this->_mostrarFallo();
                }else{
                 $controlCategoria = new ControlCategoria();
                 $categoria = $controlCategoria->getAll();
                 $control = new ControlProducto();
                 $productos = $control->getAll();
                 $this->_mostrarCatalogo($this->_usuario,$productos,$categoria);
                }
                 break;
             case 'novedades':
                 $this->_usuario = $_SESSION['us'];
                 $this->_mostrarNovedades($this->_usuario);
                 break;
             case 'oContra':
                 $this->_olvidaste();
                 break;
             case 'miCuenta':
                 $this->_usuario = $_SESSION['us'];
                 $this->_mostrarMiCuenta($this->_usuario);
                 break;
             case 'contactenos':
                 $this->_usuario = $_SESSION['us'];
                 $this->_mostrarContactenos($this->_usuario);
                 break;
             case 'registrar':
                 $this->_mostrarRegistrar();
                 break;
             case 'enviarMensaje':
                 $this->_usuario = $_SESSION['us'];
                 $nombre = $_POST['nombre'];
                 $correo = $_POST['correo'];
                 $asunto = $_POST['asunto'];
                 $mensaje = $_POST['mensaje'];
                 $controlMensaje = new ControlMensaje();
                 $controlMensaje->insertarMensaje($mensaje, $nombre, $correo,$asunto);
                 echo 'Se mando el mensaje';
                 $this->_mostrarContactenos($this->_usuario);
                 break;
             
             case 'enviarOrden':
                 $this->_usuario = $_SESSION['us'];
                 $carrito = new Carrito;
                 $productos = $carrito->getItems();
                 $cantidadProducto= $carrito->cantidadPorProducto();
                 $controlProd = new ControlProducto();
                 foreach($productos as $producto){
                     $cantidad = $cantidadProducto[$producto->get_productoId()];
                     $cantActual = $producto->get_cantidad();
                     if($cantActual < $cantidad){
                         echo 'No hay Stock';
                     }else{
                     $id = $producto->get_productoId();
                     $nuevaCa = $cantActual - $cantidad;
                     $controlProd->modificar($id, $nuevaCa);
                     $carrito->vaciar();       
                    $controlCategoria = new ControlCategoria();
                    $categoria = $controlCategoria->getAll();
                    $control = new ControlProducto();
                    $productos = $control->getAll();
                      $this->_mostrarCatalogo($this->_usuario,$productos,$categoria);
                     }
                 }
                 break;
              
             case 'modificarCuenta':
                 $this->_usuario = $_SESSION['us'];
                 $this->_mostrarModificarCuenta($this->_usuario);
                 break;
                 
             case'agregar':
                 $id = $_GET['id'];
                 $carrito = new Carrito();
                 $controlProd = new ControlProducto();
                 $prod = $controlProd->buscarProducto($id);
                 $carrito->addItem($prod);
                 $long = $carrito->cantidad();
                 $total = $carrito->getTotal();
                 $lista = $carrito->getItems();
                 $cantidaProductos = $carrito->cantidadPorProducto();
                 $this->_usuario = $_SESSION['us'];
                 $this->_mostrarCarrito($this->_usuario,$lista,$total,$long,$cantidaProductos);
                 break;
             case 'eliminarProd':
                 $this->_usuario = $_SESSION['us'];
                 $id = $_GET['id'];
                 $carrito = new Carrito();
                 $carrito->deleteItem($id);
                 $controlCategoria = new ControlCategoria();
                 $categoria = $controlCategoria->getAll();
                 $control = new ControlProducto();
                 $productos = $control->getAll();
                 
                 $this->_mostrarCatalogo($this->_usuario, $productos, $categoria);
                 break;
             case 'modificarUser':
                 $this->_usuario = $_SESSION['us'];
                 $dni = $_POST['dni'];
                 $nombre = $_POST['nombres'];
                 $apellidoP = $_POST['apellidoP'];
                 $apellidoM = $_POST['apellidoM'];                
                 $telefono = $_POST['telefono'];
                 $distrito="";
                 $num = $_POST['distrito'];
                 switch($num){
                     case '1':
                         $distrito="Surquillo";
                         break;
                     case '2':
                         $distrito = "SMP";
                         break;
                     case '3':
                         $distrito = "Miraflores";
                         break;
                     case '4':
                         $distrito = "San Isidro";
                         break;
                 }                 
                 $direccion = $_POST['direccion'];
                 $departamento = $_POST['depart'];
                 $referencia = $_POST['referencia'];
                 $usuarioControl->modificarUsuario($this->_usuario->get_usuarioId(), $nombre, $apellidoP, $apellidoM, $dni, $direccion,$departamento, $distrito,$referencia);
                 $this->_mostrarPrincipal($this->_usuario);
                 break;
             
             case 'registrarU':
                 $dni = $_POST['dni'];
                 $nombre = $_POST['nombres'];
                 $apellidoP = $_POST['apellidoP'];
                 $apellidoM = $_POST['apellidoM'];
                 $contrasenha = $_POST['clave'];
                 $Rcontra = $_POST['claveR'];
                 $correo = $_POST['correo'];
                 $telefono = $_POST['telefono'];
                 $num = $_POST['comboDistrito'];
                 switch($num){
                     case '1':
                         $distrito="Surquillo";
                         break;
                     case '2':
                         $distrito = "SMP";
                         break;
                     case '3':
                         $distrito = "Miraflores";
                         break;
                     case '4':
                         $distrito = "San Isidro";
                         break;
                 }                 
                 $direccion = $_POST['direccion'];
                 $departamento = $_POST['departamento'];
                 $dep = $_POST['departamento'];
                 $referencia = $_POST['referencia'];
                 $usuarioControl->insertarUsuario( $nombre, $apellidoP, $apellidoM,
                         $dni,$telefono,$departamento, $contrasenha, $direccion, $distrito, $correo,$referencia);
                $this->_usuario = $_SESSION['us'];
                $this->_mostrarPrincipal($this->_usuario);
                 break;
                 
            }
        }
        
        
    }
    private function _mostrarModificarCuenta($usuario){
        require_once 'modificarCuenta.html';
    }
    
    private function _mostrarMiCuenta($usuario){
        require_once 'miCuenta.html';
    }

    private function _mostrarCarrito($usuario,$lista,$total,$longitud,$cantidadProd){
        require_once 'carrito.html';
    }
    
    private function _olvidaste(){
        require_once 'olvidoPass.html';
    }
    
    private function _mostrarRegistrar(){
        require_once 'registrarUsuario.html';
    }
    
    private function _mostrarContactenos($usuario){
        require_once 'contactenos.html';
    }
    
    private function _mostrarNovedades($usuario){
        require_once 'novedades.html';
    }
    
    
    private function _mostrarCatalogo($usuario,$productos,$categoria){
        require_once 'catalogo.html';
    }
    private function _mostrarFallo(){
        require_once 'catalogoFallo.html';
    }
    
    private function _mostrarNosotros($usuario){
        require_once 'nosotros.html';
    }
    
    private function _mostrarAdmin(){
        require_once 'principalAdmin.html';
    }
    private function _mostrarPrincipal($usuario){
        require_once 'principal.html';
    }
    
}
$miView = new view();
$miView->run();
?>
