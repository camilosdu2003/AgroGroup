<?php


include ('conexionBd.php');

function buscarProductos($busqueda, $ordenar){
    

    global $conexion;
    
    abrirConexionBuscador();

    $sql = "SELECT * FROM tbl_productos  WHERE Nombre LIKE '%$busqueda%' $ordenar";
    $resultado =  $conexion->query($sql);
    //se crea una variable que es un arreglo vacio
    $productosBuscados = [];
    // evaluamos la variable resultado, para saber si si trajo algo la consulta, si si, empezamos a trabajar
    if($resultado->num_rows != 0 ){
        // creamos un ciclo para que de fila por fila, y si hay una fila la guarda en la variable row fetch_assoc pide linea por linea
        while($row = $resultado->fetch_assoc()){
            //llenamos el arreglo usuarios 
            $productosBuscados[] = $row;
        }
    }
    cerrarConexionBuscador();
    return $productosBuscados;
}

?>