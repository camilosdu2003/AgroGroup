<?php

$conexion;

function abrirConexionBuscador(){
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

function cerrarConexionBuscador(){
    global $conexion;

    $conexion->close();
}
?>