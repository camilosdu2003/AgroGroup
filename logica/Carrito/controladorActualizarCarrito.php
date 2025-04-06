<?php
include('./funcionesCarrito.php');



// // Actualizar cantidad y precio de la tabla caarito_producto de la DB
if(isset($_POST['quantityProductsEdit'])){
    $cantidadProductos = $_POST['quantityProductsEdit'];
    $productoIdEdit = $_POST['itemIdEdit'];
    $precioEdit = $_POST['itemPriceEdit'];
    $cantidadEdit = $_POST['itemQuantityEdit'];
    $vendedores = $_POST['vendedor'];
    $cantidadDisponibleEdit = $_POST['cantidadDisponible'];

    $productos = array(); 

    foreach($productoIdEdit as $index => $productoId){
        $productoID = $productoIdEdit[$index];
        $precio = $precioEdit[$index];
        $cantidad = $cantidadEdit[$index];
        $vendedor = $vendedores[$index];
        $cantidadDisponible = $cantidadDisponibleEdit[$index];

       
        actualizarProductoCarrito($productoID, $precio, $cantidad);

        // Este arreglo es para agregar la venta de cada producto, se envia a controlador venta carrito
        $producto = array(
            'id' => $productoID,
            'precio' => $precio,
            'cantidad' => $cantidad,
            'vendedor' => $vendedor,
            'cantidadDisponible' => $cantidadDisponible
        );
        $productos[] = $producto; 
    }  
    $datosSerializados = serialize($productos);
    file_put_contents('datos.txt', $datosSerializados);
    header("Location: ../../html/pago_carrito2.php");
}






?>