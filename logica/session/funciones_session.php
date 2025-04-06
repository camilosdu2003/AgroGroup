<?php
include('.././conexionBd.php');


// Login
function validateLogin($email, $password){    
    abrirConexion();

    global $conexion;

    session_start();
    $consulta = "SELECT documento, contrasenia, nombre, email FROM tbl_usuario WHERE email='$email'";
    $resultado = mysqli_query($conexion, $consulta);
    $fila = mysqli_fetch_assoc($resultado);

    if ($fila && password_verify($password, $fila["contrasenia"])) {
        $_SESSION['id'] = $fila['documento'];
        $_SESSION['nombre'] = $fila['nombre'];
    
        cerrarConexion();
        header('Location: ../../html/index.php');

        exit();
    } else {
        cerrarConexion();
        session_start();
        $_SESSION['errorSesion'] ="Correo o contraseña incorrectos. Por favor, inténtalo de nuevo.";
        header("Location: ../../html/iniciar_sesion.php");
    }

    mysqli_close($conexion);
}

//Cerrar sesion
function logout(){

    session_start();
    session_unset();
    session_destroy();
    header("Location: ../../html/index.php");
    exit;
}



?>