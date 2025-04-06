<?php
include('./funcionesCarrito.php');
// se valida que si este iniciada la sesion para poder agregar al carrito

if(isset($_POST['codCarrito']) && $_POST['codCarrito'] != null){

    // obtenemos el codigo de los productos que hay en el carrito
    $productosCarrito = mostrarProductosCarrito($_POST['codCarrito']);

    // se valida que el codigo del producto no exista en el carrito
    foreach($productosCarrito as $index => $productoCarrito){
        if($_POST['codProducto'] == $productoCarrito['Codigo_Productos'] && $_POST['codCarrito'] == $productoCarrito['Codigo_Carrito']){
            // Si existe se redirige al carrito 
            header("Location: ../../html/carrito.php");
            exit();
        }
    }
    //Si el codigo del producto no existe en el carrito entonces, se guarda el producto en el carrito  
    $codProducto = $_POST['codProducto'];
    $codCarrito = $_POST['codCarrito'];
    $precio = $_POST['precio'];
    guardarProductoCarrito($codProducto, $codCarrito, $precio);

   
}else{

    // si la session no esta iniciada se redirige al iniciar sesion
    header("Location: ../../html/iniciar_sesion.php");
}



// // borrar un producto del carrito
if(isset($_POST['item_id'])){

    echo eliminarProductoCarrito($_POST['item_id']);
    header("Location: ../../html/carrito.php");
    exit();
}






?>