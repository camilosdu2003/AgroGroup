<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

include ("../conexionBd.php");

function obtenerUsuarios(){

    global $conexion;
    abrirConexion();
    $sql = "SELECT * FROM tbl_usuario";
    $resultado =  $conexion->query($sql);
    //se crea una variable que es un arreglo vacio
    $usuarios = [];
    // evaluamos la variable resultado, para saber si si trajo algo la consulta, si si, empezamos a trabajar
    if($resultado->num_rows != 0 ){
        // creamos un ciclo para que de fila por fila, y si hay una fila la guarda en la variable row fetch_assoc pide linea por linea
        while($row = $resultado->fetch_assoc()){
            //llenamos el arreglo usuarios 
            $usuarios[] = $row;
        }
    }
    cerrarConexion();
    return $usuarios;
}

function verificarExistenciaEmail($email){

    $usuarios = obtenerUsuarios();
   
    foreach($usuarios as $usuario){
        if($usuario['Email'] == $email){
            return  "si";
            exit();
        }
    }

    session_start();
    $_SESSION['msjAlerta'] = "El correo ingresado no esta registrado";
    return "no";

}

function verificarExistenciaRecuperarContraseña($email){
    global $conexion;
    abrirConexion();
    $sql = "SELECT * FROM tbl_recuperar_contraseña WHERE email = '$email'";
    $resultado =  $conexion->query($sql);
    // arreglo para almecenar el codigp
    $codigo = [];
    $row = $resultado->fetch_assoc();
    if($row){
        $codigo[] = $row;
    }
    
    cerrarConexion();
    return $codigo; 
}

function  ingresarCodigoVerificacionBD($codigoVerificacion, $email){
   
    global $conexion;
    abrirConexion();
 
    $sql = "INSERT INTO tbl_recuperar_contraseña (email, codigo) VALUES ('$email', '$codigoVerificacion')"; // insertamos los datos en la base de datos

     // con la variable conexion hacemos la query, esta query devuelve true o false y usamos esto para verificar que si se ejecuto la query exitosamente
    if($conexion->query($sql)===true){  
        cerrarConexion();

        session_start();
        $_SESSION['emailVerificacion'] = $email;

        // return "codigo ingresado correctamente" ;       
    }else{
        cerrarConexion();
        return "error al ingresar codigo" . $conexion->error;
    }
}

function  enviarCodigoEmail($codnum1, $codnum2, $email){
    
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;                      
        $mail->isSMTP();                                            
        $mail->Host       = 'smtp.gmail.com';                     
        $mail->SMTPAuth   = true;                                   
        $mail->Username   = 'agrogrupmp@gmail.com';                    
        $mail->Password   = 'j w j u q w u q e e c p e h g p';                               
        $mail->SMTPSecure = 'tls';           
        $mail->Port       = 587;                                 

        //Recipients
        $mail->setFrom('agrogrupmp@gmail.com', 'Equipo Agrogroup');
        $mail->addAddress(''.$email.'');     

        //Content
        $mail->isHTML(true); 
        $mail->CharSet = 'UTF-8';                               
        $mail->Subject = 'Restablecimiento de Contraseña - Código de Verificación';
        $mail->Body    = '
        <html>
        <head>
            <style>
                .container {
                    font-family: Arial, sans-serif;
                    max-width: 600px;
                    margin: 0 auto;
                    padding: 20px;
                    border: 1px solid #ddd;
                    border-radius: 5px;
                    background-color: #f9f9f9;
                }
                .header {
                    text-align: center;
                    padding-bottom: 20px;
                }
                .content {
                    padding: 20px;
                    line-height: 1.6;
                }
                .code {
                    display: block;
                    font-size: 24px;
                    font-weight: bold;
                    text-align: center;
                    margin: 20px 0;
                }
                .footer {
                    text-align: center;
                    padding-top: 20px;
                    font-size: 12px;
                    color: #777;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <div class="header">
                    <h2>Restablecimiento de Contraseña</h2>
                </div>
                <div class="content">
                    <p>Hola,</p>
                    <p>Hemos recibido una solicitud para restablecer la contraseña de tu cuenta de Agrogroup. Utiliza el siguiente código de verificación para completar el proceso:</p>
                    <span class="code">'.$codnum1.' - '.$codnum2.'</span>
                    <p>Si no solicitaste restablecer tu contraseña, por favor ignora este correo.</p>
                    <p>Gracias,</p>
                    <p>El equipo de Agrogroup</p>
                </div>
                <div class="footer">
                    <p>Este mensaje es generado automáticamente, por favor no responder.</p>
                </div>
            </div>
        </body>
        </html>
        ';
        $mail->AltBody = 'Hola,\n\nHemos recibido una solicitud para restablecer la contraseña de tu cuenta de Agrogroup. Utiliza el siguiente código de verificación para completar el proceso: '.$codnum1.' - '.$codnum2.'\n\nSi no solicitaste restablecer tu contraseña, por favor ignora este correo.\n\nGracias,\nEl equipo de Agrogroup\n\nEste mensaje es generado automáticamente, por favor no responder.';


        $mail->send();
        session_start();
        $_SESSION['msjAlerta'] ="Codigo de verificacion enviado al correo";

        header("Location: ../../html/recuperar_contraseña_2.php");
        exit();

        // echo 'El mensaje se envio con exito';
    } catch (Exception $e) {
        echo "Error Mensaje no enviado: {$mail->ErrorInfo}";
    }
}

function validarCodigo($codigoIngresado, $email){
    global $conexion;
    abrirConexion();
    $sql = "SELECT * FROM tbl_recuperar_contraseña WHERE email = '$email' AND codigo = '$codigoIngresado'";
    $resultado =  $conexion->query($sql);
    // arreglo para almecenar el codigp
    $codigo = [];
    $row = $resultado->fetch_assoc();
    if($row){
        $codigo[] = $row;
    }
    
    cerrarConexion();
    return $codigo; 
}

function restablecerContraseña($email, $contraseña){
    abrirConexion();
    global $conexion;

    $sql = "UPDATE tbl_usuario SET Contrasenia='$contraseña' where Email='$email'";

    if ($conexion->query($sql) === TRUE){

        cerrarConexion();

        session_destroy();

        session_start();
        $_SESSION['msjAlerta'] ="Contraseña restablecida";

        header("Location: ../../html/iniciar_sesion.php");
        exit();
    } else {
        return "Error al restablecer contraseña" . $conexion->error;
        cerrarConexion();
    }
}

function eliminarRecuperarContraseña($email){
    global $conexion;
    abrirConexion();

    $sql = "DELETE FROM tbl_recuperar_contraseña WHERE email = '$email'";
    if ($conexion -> query($sql)=== true){
        cerrarConexion();
    }else{
        cerrarConexion();
        return "error al eliminar recuperar contraseña" . $conexion->error;
    }
}


?>
