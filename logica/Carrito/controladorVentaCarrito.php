<?php
include('../datosPago/funcionesDatosPago.php');
//Ventas desde el carrito 
if(isset($_POST['opcion'])){

    $formaPago = $_POST['opcion'];
    $cliente = $_POST['cliente'];
    
    $direccion = $_POST['direccion'];
    $ciudad = $_POST['ciudad'];

    // Leer el archivo con los datos serializados
    $datosSerializados = file_get_contents('datos.txt');

    // Deserializar los datos para obtener el arreglo original
    $productos = unserialize($datosSerializados);

    foreach($productos as $index => $producto){
        $vendedor = $producto['vendedor'];
        $codProducto = $producto['id'];
        $precio = $producto['precio'];
        $cantidad = $producto['cantidad'];
        $cantidadDisponible = $producto['cantidadDisponible'];
    
        ingresarVenta($vendedor, $cliente, $formaPago, $direccion, $ciudad, $cantidad, $precio, $codProducto);
        restarCantidadDisponible($cantidad, $cantidadDisponible, $codProducto);

        $venta = consultarVenta($vendedor, $cliente)[0];
        $codVenta = $venta['Codigo'];
        
        ingresarVentaProducto($codProducto, $codVenta, $precio, $cantidad);
        
    }
        echo borrarProductosCarrito($cliente);
    //borrar productos del carrito

    

}

?>