<?php

if(!isset($conexion)){
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
}


// obtener departamentos
global $conexion;

abrirConexion();



$sql = "SELECT * FROM tbl_departamentos";
$ejecutarConsulta =  mysqli_query($conexion, $sql);


while($fila = mysqli_fetch_array($ejecutarConsulta)){
    echo "<option value='".$fila['id_departamento']."'>".$fila['departamento']."</option>";
}

cerrarConexion();




?>