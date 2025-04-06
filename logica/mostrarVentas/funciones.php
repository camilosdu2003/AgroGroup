<?php

// include('conexionBd.php');


// obtener las ventas de un producto
function obtenerVentasUnProducto($idProducto){
    abrirConexion();

    global $conexion;

    $sql = "SELECT 
        pr.Nombre AS 'producto',
        ve.Codigo, 
        concat(us.Nombre,' ',us.Apellido) AS 'cliente', 
        ve.Direccion, 
        ci.municipio,
        de.Departamento,
        ve.Fecha_Venta,
        vp.Cantidad
        FROM tbl_venta AS VE INNER JOIN tbl_venta_producto AS VP
        ON VE.Codigo = VP.Codigo_Venta
        INNER JOIN tbl_productos AS PR 
        ON VP.Codigo_producto = PR.Codigo
        INNER JOIN tbl_usuario AS US
        ON VE.Cliente = US.Documento
        INNER JOIN tbl_ciudades AS CI
        ON VE.Ciudad = CI.id_municipio
        INNER JOIN tbl_departamentos as DE
        ON DE.id_departamento = CI.departamento_id
        WHERE VP.Codigo_producto = $idProducto";
    $resultado =  $conexion->query($sql);
    //se crea una variable que es un arreglo vacio
    $ventas = [];
    // evaluamos la variable resultado, para saber si si trajo algo la consulta, si si, empezamos a trabajar
    if($resultado->num_rows != 0 ){
        // creamos un ciclo para que de fila por fila, y si hay una fila la guarda en la variable row fetch_assoc pide linea por linea
        while($row = $resultado->fetch_assoc()){
            //llenamos el arreglo usuarios 
            $ventas[] = $row;
        }
    }
    cerrarConexion();
    return $ventas;
}

function obtenerFotoCliente($codigoVenta, $codVendedor){

    abrirConexion();

    global $conexion;

    $sql = "SELECT US.Foto FROM tbl_usuario AS US INNER JOIN tbl_venta AS VE ON US.Documento = VE.Cliente WHERE VE.Codigo = $codigoVenta AND VE.Cliente <> '$codVendedor'";

    $resultado =  $conexion->query($sql);

    $foto = "";
    // evaluamos la variable resultado, para saber si si trajo algo la consulta, si si, empezamos a trabajar
    if($resultado->num_rows != 0 ){
        // creamos un ciclo para que de fila por fila, y si hay una fila la guarda en la variable row fetch_assoc pide linea por linea
        while($row = $resultado->fetch_assoc()){
            //llenamos el arreglo usuarios 
            $foto = $row;
        }
    }
    cerrarConexion();
    return $foto;

}
?>
