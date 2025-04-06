<?php

include('../logica/./conexionBd.php');

//obtener un usuario
function obtenerUnUsuario($id){
    
    abrirConexion();

    global $conexion;
    $sql = "SELECT * FROM tbl_usuario WHERE documento = $id";
    $resultado =  $conexion->query($sql);
    // arreglo para almecenar el usuario
    $usuario = [];
    $row = $resultado->fetch_assoc();
    if($row){
        $usuario[] = $row;
    }

    cerrarConexion();
    return $usuario;
}



?>