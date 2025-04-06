<?php   
include("./funcionesRestablecerContraseña.php");

//verificar si si existe el email crear codigo de verifcacion y enviar correo con codigo
if(isset($_POST['email'])){
    $email = $_POST['email'];

    $existEmail = verificarExistenciaEmail($email);

    if($existEmail =="no"){
        header("Location:  ../../html/recuperar_contraseña_1.php ");
    }else{
        if($existEmail =="si"){
           
            // crear numero aleatoreo
            $num1 = mt_rand(100, 999);
            $num2 = mt_rand(100, 999); 

            //convertir numero a caracter
            $codnum1 = strval($num1);
            $codnum2 = strval($num2);

            //crear codigo
            $codigoVerificacion = $codnum1 . $codnum2;

            //guardar codigo en base de datos
            $verificarRecuperarContraseña = verificarExistenciaRecuperarContraseña($email);
            if (empty($verificarRecuperarContraseña)) {
                ingresarCodigoVerificacionBD($codigoVerificacion, $email);
            }else{
                eliminarRecuperarContraseña($email);
                ingresarCodigoVerificacionBD($codigoVerificacion, $email);
            }
            
            //enviar correo con el codigo
            enviarCodigoEmail($codnum1, $codnum2, $email);
        }
    }
}

//validar si el codigo ingresado es el mismo que se envio al email
if(isset($_POST['validarCodigo'])){
    $codigoIngresado = $_POST['codigo'];
    $email = $_POST['ingresarEmail'];

    //se consulta el codigo que esta almacenado en la base de datos
    $codigo = validarCodigo($codigoIngresado, $email);

    //si coincide se manda a restablecer contraseña
    if (!empty($codigo)) {

        session_start();
        $_SESSION['email'] = $email;

        eliminarRecuperarContraseña($email);
        header("Location: ../../html/recuperar_contraseña_3.php");
        //si no existe muestra el error de codigo erroneo
    } else {

        session_start();
        $_SESSION['msjAlerta'] = "Código de verificación erróneo";
        header("Location: ../../html/recuperar_contraseña_2.php"); 
        exit();
    }

}

if(isset($_POST['restablecerContraseña'])){
    $contraseña = $_POST['nuevaContraseña'];
    $confirmarContraseña = $_POST['confirmarContraseña'];
    $email = $_POST['restablecerEmail'];

    if($contraseña == $confirmarContraseña){
        $contraseña = password_hash($_POST['nuevaContraseña'], PASSWORD_DEFAULT);
        $confirmarContraseña = password_hash($_POST['confirmarContraseña'], PASSWORD_DEFAULT);

        restablecerContraseña($email, $contraseña);



    }else{
        session_start();
        header("Location: ../../html/recuperar_contraseña_3.php");
        $_SESSION['errors'] = "Las contraseñas no coinciden";
    }
    
}

?>