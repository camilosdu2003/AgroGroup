<?php
include('.././conexionBd.php');

// Agregar foto del producto
function agregarFotoProducto($nombreFoto, $imagen){
    
    abrirConexion();

    global $conexion;
    $sql = "INSERT INTO tbl_imagenes (nombre, imagen) VALUES ('$nombreFoto', '$imagen')"; // insertamos los datos en la base de datos

     // con la variable conexion hacemos la query, esta query devuelve true o false y usamos esto para verificar que si se ejecuto la query exitosamente
    if($conexion->query($sql)===true){  
        cerrarConexion();
        return "imagen guardada correctamente";
    }else{
        cerrarConexion();
        return "error al guardar imagen" . $conexion->error;
    }
}

// Agregar producto
function agregarProducto($nombreProducto, $descripcion, $unidadesDisponibles, $precio, $categoria, $id){
    
    abrirConexion();

    global $conexion;
    $sql = "INSERT INTO tbl_productos (nombre, descripcion, precio_Venta, categoria, unidades_Disponibles, vendedor, Estado) VALUES ('$nombreProducto', '$descripcion', $precio, $categoria, $unidadesDisponibles, '$id', 'disponible')"; // insertamos los datos en la base de datos

     // con la variable conexion hacemos la query, esta query devuelve true o false y usamos esto para verificar que si se ejecuto la query exitosamente
    if($conexion->query($sql)===true){  
        cerrarConexion();

        session_start();
        $_SESSION['msjAlerta'] ="Producto publicado";
        header("Location: ../../html/mis_productos.php");
        
    }else{
        cerrarConexion();
        return "error al crear producto" . $conexion->error;
    }
}

// Consultar codigo de la foto
function consultarCodFoto($imagen){
    abrirConexion();

    global $conexion;
    $sql = "SELECT * FROM tbl_imagenes WHERE imagen = '$imagen'";
    $resultado =  $conexion->query($sql);
    // arreglo para almecenar el usuario
    $foto = [];
    $row = $resultado->fetch_assoc();
    if($row){
        $foto[] = $row;
    }

    cerrarConexion();
    return $foto;
}

// Consultar codigo del producto
function consultarCodProducto($nombreProducto, $id){
    abrirConexion();

    global $conexion;
    $sql = "SELECT * FROM tbl_productos  WHERE nombre = '$nombreProducto' AND vendedor = '$id'";
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

// agregar relacion producto foto
function  agregarRelacionFotoProducto($codigoProducto, $codigoFoto){
    
    abrirConexion();

    global $conexion;
    $sql = "INSERT INTO tbl_imagenes_productos (codigo_Producto, codigo_Imagen) VALUES ($codigoProducto, $codigoFoto)"; // insertamos los datos en la base de datos

     // con la variable conexion hacemos la query, esta query devuelve true o false y usamos esto para verificar que si se ejecuto la query exitosamente
    if($conexion->query($sql)===true){  
        cerrarConexion();
        return "relacion intermedia creada correctamente";
    }else{
        cerrarConexion();
        return "error al crear relacion intermedia" . $conexion->error;
    }
}

//Actualiar producto
function actualizarProducto($nombreProducto, $descripcion, $unidadesDisponibles, $precio, $categoria, $id, $codProducto){
    abrirConexion();

    global $conexion;

    $sql = "UPDATE tbl_productos SET Nombre = '$nombreProducto', Descripcion = '$descripcion', Precio_Venta = $precio, Categoria = $categoria, Unidades_Disponibles = $unidadesDisponibles, Vendedor = $id WHERE Codigo = $codProducto";

    if ($conexion->query($sql) === TRUE){

        cerrarConexion();
        
        session_start();
        $_SESSION['msjAlerta'] ="Producto editado Correctamente";
        header("Location: ../../html/mis_productos.php");

        exit();
    } else {
        return "Error al actualizar usuario" . $conexion->error;
        cerrarConexion();
    }
}

// Actualizar fotos del producto
function actualizarFotoProducto($nombreFoto, $imagen, $codigoFoto){
    abrirConexion();

    global $conexion;

    $sql = "UPDATE tbl_imagenes SET Nombre = '$nombreFoto', Imagen = '$imagen',  WHERE Codigo_Imagen =  $codigoFoto";

    if ($conexion->query($sql) === TRUE){

        cerrarConexion();
        header("Location: ../../html/mis_productos.php");
        exit();
    } else {
        return "Error al actualizar usuario" . $conexion->error;
        cerrarConexion();
    }

}


?>