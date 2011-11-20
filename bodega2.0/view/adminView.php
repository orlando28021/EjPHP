<?php
require_once '/../control/ControlUsuario.php';
require_once '/../control/ControlTipo.php';
require_once '/../control/ControlProducto.php';
require_once '/../control/ControlCategoria.php';
require_once '/../control/ControlProveedor.php';
require_once '/../model/Usuario.php';
require_once '../control/ControlMensaje.php';
//Obligatorio esta ruta
require_once '../control/GraphBar.php';

session_start();
class adminView {
    private $_admin;
    private $_arreglo = array();
    public function run(){
         if (!isset($_GET['opcion'])) {
            $this->_mostrarAdmin();
        }else{
            $arreglo = array();
            $obj = new ControlMensaje();
            $opcion = $_GET['opcion'];
            switch($opcion){
                case'principalA':
                    $this->_mostrarAdmin();
                    break;
                case'clientes':
                    $usuario = new ControlUsuario();
                    $clientes = $usuario->getAll();
                    $this->_mostrarClientes($clientes);
                    break;
                case'detalleCliente':
                    $clienteId = $_GET['id'];
                    $usuario = new ControlUsuario();
                    $cliente = $usuario->buscarUsuario($clienteId);
                    $this->_mostrarClienteDetalle($cliente);
                    break;
                 case'buscarCliente':
                    $texto = $_POST['buscarCliente'];
                    $usuario = new ControlUsuario();
                    $clientes = $usuario->buscarClientePorTexto($texto);
                   
                    $this->_mostrarClientes($clientes);
                    break;
                 case'eliminarCliente':
                    $clienteId = $_GET['id'];
                    $usuario = new ControlUsuario();
                    $clientes = $usuario->getAll();
                    $usuario->eliminarUsuario($clienteId);
                    $this->_mostrarClientes($clientes);
                    break;
                case'producto':
                    $producto = new ControlProducto();
                    $usuario = new ControlUsuario();
                    $tipo = new ControlTipo();
                    $productos = $producto->getAll();
                    $this->_mostrarProductos($productos, $tipo);
                    break;
                 case'detalleProducto':
                    $productoId = $_GET['id'];
                    $producto = new ControlProducto();
                    $categoria = new ControlCategoria();
                    $tipo = new ControlTipo();
                    $proveedor = new ControlProveedor();
                    $nuevoProducto = $producto->buscarProducto($productoId);
                    $ganancia =  $nuevoProducto->get_precio() - $nuevoProducto->get_costo();
                    $nombreCategoria = $categoria->obtenerCategoriaPorId($tipo->obtenerCategoriaPorTipo($nuevoProducto->get_tipoId()));
                    $nombreTipo = $tipo->getNombrePorId($nuevoProducto->get_tipoId());
                    $nombreProveedor = $proveedor->obtenerNombrePorId($nuevoProducto->get_proveedorId());
                    $this->_mostrarProductoDetalle($nuevoProducto, $nombreProveedor, $nombreTipo, $nombreCategoria,$ganancia);
                    break;
                 case'buscarProducto':
                    $texto = $_POST['producto'];
                     print_r($texto);
                    $ctrlProducot = new ControlProducto();
                    $productos = $ctrlProducot->buscarProductoPorTexto($texto);
                    $tipo = new ControlTipo();
                    $this->_mostrarProductos($productos, $tipo);
                    break;
                 case'eliminarProducto':
                    $productoId = $_GET['id'];
                    $producto = new ControlProducto();
                    $tipo = new ControlTipo();
                    $producto->eliminarProducto($productoId);
                    $lista = $producto->getAll();
                    $this->_mostrarProductos($lista, $tipo);
                    break;

                case 'realizarPedido':
                    $producto = new ControlProducto();
                    $tipo = new ControlTipo();
                    $productos = $producto->buscarPorProveedor('1');
                    $this->_mostrarPedido($productos,$tipo,null,null);
                    break;
                case 'agregarCarrito':
                    $id = $_GET['id'];
                    $producto = new ControlProducto();
                    $buscar = $producto->buscarProducto($id);
                    $productos = $producto->buscarPorProveedor('1');
                    $arreglo = $_SESSION['car'];
                    $cantidad = $_POST['cantidad'];
                    $arreglo = $buscar;
                    $_SESSION['car'] = $arreglo;
                    $tipo = new ControlTipo();
                    $this->_mostrarPedido($productos,$tipo,$buscar,$cantidad);
                    break;
                case 'historial':
                    //Todo copia
                    if(isset ($_POST['buscarBarra'])){
                        $buscarBarra=$_POST['buscarBarra'];
                    }else {
                        $buscarBarra="semana";
                    }
                    $imagen = new GraphBar();
                    if($buscarBarra=="semana"){
                        $imagen->_showGraph_pChart($buscarBarra);
                    }  elseif ($buscarBarra=="mes") {
                        $imagen->_showGraph_pChart($buscarBarra);
                    }
                    $this->_mostrarHistorial();
                    //Fin de copiar
                    break;

                case 'proveedores':
                     $proveedor = new ControlProveedor();
                    $proveedores = $proveedor->getAll();
                    $this->_mostrarProveedores($proveedores);
                    break;

                case 'mostrarAgregarProveedor':
                    $this->_mostrarAgregarProveedor();
                    break;

                case 'agregarProveedor':                // luis
                    $nombreEmpresa = $_POST['nombre'];
                    $ruc = $_POST['ruc'];
                    $correo = $_POST['correo'];
                    $nombreContacto = $_POST['nombres'];
                    $apellidoContacto = $_POST['apellidos'];
                    $dniContacto = $_POST['dni'];
                    $telefonoContacto = $_POST['telefono'];
                    $proveedor = new ControlProveedor();
                    $producto = new ControlProducto();
                    $categoria = new ControlCategoria();
                    $proveedor->insertarProveedor($nombreEmpresa, $ruc, $correo, $nombreContacto, $apellidoContacto, $dniContacto, $telefonoContacto);            
                    $proveedorEncontrado = $proveedor->buscarProveedorPorNombre($nombreEmpresa);
                    $proveedorEncontrado = $proveedor->buscarProveedorPorNombre($nombreEmpresa);
                    $categorias = $categoria->getAll();
                    $proveedores = null;
                    $this->_mostrarAgregarProducto($proveedores, $proveedorEncontrado, $categorias);
                    break;

                case 'mostrarAgregarProducto':
                    $proveedorEncontrado = null;
                    $categoria = new ControlCategoria();
                    $proveedor = new ControlProveedor();
                    $tipo = new ControlTipo();
                    $tipos = $tipo->getAll();
                    $proveedores = $proveedor->getAll();
                    $categorias = $categoria->getAll();
                    $this->_mostrarAgregarProducto($proveedores, $proveedorEncontrado, $categorias, $tipos);
                    break;
                
                case 'agregarProducto':
                    $proveedorId = $_POST['comboProveedores'];
                    $marca = $_POST['marca'];
                    $tipoId = $_POST['comboTipos'];
                    $costo = $_POST['precioCompra'];
                    $precio = $_POST['precioVenta'];
                    $cantidad = $_POST['cantidad'];
                    $descripcion = $_POST['descripcion'];
                    $producto = new ControlProducto();
                    $producto->insertarProducto($proveedorId, $marca, $tipoId, $costo, $precio, $cantidad, $descripcion);
                    $_GET['opcion'] = "producto";
                    $this->run();
                    break;

                case 'mostrarModificarProveedor':
                    $proveedorId = $_GET['id'];
                    $proveedor = new ControlProveedor();
                    $proveedorEncontrado = $proveedor->buscarProveedorPorId($proveedorId);
                    $this->_mostrarModificarProveedor($proveedorEncontrado);
                    break;

                case 'modificarProducto':
                    $productoId = $_GET['id'];
                    $proveedorId = $_POST['comboProveedores'];
                    $marca = $_POST['marca'];
                    $tipoId = $_POST['comboTipos'];
                    $costo = $_POST['precioCompra'];
                    $precio = $_POST['precioVenta'];
                    $cantidad = $_POST['cantidad'];
                    $descripcion = $_POST['descripcion'];
                    $producto = new ControlProducto();
                    $producto->modificarProducto($productoId, $proveedorId, $marca, $tipoId, $costo, $precio, $cantidad, $descripcion);
                    $_GET['opcion'] = "producto";
                    $this->run();
                    break;

                case 'modificarProveedor':
                    $proveedorId = $_GET['id'];
                    $nombreEmpresa = $_POST['nombre'];
                    $ruc = $_POST['ruc'];
                    $correo = $_POST['correo'];
                    $nombreContacto = $_POST['nombres'];
                    $apellidoContacto = $_POST['apellidos'];
                    $dniContacto = $_POST['dni'];
                    $telefonoContacto = $_POST['telefono'];
                    $proveedor = new ControlProveedor();
                    $proveedor->modificarProveedor($proveedorId, $nombreEmpresa, $ruc, $correo, $nombreContacto, $apellidoContacto, $dniContacto, $telefonoContacto);
                    $_GET['opcion'] = "proveedores";
                    $this->run();
                    break;

                case 'eliminarProveedor':
                    $proveedor = new ControlProveedor();
                    $idProveedor = $_GET['id'];
                    $proveedor->eliminarProveedor($idProveedor);
                    $_GET['opcion'] = "proveedores";
                    $this->run();
                    break;

                case 'detalleProveedor':
                    $this->_mostrarDetalleProv();
                    break;
                              
                case'detalleProveedor':
                    $productoId = $_GET['id'];
                    $producto = new ControlProducto();
                    $categoria = new ControlCategoria();
                    $tipo = new ControlTipo();
                    $proveedor = new ControlProveedor();
                    $nuevoProducto = $producto->buscarProducto($productoId);
                    $nombreCategoria = $categoria->obtenerCategoriaPorId($tipo->obtenerCategoriaPorTipo($nuevoProducto->get_tipoId()));
                    $nombreTipo = $tipo->getNombrePorId($nuevoProducto->get_tipoId());
                    $nombreProveedor = $proveedor->obtenerNombrePorId($nuevoProducto->get_proveedorId());
                    $this->_mostrarProductoDetalle($nuevoProducto, $nombreProveedor, $nombreTipo, $nombreCategoria);
                    break;

                case 'mostrarAgregarProducto':
                    $proveedorEncontrado = null;
                    $categoria = new ControlCategoria();
                    $proveedor = new ControlProveedor();
                    $proveedores = $proveedor->getAll();
                    $categorias = $categoria->getAll();
                    $this->_mostrarAgregarProducto($proveedores, $proveedorEncontrado, $categorias);
                    break;

                case 'mostrarModificarProducto':
                    $productoId = $_GET['id'];
                    $producto = new ControlProducto();
                    $categoria = new ControlCategoria();
                    $proveedor = new ControlProveedor();
                    $tipo = new ControlTipo();
                    $proveedores = $proveedor->getAll();
                    $categorias = $categoria->getAll();
                    $tipos = $tipo->getAll();
                    $productoEncontrado = $producto->buscarProducto($productoId);

                    $this->_mostrarModificarProducto($productoEncontrado,$categorias, $tipos, $proveedores);
                    break;

                 case'buscarProducto':
                    $texto = $_POST['nuevoTexto'];
                    echo 'el texto es '.$texto;
                    $usuario = new ControlUsuario();
                    $clientes = $usuario->buscarClientePorTexto($texto);
                    $this->_mostrarClientes($clientes);
                    break;
                 case'eliminarProducto':
                    $productoId = $_GET['id'];
                    $producto = new ControlProducto();
                    $tipo = new ControlTipo();
                    $productos = $producto->eliminarProducto($productoId);
                    $this->_mostrarProductos($productos, $tipo);
                    break;
                case 'mensajes':
                    $obj = new ControlMensaje();
                    $lista = $obj->getAll();
                    $this->_mostrarMensaje($lista);
                    break;
                
                case 'ver':
                    $id = $_GET['id'];
                    $mensaje = $obj->buscarMensaje($id);
                    $this->_mostrarMensajeDetalle($mensaje);
                    break;
                case 'eliminar':
                    $id = $_GET['id'];
                    $obj->eliminarMensaje($id);
                    $lista = $obj->getAll();
                    $this->_mostrarMensaje($lista);
                    break;
                case 'enviarNuevo':
                    //$obj->buscarMensaje($id);
                    $this->_mostrarMensajeEnviar();
                    break;
                case 'enviarMensaje':
                    $destino = $_POST['forEmail'];
                    $asunto = $_POST['subject'];
                    $body = $_POST['bodyMessage'];
                    mail($destino, $asunto, $body,"orlando28021@hotmail.com");
                    echo 'Mensaje Enviado';
                     $obj = new ControlMensaje();
                    $lista = $obj->getAll();
                    $this->_mostrarMensaje($lista);
                    break;
                case 'enviar':
                    
                    $this->_mostrarMensajeEnviar();
                    break;
                case 'regresar':
                    $lista = $obj->getAll();
                    $this->_mostrarMensaje($lista);
                    break;

                case'PLogin':
                    $this->_mostrarAdmin();
                    break;
            }
            
            
            }
        }

