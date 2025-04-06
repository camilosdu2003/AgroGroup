<?php
include('../conexionBd.php');

function registrarUsuario($documentoId, $nombre, $apellido, $email, $telefono, $contraseña,$direccion, $ciudad){


    abrirConexion();
    global $conexion;

    $sql = "INSERT INTO tbl_usuario (Documento, Nombre, Apellido, Email, Telefono, Contrasenia, Direccion_de_Residencia, Ciudad ) VALUES ('$documentoId', '$nombre','$apellido', '$email', '$telefono', '$contraseña', '$direccion', $ciudad )";

    if($conexion->query($sql)== true){

        cerrarConexion();

        session_start();
        $_SESSION['msjAlerta'] ="Usuario creado correctamente";

        header("Location: ../../html/iniciar_sesion.php");
        crearCarritoUsuario($documentoId);
        exit();
    }else{

        cerrarConexion();
        session_start();
        $_SESSION['msjAlerta'] ="Error al crear usuario, verifique los datos e intente nuevamente";

        header("Location: ../../html/registrarse.php");
         
    }
 
}

function actualizarUsuario($documentoId,$nombre,$apellido,$email,$telefono, $direccion, $ciudad){
    abrirConexion();
    global $conexion;

    $sql = "UPDATE tbl_usuario SET Nombre='$nombre',Apellido='$apellido',Email='$email',Telefono='$telefono', Direccion_de_Residencia='$direccion',Ciudad=$ciudad where Documento='$documentoId'";

    if ($conexion->query($sql) === TRUE){

        cerrarConexion();

        session_start();
        $_SESSION['msjAlerta'] ="Datos actualizados";

        header("Location: ../../html/perfil_usuario.php");
        exit();
    } else {
        return "Error al actualizar usuario" . $conexion->error;
        cerrarConexion();
    }

}

function crearCarritoUsuario($documentoId){
    abrirConexion();
    global $conexion;

    $sql = "INSERT INTO tbl_carrito (Usuario) VALUES ('$documentoId')";

    if($conexion->query($sql)== true){

        cerrarConexion();
        return "Carrito creado correctamente";
    }else{

        cerrarConexion();
        return "Error al crear Carrito" . $conexion->error; 
    }

}

function verificarDocumento($documentoId) {
    global $conexion;
    abrirConexion();

    $sql = "SELECT COUNT(*) as count FROM tbl_usuario WHERE Documento = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $documentoId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    cerrarConexion();
    return $row['count'] > 0;
}

function verificarCorreo($email) {
    global $conexion;
    abrirConexion();

    $sql = "SELECT COUNT(*) as count FROM tbl_usuario WHERE Email = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    cerrarConexion();
    return $row['count'] > 0;
}

function verificarTelefono($telefono) {
    global $conexion;
    abrirConexion();

    $sql = "SELECT COUNT(*) as count FROM tbl_usuario WHERE Telefono = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $telefono);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    cerrarConexion();
    return $row['count'] > 0;
}

function obtenerUnUsuario($id){
    
    abrirConexion();

    global $conexion;
    $sql = "SELECT * FROM tbl_usuario WHERE documento = $id";
    $resultado =  $conexion->query($sql);
    // arreglo para almecenar el usuario
    $usuario = [];
    $row = $resultado->fetch_assoc();
    if($row){
        $usuario[] = $row;
    }

    cerrarConexion();
    return $usuario;
}

// Actualizar fotos del producto
function subirFotoPerfil($codUsuario, $rutaImagen){
    abrirConexion();

    global $conexion;

    $sql = "UPDATE tbl_usuario SET Foto = '$rutaImagen' WHERE Documento =  $codUsuario";

    if ($conexion->query($sql) === TRUE){

        cerrarConexion();
        header("Location: ../../html/perfil_usuario.php");
        exit();
    } else {
        return "Error al actualizar usuario" . $conexion->error;
        cerrarConexion();
    }

}



?>