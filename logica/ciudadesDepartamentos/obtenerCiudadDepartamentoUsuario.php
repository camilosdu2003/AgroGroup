<?php

//obtener la ciudad y departamento de un usuario
function obtenerCiudadDepartamento($ciudad){
    abrirConexion();

    global $conexion;
    $sql = "SELECT Ci.municipio AS 'ciudad', DE.id_departamento as 'idDepartamento', DE.departamento as 'departamento'
    FROM tbl_ciudades AS CI INNER JOIN tbl_departamentos AS DE
    ON ci.departamento_id = de.id_departamento
    INNER JOIN tbl_usuario AS US
    ON us.Ciudad = ci.id_municipio
    WHERE  us.Ciudad = $ciudad";

    $resultado =  $conexion->query($sql);
    // arreglo para almecenar el usuario
    $ciudadDepartamento = [];
    $row = $resultado->fetch_assoc();
    if($row){
        $ciudadDepartamento[] = $row;
    }

    cerrarConexion();
    return $ciudadDepartamento;
}

?>