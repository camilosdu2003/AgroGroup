<?php
include('funcionesBuscador.php');

function definirOrdenConsulta($busqueda, $ordenar){

    if($ordenar == "mayorMenor"){
        $ordenar = "ORDER BY Precio_Venta ASC";
    }else{
        if($ordenar == "menorMayor"){
            $ordenar = "ORDER BY Precio_Venta DESC";
        }else{
            $ordenar= "";
        }
    }

     return buscarProductos($busqueda, $ordenar);

}


?>