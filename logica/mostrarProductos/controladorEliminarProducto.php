<?php

include('./funciones.php');

if(isset($_POST['ventas'])){
    $codProducto = $_POST['codigo'];
    header('Location: ../../html/ventas_mis_productos.php?codigo='.$codProducto);
}

if(isset($_POST['editar'])){
    $codProducto = $_POST['codigo'];
    header('Location: ../../html/editar_producto.php?codigo='.$codProducto);
}

if(isset($_POST['eliminar'])){
    $codProducto = $_POST['codigo'];

    $ventasProductos = obtenerVentasProducto($codProducto);

    if($ventasProductos == null ){
        eliminarProducto($codProducto);
        
    }else{
        cambiarEstadoNoDisponible($codProducto);
        header('Location: ../../html/mis_productos.php');
    }
 
}



?>