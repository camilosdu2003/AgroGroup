<?php

$conexion;

function abrirConexionCarrito(){
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

function cerrarConexionCarrito(){
    global $conexion;

    $conexion->close();
}

?>
<!-- Este archivo se duplicó en esta carpeta ya que no dejaba tomar el archivo raiz, se modifico el nombre a la funcion 
abrir y a cerrar conexion ya que entraba en conflicto con otro archivo -->