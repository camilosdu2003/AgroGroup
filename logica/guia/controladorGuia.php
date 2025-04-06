<?php
include("./funcionesGuia.php");

if(isset($_POST['numeroGuia']) && !empty($_POST['numeroGuia']) && isset($_FILES['fotoGuia']) && $_FILES['fotoGuia']['error'] == 0){
    $numeroGuia= $_POST['numeroGuia'];
    $codigoVenta = $_POST['codigoVenta'];
    $imagen = $_FILES['fotoGuia'];

    $nombreFoto = $numeroGuia . $imagen['name'];
    $ruta_provisional = $imagen['tmp_name'];
    $tipo = $imagen["type"];
    $tamaño = $imagen["size"];
    $dimensiones = getimagesize($ruta_provisional);
    $width = $dimensiones[0];
    $height = $dimensiones[1];
    $carpeta = "../../img/fotosGuias/";

    // Validar tipo de archivo
    if ($tipo != 'image/jpg' && $tipo != 'image/JPG' && $tipo != 'image/jpeg' && $tipo != 'image/png' && $tipo != 'image/gif'){
        echo "Error: el archivo no es una imagen válida.";
    // Validar que el tamaño del archivo no sea mayor a 3 MB 
    } else if($tamaño > 3*1024 *1024){
        echo "Error: el tamaño máximo de la imagen permitido es de 3 MB.";
    // Guardar la ruta de la imagen en una variable que se usará para almacenar la ruta en la base de datos 
    } else {
        $src = $carpeta . $nombreFoto;
        move_uploaded_file($ruta_provisional, $src);
        $rutaImagen = "img/fotosGuias/" . $nombreFoto;

        // Subir nombre de la imagen a la base de datos
        subirFotoGuia($codigoVenta, $rutaImagen);
        subirNumeroGuia($codigoVenta, $numeroGuia);
    }
} else {
    if(empty($_POST['numeroGuia'])) {
        echo "Error: el número de guía no puede estar vacío.";
    } 
    if($_FILES['fotoGuia']['error'] != 0) {
        echo "Error: debe subir una imagen de la guía.";
    }
}

// if(isset($_POST['numeroGuia'])){
//     $numeroGuia= $_POST['numeroGuia'];
//     $codigoVenta = $_POST['codigoVenta'];


//     // echo $numeroGuia . $codigoVenta;
//     $imagen = $_FILES['fotoGuia'];
//     $nombreFoto = $numeroGuia.$imagen['name'];
    
//     $ruta_provisional = $imagen['tmp_name'];
//     $tipo = $imagen["type"];
//     $tamaño = $imagen["size"];
//     $dimensiones = getimagesize($ruta_provisional);
//     $width = $dimensiones[0];
//     $height = $dimensiones[1];
//     $carpeta = "../../img/fotosGuias/";

//     //validar tipo de archivo
//     if ($tipo != 'image/jpg' && $tipo != 'image/JPG' && $tipo != 'image/jpeg' && $tipo != 'image/png' && $tipo != 'image/gif'){
//         echo("Error el archivo no es una imagen");

//     //Validar que el tamaño del archivo no sea mayor a 3 MB 
//     }else if($tamaño > 3*1024 *1024){
    
//         echo("Erro el tamaño maximo de la imagen permitido es de 3 MB");
//     //guarda la ruta de la imagen en una variable que se usara para almacenar la ruta en la base de datos 
//     }else{
//         $src =$carpeta.$nombreFoto;
//         move_uploaded_file($ruta_provisional, $src);
//         $rutaImagen = "img/fotosGuias/".$nombreFoto;

//         // subir nombre de la imagen a la base de datos
//         subirFotoGuia($codigoVenta, $rutaImagen);
//         subirNumeroGuia($codigoVenta, $numeroGuia);
//     }

// }
?>