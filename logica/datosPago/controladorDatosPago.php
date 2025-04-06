<?php
include ('./funcionesDatosPago.php');

if(isset($_POST['vendedor'])){
    $vendedor = $_POST['vendedor'];
    $cliente = $_POST['cliente'];
    $formaPago = $_POST['formaPago'];
    $direccion = $_POST['direccion'];
    $ciudad = $_POST['ciudad'];
    $cantidadDisponible = $_POST['unidadesDisponibles'];
    $cantidad = $_POST['cantidad']; 
    $precio = $_POST['precio'];  
    $codProducto = $_POST['codProducto'];

    ingresarVenta($vendedor, $cliente, $formaPago, $direccion, $ciudad, $cantidad, $precio, $codProducto);

    $venta = consultarVenta($vendedor, $cliente)[0];
    $codVenta = $venta['Codigo'];
    

    ingresarVentaProducto($codProducto, $codVenta, $precio, $cantidad);


    restarCantidadDisponible($cantidad, $cantidadDisponible, $codProducto);

    $cantidadProducto = obtenerCantidadProducto($codProducto);

    if($cantidadProducto < 1){
        $correoVendedor = consultarCorreo($vendedor);
        
        enviarCorreoExistenciaAgotada($correoVendedor['Email'], $correoVendedor['Nombre'], $codProducto);
    }

    
}

?>