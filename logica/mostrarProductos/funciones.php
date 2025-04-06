<?php


include_once('conexionBd.php');

//obtener todos los productos
function obtenerProductos(){
    
    abrirConexion();

    global $conexion;

    $sql = "SELECT * FROM tbl_productos WHERE Estado = 'disponible' AND Unidades_Disponibles > 0 ";
    $resultado =  $conexion->query($sql);
    //se crea una variable que es un arreglo vacio
    $productos = [];
    // evaluamos la variable resultado, para saber si si trajo algo la consulta, si si, empezamos a trabajar
    if($resultado->num_rows != 0 ){
        // creamos un ciclo para que de fila por fila, y si hay una fila la guarda en la variable row fetch_assoc pide linea por linea
        while($row = $resultado->fetch_assoc()){
            //llenamos el arreglo usuarios 
            $productos[] = $row;
        }
    }
    cerrarConexion();
    return $productos;
}

// Obtener un solo producto
function obtenerUnProducto($codigo){
    abrirConexion();

    global $conexion;
    $sql = "SELECT * FROM tbl_productos WHERE Codigo = $codigo";
    $resultado =  $conexion->query($sql);
    // arreglo para almecenar el usuario
    $producto = [];
    $row = $resultado->fetch_assoc();
    if($row){
        $producto[] = $row;
    }
    
    cerrarConexion();
    return $producto;
}

//obtener la categoria de un producto
function obtenerCategoria($codigoCategoria){
    abrirConexion();

    global $conexion;
    $sql = "SELECT CA.Nombre as'categoria'
    FROM tbl_categoria as CA INNER JOIN tbl_productos as PR
    on CA.Codigo = PR.Categoria
    WHERE PR.Categoria = $codigoCategoria";
    $resultado =  $conexion->query($sql);
    // arreglo para almecenar el usuario
    $categoria = [];
    $row = $resultado->fetch_assoc();
    if($row){
        $categoria[] = $row;
    }
    
    cerrarConexion();
    return $categoria; 
}

// obtener mis productos
function obtenerMisProductos($documento){
    abrirConexion();

    global $conexion;

    $sql = "SELECT * FROM tbl_productos WHERE Vendedor = $documento AND Estado = 'disponible' ";
    $resultado =  $conexion->query($sql);
    //se crea una variable que es un arreglo vacio
    $productos = [];
    // evaluamos la variable resultado, para saber si si trajo algo la consulta, si si, empezamos a trabajar
    if($resultado->num_rows != 0 ){
        // creamos un ciclo para que de fila por fila, y si hay una fila la guarda en la variable row fetch_assoc pide linea por linea
        while($row = $resultado->fetch_assoc()){
            //llenamos el arreglo usuarios 
            $productos[] = $row;
        }
    }
    cerrarConexion();
    return $productos;
}

// obtener mis pedidos
function obtenerMisPedidos($documento){
    abrirConexion();

    global $conexion;

    $sql = "SELECT ve.Codigo as 'codigoVenta', PR.Codigo, PR.Nombre, PR.Precio_Venta FROM tbl_productos AS PR INNER JOIN tbl_venta_producto AS VP 
    ON VP.Codigo_producto = PR.Codigo INNER JOIN tbl_venta as VE
    ON VE.Codigo = VP.Codigo_venta 
    WHERE VE.Cliente = $documento";
   
    $resultado =  $conexion->query($sql);
    //se crea una variable que es un arreglo vacio
    $productos = [];
    // evaluamos la variable resultado, para saber si si trajo algo la consulta, si si, empezamos a trabajar
    if($resultado->num_rows != 0 ){
        // creamos un ciclo para que de fila por fila, y si hay una fila la guarda en la variable row fetch_assoc pide linea por linea
        while($row = $resultado->fetch_assoc()){
            //llenamos el arreglo usuarios 
            $productos[] = $row;
        }
    }
    cerrarConexion();
    return $productos;
}

//obtener imagenes
function obtenerImagenes($idProducto){
    
    abrirConexion();

    global $conexion;

    $sql = "SELECT IM.imagen from tbl_imagenes as IM inner join tbl_imagenes_productos as IP
    on IM.Codigo_Imagen = IP.Codigo_Imagen 
    where IP.Codigo_Producto = $idProducto;";
    $resultado =  $conexion->query($sql);
    //se crea una variable que es un arreglo vacio
    $imagenes = [];
    // evaluamos la variable resultado, para saber si si trajo algo la consulta, si si, empezamos a trabajar
    if($resultado->num_rows != 0 ){
        // creamos un ciclo para que de fila por fila, y si hay una fila la guarda en la variable row fetch_assoc pide linea por linea
        while($row = $resultado->fetch_assoc()){
            //llenamos el arreglo usuarios 
            $imagenes[] = $row;
        }
    }
    cerrarConexion();
    return $imagenes;
}

//Funcion para obtener los productos segun la categoria
function obtenerProductosCategoria($categoria){
    abrirConexion();

    global $conexion;

    $sql = "SELECT * FROM tbl_productos WHERE Categoria = $categoria AND Estado = 'disponible' AND Unidades_Disponibles > 0 ";
    $resultado =  $conexion->query($sql);
    //se crea una variable que es un arreglo vacio
    $productos = [];
    // evaluamos la variable resultado, para saber si si trajo algo la consulta, si si, empezamos a trabajar
    if($resultado->num_rows != 0 ){
        // creamos un ciclo para que de fila por fila, y si hay una fila la guarda en la variable row fetch_assoc pide linea por linea
        while($row = $resultado->fetch_assoc()){
            //llenamos el arreglo usuarios 
            $productos[] = $row;
        }
    }
    cerrarConexion();
    return $productos;
}