    private function _mostrarMensaje($lista){
        require_once 'mensaje.html';
    }
    private function _mostrarMensajeDetalle($mensaje){
        require_once 'mensajeDetalle.html';
    }
    private function _mostrarMensajeEnviar(){
        require_once 'mensajeEnviar.html';
    }    
        
    private function _mostrarDetalleProv(){
        require_once 'detalleProv.html';
    }

    private function _mostrarAgregarProducto($proveedores, $proveedorEncontrado, $categorias, $tipos){
        require_once 'agregarProducto.html';
    }

    private function _mostrarModificarProducto($productoEncontrado,$categorias, $tipos, $proveedores){
        require_once 'modificarProducto.html';
    }
        
    private function _mostrarPedido($productos,$tipo,$buscar,$cantidad){
        require_once 'hacerPedido.html';
    }

    private function _mostrarAgregarProveedor(){
        require_once 'agregarProveedor.html';
    }
    private function _mostrarModificarProveedor($proveedorEncontrado){
        require_once 'modificarProv.html';
    }
    
    private function _mostrarAdmin(){
        require_once 'principalAdmin.html';
    }
    private function _mostrarClientes($clientes){
        require_once 'clientes.html';
    }
    private function _mostrarClienteDetalle($cliente){
        require_once 'clienteDetalle.html';
    }
    private function _mostrarProductos($productos, $tipo){
        require_once 'productos.html';
    }
    private function _mostrarProductoDetalle($nuevoProducto, $nombreProveedor, $nombreTipo, $nombreCategoria,$ganancia){
        require_once 'detalleProducto.html';
    }
    private function _mostrarProveedores($proveedores){
        require_once 'proveedores.html';
    }
     private function _mostrarHistorial(){
        require_once 'historial.html';
    }

}
$miView = new adminView();
$miView->run();
?>
