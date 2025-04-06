<?php

include('./funciones.php');

if(isset($_POST['agregarProducto'])){
    $nombreProducto = $_POST["name"];
    $descripcion = $_POST["descripcion"];
    $categoria = $_POST["categoria"];
    $unidadesDisponibles = $_POST["unidades"]; 
    $precio = str_replace(',', '', $_POST["precio"]);
    $id = $_POST['id'];

    agregarProducto($nombreProducto, $descripcion, $unidadesDisponibles, $precio, $categoria, $id);
    $producto = consultarCodProducto($nombreProducto, $id)[0];
    $codigoProducto = $producto['Codigo'];

    // $imagen = "";
    if(isset($_FILES['fotos'])) {
        $files = array_filter($_FILES['fotos']['name']);

        foreach($files as $key => $value) {
            $file = [
                'name' => $_FILES['fotos']['name'][$key],
                'type' => $_FILES['fotos']['type'][$key],
                'tmp_name' => $_FILES['fotos']['tmp_name'][$key],
                'size' => $_FILES['fotos']['size'][$key]
            ];

            $nombreFoto = $file["name"];
            $tipo = $file["type"];
            $ruta_provisional = $file["tmp_name"];
            $size = $file["size"];
            $dimensiones = getimagesize($ruta_provisional);
            $width = $dimensiones[0];
            $height = $dimensiones[1];
            $carpeta = "../../img/";

            //validar tipo de archivo
            if ($tipo != 'image/jpg' && $tipo != 'image/JPG' && $tipo != 'image/jpeg' && $tipo != 'image/png' && $tipo != 'image/gif'){
                echo("Error el archivo no es una imagen");

            //Validar que el tamaño del archivo no sea mayor a 3 MB 
            }else if($size > 3*1024 *1024){
            
                echo("Erro el tamaño maximo de la imagen permitido es de 3 MB");
            //guarda la ruta de la imagen en una variable que se usara para almacenar la ruta en la base de datos 
            }else{
                $src =$carpeta.$nombreFoto;
                move_uploaded_file($ruta_provisional, $src);
                $imagen = "img/".$nombreFoto;

                agregarFotoProducto($nombreFoto, $imagen);

                $foto = consultarCodFoto($imagen)[0];
                $codigoFoto = $foto['Codigo_Imagen'];
    
                agregarRelacionFotoProducto($codigoProducto, $codigoFoto);
            }
        }
    }
 
}


if(isset($_POST['cancelar'])){
    header("Location: ../../html/mis_productos.php");
}

//Actualizar Producto
if(isset($_POST['actualizar'])){
    $nombreProducto = $_POST["name"];
    $descripcion = $_POST["descripcion"];
    $categoria = $_POST["categoria"];
    $unidadesDisponibles = $_POST["unidades"]; 
    $precio = $_POST["precio"];
    $id = $_POST['id']; 
    $codProducto = $_POST['codProducto'];


    actualizarProducto($nombreProducto, $descripcion, $unidadesDisponibles, $precio, $categoria, $id, $codProducto);

    // $imagen = "";
    if(isset($_FILES['fotos'])) {
        $files = array_filter($_FILES['fotos']['name']);

        foreach($files as $key => $value) {
            $file = [
                'name' => $_FILES['fotos']['name'][$key],
                'type' => $_FILES['fotos']['type'][$key],
                'tmp_name' => $_FILES['fotos']['tmp_name'][$key],
                'size' => $_FILES['fotos']['size'][$key]
            ];

            $nombreFoto = $file["name"];
            $tipo = $file["type"];
            $ruta_provisional = $file["tmp_name"];
            $size = $file["size"];
            $dimensiones = getimagesize($ruta_provisional);
            $width = $dimensiones[0];
            $height = $dimensiones[1];
            $carpeta = "../../img/";

            //validar tipo de archivo
            if ($tipo != 'image/jpg' && $tipo != 'image/JPG' && $tipo != 'image/jpeg' && $tipo != 'image/png' && $tipo != 'image/gif'){
                echo("Error el archivo no es una imagen");

            //Validar que el tamaño del archivo no sea mayor a 3 MB 
            }else if($size > 3*1024 *1024){
            
                echo("Erro el tamaño maximo de la imagen permitido es de 3 MB");
            //guarda la ruta de la imagen en una variable que se usara para almacenar la ruta en la base de datos 
            }else{
                $src =$carpeta.$nombreFoto;
                move_uploaded_file($ruta_provisional, $src);
                $imagen = "img/".$nombreFoto;


                $foto = consultarCodFoto($imagen)[0];
                $codigoFoto = $foto['Codigo_Imagen'];
                actualizarFotoProducto($nombreFoto, $imagen, $codigoFoto);

            }
        }
    }

}

?>