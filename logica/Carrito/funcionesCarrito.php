<?php

include('conexionBd.php');

//Obtener codigo del carrito
function obtenerCodCarrito($idUsuario){
    abrirConexionCarrito();

    global $conexion;

    $sql = "SELECT * FROM tbl_carrito WHERE Usuario = $idUsuario";
    $resultado =  $conexion->query($sql);
    //se crea una variable que es un arreglo vacio
    $carrito = [];
    // evaluamos la variable resultado, para saber si si trajo algo la consulta, si si, empezamos a trabajar
    if($resultado->num_rows != 0 ){
        // creamos un ciclo para que de fila por fila, y si hay una fila la guarda en la variable row fetch_assoc pide linea por linea
        while($row = $resultado->fetch_assoc()){
            //llenamos el arreglo usuarios 
            $carrito[] = $row;
        }
    }
    cerrarConexionCarrito();
    return $carrito;
}

// //obtener todos los productos de cada carrito
// function obtenerProductosCarrito(){
    
//     abrirConexionCarrito();

//     global $conexion;

//     $sql = "SELECT * FROM tbl_productos";
//     $resultado =  $conexion->query($sql);
//     //se crea una variable que es un arreglo vacio
//     $productos = [];
//     // evaluamos la variable resultado, para saber si si trajo algo la consulta, si si, empezamos a trabajar
//     if($resultado->num_rows != 0 ){
//         // creamos un ciclo para que de fila por fila, y si hay una fila la guarda en la variable row fetch_assoc pide linea por linea
//         while($row = $resultado->fetch_assoc()){
//             //llenamos el arreglo usuarios 
//             $productos[] = $row;
//         }
//     }
//     cerrarConexionCarrito();
//     return $productos;
// }

// Agregar un producto a un carrito
function guardarProductoCarrito($codProducto, $codCarrito, $precio){

    abrirConexionCarrito();
    global $conexion;

    $sql = "INSERT INTO tbl_carrito_productos (Codigo_Productos, Codigo_Carrito, Precio, Cantidad) VALUES ($codProducto, $codCarrito, $precio, 1)";

    if($conexion->query($sql)== true){

        cerrarConexionCarrito();

        session_start();
        $_SESSION['msjAlerta'] ="¡Producto agregado al carrito!";
        header("Location: ../../html/producto.php?codigo=$codProducto");
        
        exit();
    }else{

        cerrarConexionCarrito();
        return "Error al crear producto en carrito" . $conexion->error; 
    }
    
}

// mostrar productos del carrito
function mostrarProductosCarrito($codCarrito){

    abrirConexionCarrito();
    global $conexion;

    $sql = "SELECT PR.Nombre, PR.Unidades_Disponibles, CP.Codigo_Productos, PR.Vendedor, CP.Codigo_Carrito, CP.Precio, PR.Precio_Venta, CP.Cantidad FROM tbl_productos as PR 
    INNER JOIN tbl_carrito_productos as CP ON PR.Codigo = CP.Codigo_Productos 
    WHERE CP.Codigo_Carrito = $codCarrito AND Estado = 'disponible' AND Unidades_Disponibles > 0";
    $resultado =  $conexion->query($sql);
    //se crea una variable que es un arreglo vacio
    $productosCarrito = [];
    // evaluamos la variable resultado, para saber si si trajo algo la consulta, si si, empezamos a trabajar
    if($resultado->num_rows != 0 ){
        // creamos un ciclo para que de fila por fila, y si hay una fila la guarda en la variable row fetch_assoc pide linea por linea
        while($row = $resultado->fetch_assoc()){
            //llenamos el arreglo usuarios 
            $productosCarrito[] = $row;
        }
    }
    cerrarConexionCarrito();
    return $productosCarrito;
    
}

// Eliminar producto del carrito
function eliminarProductoCarrito($codProducto){

    abrirConexionCarrito();
    global $conexion;

    $sql ="DELETE FROM tbl_carrito_productos WHERE Codigo_productos = $codProducto";
    if ($conexion -> query($sql)=== true){
        cerrarConexionCarrito();
        
        session_start();
        $_SESSION['msjAlerta'] ="Producto eliminado del carrito";

    }else{
        cerrarConexionCarrito();
        return "error al eliminar producto del carrito" . $conexion->error;
    }   

}

function actualizarProductoCarrito($productoID, $precio, $cantidad){
    
    abrirConexionCarrito();
    
    global $conexion;
    $sql = "UPDATE tbl_carrito_productos set Precio = '$precio', Cantidad= '$cantidad' WHERE Codigo_Productos = $productoID";
    if($conexion -> query($sql) === true){
        cerrarConexionCarrito();
    }else{
        cerrarConexionCarrito();
    }
}

?>