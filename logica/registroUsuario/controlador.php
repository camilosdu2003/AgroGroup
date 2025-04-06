<?php
include('./funciones.php');

session_start();

if (isset($_POST["crearUsuario"])) {
    $errors = [];
    
    $documentoId = $_POST["documentoIdentidad"];
    $nombre = $_POST["nombres"];
    $apellido = $_POST["apellidos"];
    $direccion = $_POST['direccion'];
    $ciudad = $_POST['ciudad'];
    $email = $_POST["correo"]; 
    $telefono = $_POST["celular"]; 
    $contraseña = password_hash($_POST['contraseña'], PASSWORD_DEFAULT);

    // Validar si el documento ya existe
    if (verificarDocumento($documentoId)) {
        $errors[] = "El documento de identidad ya está registrado.";
    }

    // Validar si el correo ya existe
    if (verificarCorreo($email)) {
        $errors[] = "El correo electrónico ya está registrado.";
    }

    // Validar si el número de celular ya existe
    if (verificarTelefono($telefono)) {
        $errors[] = "El número de celular ya está registrado.";
    }

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['form_data'] = $_POST; // Almacena los datos del formulario en la sesión
        header("Location: ../../html/registrarse.php");
        exit();
    }

    echo registrarUsuario($documentoId, $nombre, $apellido, $email, $telefono, $contraseña, $direccion, $ciudad);
}


if (isset($_POST['update'])) {
    $errors = [];

    $documentoId = $_SESSION['id'];
    $nombre = $_POST["nombres"];
    $apellido = $_POST["apellidos"];
    $email = $_POST["correo"]; 
    $telefono = $_POST["numero_celular"]; 
    $direccion = $_POST['direccion'];
    $ciudad = $_POST['ciudad'];

    $usuario = obtenerUnUsuario($_SESSION['id']);

    if($usuario[0]['Email'] != $email){
        // Validar si el correo ya existe (al actualizar, excepto para el mismo usuario)
        if (verificarCorreo($email)) {
        $errors[] = "El correo electrónico ya está registrado.";   
        }

    }

    if($usuario[0]['Telefono'] != $telefono){
         // Validar si el número de celular ya existe (al actualizar, excepto para el mismo usuario)
        if (verificarTelefono($telefono)) {
        $errors[] = "El número de celular ya está registrado.";
        }
    }

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: ../../html/perfil_usuario.php");
        exit();
    }

    echo actualizarUsuario($documentoId, $nombre, $apellido, $email, $telefono, $direccion, $ciudad);
}


if(isset($_FILES["fotoPerfil"])){
    $codUsuario = $_POST['codUsuario'];
    $imagen = $_FILES['fotoPerfil'];
    $nombreFoto = $codUsuario.$imagen['name'];
    echo $nombreFoto;
    $ruta_provisional = $imagen['tmp_name'];
    $tipo = $imagen["type"];
    $tamaño = $imagen["size"];
    $dimensiones = getimagesize($ruta_provisional);
    $width = $dimensiones[0];
    $height = $dimensiones[1];
    $carpeta = "../../img/fotosDePerfil/";

    //validar tipo de archivo
    if ($tipo != 'image/jpg' && $tipo != 'image/JPG' && $tipo != 'image/jpeg' && $tipo != 'image/png' && $tipo != 'image/gif'){
        echo("Error el archivo no es una imagen");

    //Validar que el tamaño del archivo no sea mayor a 3 MB 
    }else if($tamaño > 3*1024 *1024){
    
        echo("Erro el tamaño maximo de la imagen permitido es de 3 MB");
    //guarda la ruta de la imagen en una variable que se usara para almacenar la ruta en la base de datos 
    }else{
        $src =$carpeta.$nombreFoto;
        move_uploaded_file($ruta_provisional, $src);
        $rutaImagen = "img/fotosDePerfil/".$nombreFoto;

        // subir nombre de la imagen a la base de datos
        subirFotoPerfil($codUsuario, $rutaImagen);


    }
}
?>

