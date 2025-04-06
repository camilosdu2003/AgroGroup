<?php

$conexion;

function abrirConexion(){
    global $conexion;
    $dbHost = "localhost";
    $dbNombre ="agrogroup";
    $dbUsuario = "root";
    $dbContraseña = "";
    
    $conexion = new mysqli($dbHost, $dbUsuario, $dbContraseña, $dbNombre);

    if($conexion->connect_error){
        die("error de conexion: " . $conexion->connect_error);
    }
}

function cerrarConexion(){
    global $conexion;

    $conexion->close();
}
?>