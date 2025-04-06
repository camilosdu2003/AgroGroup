<?php
include('conexionBd.php');

function subirFotoGuia($codigoVenta, $rutaImagen){
    abrirConexion();

    global $conexion;

    $sql = "UPDATE tbl_venta SET Imagen_Guia = '$rutaImagen' WHERE Codigo =  $codigoVenta";

    if ($conexion->query($sql) === TRUE){

        cerrarConexion();
    } else {
        return "Error al actualizar usuario" . $conexion->error;
        cerrarConexion();
    }
}


function subirNumeroGuia($codigoVenta, $numeroGuia){
    abrirConexion();
    global $conexion;

    $sql = "UPDATE tbl_venta SET numero_guia='$numeroGuia' where Codigo='$codigoVenta'";

    if ($conexion->query($sql) === TRUE){

        cerrarConexion();

        session_start();
        $_SESSION['msjAlerta'] ="Guia subida correctamente";

        header("Location: ../../html/numero_guia.php?codigoVenta=$codigoVenta");
        exit();
    } else {
        return "Error al actualizar usuario" . $conexion->error;
        cerrarConexion();
    }

}

function validarVendedorCliente($idUsuario, $codigoVenta){
    abrirConexion();
    global $conexion;


    $sql = "SELECT * FROM tbl_venta WHERE Codigo = $codigoVenta";
    $resultado = $conexion->query($sql);

    $venta = [];
    if ($row = $resultado->fetch_assoc()) {
        $venta[] = $row;
    }

    cerrarConexion();
    return $venta;

}
?>