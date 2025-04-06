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

// obtener departamentos

abrirConexion();

global $conexion;

$sql = "SELECT * FROM tbl_ciudades ";
$ejecutarConsulta =  mysqli_query($conexion, $sql);

echo '  <label  class="label-city" for="ciudad">Ciudad:</label>';
echo '<select class="selector-city" id="ciudad-select" name="ciudad" required>';
        while($fila = mysqli_fetch_array($ejecutarConsulta)){
            if($fila['departamento_id'] == $_GET['c']){
                echo "<option value ='".$fila["id_municipio"]."'>".$fila['municipio']."</option>";

            }
        }
echo '</select>';




cerrarConexion();




?>