//consulta para validar si ya existe alguna venta del producto, para su posterior eliminacion
function obtenerVentasProducto($codProducto){
    abrirConexion();

    global $conexion;

    $sql = "SELECT * FROM tbl_venta_producto where Codigo_producto = $codProducto ";
    $resultado =  $conexion->query($sql);
    //se crea una variable que es un arreglo vacio
    $ventasProductos = [];
    // evaluamos la variable resultado, para saber si si trajo algo la consulta, si si, empezamos a trabajar
    if($resultado->num_rows != 0 ){
        // creamos un ciclo para que de fila por fila, y si hay una fila la guarda en la variable row fetch_assoc pide linea por linea
        while($row = $resultado->fetch_assoc()){
            //llenamos el arreglo usuarios 
            $ventasProductos[] = $row;
        }
    }
    cerrarConexion();
    return $ventasProductos;

}

// Eliminar producto, esta funcio se invoca desde el controlador, despues de validar que no haya ninguna venta del producto
function eliminarProducto($codProducto){
    abrirConexion();

    global $conexion;

    // consultar codigo y nombre de las imagenes del producto
    $imagenes = obtenerCodigoImagenes($codProducto);
    //Se eliminan la relacion que hay entre imagenes y productos (tabla imagenes_productos)
    eliminarImagenesProductos($codProducto);
    //Se eliminan las imagenes de la tabla imagenes
    foreach($imagenes as $imagen){

        eliminarImagenes($imagen['Codigo_Imagen']);
        $rutaImagen = "../../img/".$imagen['Nombre'];
        //funcion para borrar la imagen de la carpeta img del proyecto
        unlink($rutaImagen);
    }

    eliminarCarritoProducto($codProducto);

    abrirConexion();

    $sql = "DELETE FROM tbl_productos WHERE Codigo = $codProducto";
    if ($conexion -> query($sql)=== true){
        cerrarConexion();
        
        session_start();
        $_SESSION['msjAlerta'] ="Producto eliminado";
        header('Location: ../../html/mis_productos.php');
        exit();
    }else{
        cerrarConexion();
        return "error al eliminar producto" . $conexion->error;
    }
}

//funcion para obtener el codigo y nombre de las imagenes a eliminar en la tabla de imagenes al eliminar un producto
function obtenerCodigoImagenes($codProducto){
    abrirConexion();

    global $conexion;

    $sql = "SELECT IM.Codigo_Imagen, IM.Nombre 
    FROM tbl_imagenes AS IM INNER JOIN tbl_imagenes_productos AS IP
    ON IM.Codigo_Imagen = IP.Codigo_Imagen
    where IP.Codigo_Producto = $codProducto";

    $resultado =  $conexion->query($sql);
    //se crea una variable que es un arreglo vacio
    $productos = [];
    // evaluamos la variable resultado, para saber si si trajo algo la consulta, si si, empezamos a trabajar
    if($resultado->num_rows != 0 ){
        // creamos un ciclo para que de fila por fila, y si hay una fila la guarda en la variable row fetch_assoc pide linea por linea
        while($row = $resultado->fetch_assoc()){
            //llenamos el arreglo usuarios 
            $productos[] = $row;
        }
    }
    cerrarConexion();
    return $productos;

}

//funcion para eliminar los registros de la tabla imagenesProductos
function eliminarImagenesProductos($codProducto){
    abrirConexion();

    global $conexion;

    $sql = "DELETE FROM tbl_imagenes_productos WHERE Codigo_Producto = $codProducto";
    if ($conexion -> query($sql)=== true){
        cerrarConexion();
        return "imagenes_Producto eliminado correctamente";
    }else{
        cerrarConexion();
        return "error al eliminar imagenes_Producto " . $conexion->error;
    }
    
}

//funcion para eliminar las imagenes de la tabla imagenes
function eliminarImagenes($codImagen){

    abrirConexion();

    global $conexion;

    $sql = "DELETE FROM tbl_imagenes WHERE Codigo_Imagen = $codImagen";
    if ($conexion -> query($sql)=== true){
        cerrarConexion();
        return "imagen eliminada correctamente";
    }else{
        cerrarConexion();
        return "error al eliminar imagen " . $conexion->error;
    }

}

//Funcion para eliminar los productos del carrito
function eliminarCarritoProducto($codProducto){
    abrirConexion();

    global $conexion;

    $sql = "DELETE FROM tbl_carrito_productos WHERE Codigo_Productos = $codProducto";
    if ($conexion -> query($sql)=== true){
        cerrarConexion();
        return "carrito producto eliminado correctamente";
    }else{
        cerrarConexion();
        return "error al eliminar carrito prodcuto " . $conexion->error;
    }

}

//funcion para actualizar el estado del producto, de disponible a noDisponible
function cambiarEstadoNoDisponible($codProducto){
    abrirConexion();

    global $conexion;

    $sql = "UPDATE tbl_productos SET Estado = 'noDisponible'  WHERE Codigo = $codProducto";

    if ($conexion->query($sql) === TRUE){

        cerrarConexion();
        session_start();
        $_SESSION['msjAlerta'] ="Producto eliminado";
        header('Location: ../../html/mis_productos.php');
        exit();
    } else {
        return "Error al actualizar estado" . $conexion->error;
        cerrarConexion();
    }
} 
?>