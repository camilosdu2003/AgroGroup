<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../restablecerContraseña/vendor/autoload.php';
include('.././conexionBd.php');

function enviarCorreoVendedor($vendedor, $cliente, $codProducto, $cantidad, $direccion, $ciudad, $precio){

    $correoVendedor = consultarCorreo($vendedor);
    $datosCliente = consultarUsuario($cliente);
    $nombreProducto = consultarNombreProducto($codProducto);
    $nombreCiudad = consultarCiudad($ciudad);
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
        $mail->addAddress(''.$correoVendedor['Email'].'');     

        //Content
        $mail->isHTML(true); 
        $mail->CharSet = 'UTF-8';                               
        $mail->Subject = 'Notificación de venta en nuestro marketplace';
        $mail->Body    = '
                        <html>
                            <head>
                                <style>
                                    p, h3{
                                        color: black;
                                    }
                                    .email-container {
                                        font-family: Arial, sans-serif;
                                        line-height: 1.6;
                                        color: #333;
                                        padding: 20px;
                                    }
                                    .email-header, .email-footer {
                                        background-color: #f8f8f8;
                                        color: #294C60;
                                        padding: 10px;
                                        text-align: center;
                                    }
                                    .email-body {
                                        padding: 20px;
                                    }
                                    .email-body h2 {
                                        color: #294C60;
                                    }
                                    .email-body p {
                                        margin-bottom: 10px;
                                    }
                                </style>
                            </head>
                            <body>
                                <div class="email-container">
                                    <div class="email-header">
                                        <h1>Has Vendido un Producto en Agrogroup Marketplace</h1>
                                    </div>
                                    <div class="email-body">
                                        <h2>Hola, ' . $correoVendedor['Nombre'] . '</h2>
                                        <p>¡Felicidades! Has vendido un producto. Aquí están los detalles de la venta:</p>
                                        <p><strong>Producto:</strong> ' . $nombreProducto . '</p>
                                        <p><strong>Cantidad:</strong> ' . $cantidad . '</p>
                                        <p><strong>Dirección de entrega:</strong> ' . $direccion . ', ' . $nombreCiudad['municipio'] . ' - ' . $nombreCiudad['departamento'] . '</p>
                                        <p><strong>Precio total:</strong> $' . number_format($precio, 2) . '</p>
                                        <br><br>
                                        <h3><strong>Datos del cliente</strong></h3>
                                        <p><strong>Nombre:</strong> ' . $datosCliente['nombres'] . '</p>
                                        <p><strong>Documento:</strong> ' . $datosCliente['Documento'] . '</p>
                                        <p><strong>Email:</strong> ' . $datosCliente['Email'] . '</p>
                                        <p><strong>Teléfono:</strong> ' . $datosCliente['Telefono'] . '</p>
                                        <p>Por favor, ponte en contacto con el comprador para coordinar la entrega.</p>
                                    </div>
                                    <div class="email-footer">
                                        <p>&copy; 2024 Agrogroup Marketplace. Todos los derechos reservados.</p>
                                    </div>
                                </div>
                            </body>
                        </html>';

                    $mail->AltBody = '
                        Hola, Vendedor
                        
                        ¡Felicidades! Has vendido un producto. Aquí están los detalles de la venta:
                        Producto: ' . $nombreProducto . '
                        Cantidad: ' . $cantidad . '
                        Dirección de entrega: ' . $direccion . ', ' . $nombreCiudad['municipio'] . ' - ' . $nombreCiudad['departamento'] . '
                        Precio total: $' . number_format($precio, 2) . '
                        
                        Datos del cliente:
                        Nombre: ' . $datosCliente['nombres'] . '
                        Documento: ' . $datosCliente['Documento'] . '
                        Email: ' . $datosCliente['Email'] . '
                        Teléfono: ' . $datosCliente['Telefono'] . '
                        
                        Por favor, ponte en contacto con el comprador para coordinar la entrega.
                        
                        © 2024 Agrogroup Marketplace. Todos los derechos reservados.';

        $mail->send(); 

        // echo 'El mensaje se envio con exito';
    } catch (Exception $e) {
        echo "Error Mensaje no enviado: {$mail->ErrorInfo}";
    }
}

function enviarCorreoComprador($vendedor, $cliente, $codProducto, $cantidad, $direccion, $ciudad, $precio){

    $correoComprador = consultarCorreo($cliente);
    $datosVendedor = consultarUsuario($vendedor);
    $nombreProducto = consultarNombreProducto($codProducto);
    $nombreCiudad = consultarCiudad($ciudad);
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
        $mail->addAddress(''.$correoComprador['Email'].'');     

        //Content
        $mail->isHTML(true); 
        $mail->CharSet = 'UTF-8';                               
        $mail->Subject = 'Notificación de venta en nuestro marketplace';
        $mail->Subject = 'Confirmación de compra en nuestro marketplace';
        $mail->Body    = '
                <html>
                    <head>
                        <style>
                            p, h3{
                                    color: black;
                                }
                                .email-container {
                                    font-family: Arial, sans-serif;
                                    line-height: 1.6;
                                    color: #333;
                                    padding: 20px;
                                }
                                .email-header, .email-footer {
                                    background-color: #f8f8f8;
                                    color: #294C60;
                                    padding: 10px;
                                    text-align: center;
                                }
                                .email-body {
                                    padding: 20px;
                                }
                                .email-body h2 {
                                    color: #294C60;
                                }
                                .email-body p {
                                    margin-bottom: 10px;
                                }
                        </style>
                    </head>
                    <body>
                        <div class="email-container">
                            <div class="email-header">
                                <h1>Confirmación de tu compra en Agrogroup Marketplace</h1>
                            </div>
                            <div class="email-body">
                                <h2>Hola, ' . $correoComprador['Nombre'] . '</h2>
                                <p>Gracias por tu compra. Aquí están los detalles de tu pedido:</p>
                                <p><strong>Producto:</strong> ' . $nombreProducto . '</p>
                                <p><strong>Cantidad:</strong> ' . $cantidad . '</p>
                                <p><strong>Dirección de entrega:</strong> ' . $direccion . ', ' . $nombreCiudad['municipio'] . ' - ' . $nombreCiudad['departamento'] . '</p>
                                <p><strong>Precio total:</strong> $' . number_format($precio, 2) . '</p>
                                 <br><br>
                                <h3><strong>Datos del vendedor</strong></h3>
                                <p><strong>Nombre:</strong> ' . $datosVendedor['nombres'] . '</p>
                                <p><strong>Documento:</strong> ' . $datosVendedor['Documento'] . '</p>
                                <p><strong>Email:</strong> ' . $datosVendedor['Email'] . '</p>
                                <p><strong>Teléfono:</strong> ' . $datosVendedor['Telefono'] . '</p>
                                <p>Estamos procesando tu pedido y pronto nos pondremos en contacto contigo para coordinar la entrega.</p>
                            </div>
                            <div class="email-footer">
                                <p>&copy; 2024 Agrogroup Marketplace. Todos los derechos reservados.</p>
                            </div>
                        </div>
                    </body>
                </html>';
        $mail->AltBody = '
                Hola, ' . $nombres . '

                Gracias por tu compra. Aquí están los detalles de tu pedido:
                Producto: ' . $nombreProducto . '
                Cantidad: ' . $cantidad . '
                Dirección de entrega: ' . $direccion . ', ' . $nombreCiudad['municipio'] . ' - ' . $nombreCiudad['departamento'] . '
                Precio total: $' . number_format($precio, 2) . '

                Datos del vendedor:
                Nombre: ' . $datosVendedor['nombres'] . '
                Documento: ' . $datosVendedor['Documento'] . '
                Email: ' . $datosVendedor['Email'] . '
                Teléfono: ' . $datosVendedor['Telefono'] . '

                Estamos procesando tu pedido y pronto nos pondremos en contacto contigo para coordinar la entrega.

                © 2024 Agrogroup Marketplace. Todos los derechos reservados.';

        $mail->send(); 

        // echo 'El mensaje se envio con exito';
    } catch (Exception $e) {
        echo "Error Mensaje no enviado: {$mail->ErrorInfo}";
    }
}

function  enviarCorreoExistenciaAgotada($email,$nombreVendedor, $codProducto){
    $nombreProducto = consultarNombreProducto($codProducto);
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
        $mail->Subject = "Notificación: Se han vendido todas las existencias de tu producto ".$nombreProducto." en Agrogroup";
        $mail->Body    = "<!DOCTYPE html>
        <html lang='es'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f4f4f4;
                    margin: 0;
                    padding: 0;
                }
                .container {
                    width: 80%;
                    margin: auto;
                    background-color: #ffffff;
                    padding: 20px;
                    border-radius: 10px;
                    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.4);
                }
                .header {
                    background-color: #294C60;
                    color: #ffffff;
                    padding: 10px 0;
                    text-align: center;
                    border-radius: 10px 10px 0 0;
                }
                .content {
                    margin: 20px 0;
                }
                .footer {
                    margin-top: 20px;
                    font-size: 0.9em;
                    text-align: center;
                    color: #777777;
                }
                a {
                    color: #007BFF;
                    text-decoration: none;
                }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h1>Agrogroup</h1>
                </div>
                <div class='content'>
                    <p>Estimado/a ".$nombreVendedor." ,</p>
                    <p>Nos complace informarte que se han vendido todas las existencias de tu producto <strong>".$nombreProducto."</strong> en nuestra plataforma, Agrogroup.</p>
                    <p>Te recomendamos actualizar las unidades disponibles para seguir ofreciendo este producto a nuestros clientes. Puedes hacerlo accediendo a la pestaña <strong>Mis productos</strong> y haciendo clic en el botón <strong>Editar</strong> junto al producto correspondiente.</p>
                    <p>Si tienes alguna pregunta o necesitas asistencia adicional, no dudes en ponerte en contacto con nuestro equipo de soporte.</p>
                    <p>Gracias por confiar en Agrogroup para tus ventas.</p>
                    <p>Atentamente,<br>El equipo de Agrogroup</p>
                </div>
                <div class='footer'>
                    <p>&copy; 2024 Agrogroup. Todos los derechos reservados.</p>
                </div>
            </div>
        </body>
        </html>";
        $mail->AltBody = "Estimado/a ".$nombreVendedor." ,\n\nNos complace informarte que se han vendido todas las existencias de tu producto ".$nombreProducto." en nuestra plataforma, Agrogroup.\n\nTe recomendamos actualizar las unidades disponibles para seguir ofreciendo este producto a nuestros clientes. Puedes hacerlo accediendo a la pestaña Mis productos y haciendo clic en el botón Editar junto al producto correspondiente.\n\nSi tienes alguna pregunta o necesitas asistencia adicional, no dudes en ponerte en contacto con nuestro equipo de soporte.\n\nGracias por confiar en Agrogroup para tus ventas.\n\nAtentamente,\nEl equipo de Agrogroup";


        $mail->send(); 

        // echo 'El mensaje se envio con exito';
    } catch (Exception $e) {
        echo "Error Mensaje no enviado: {$mail->ErrorInfo}";
    }
 
}

function consultarCorreo($vendedor){

    abrirConexion();

    global $conexion;
    $sql = "SELECT Email, Nombre FROM tbl_usuario  WHERE Documento = '$vendedor'";
    $resultado =  $conexion->query($sql);
    // arreglo para almecenar el usuario
    $correoVendedor = [];
    $row = $resultado->fetch_assoc();
    if($row){
        $correoVendedor = $row;
    }

    cerrarConexion();
    return $correoVendedor;

}

function consultarUsuario($cliente){
    abrirConexion();

    global $conexion;
    $sql = "SELECT CONCAT(Nombre,(' '),Apellido) AS 'nombres', Email, Telefono, Documento FROM tbl_usuario WHERE Documento = '$cliente'";
    $resultado =  $conexion->query($sql);
    // arreglo para almecenar el usuario
    $datosUsuario = [];
    $row = $resultado->fetch_assoc();
    if($row){
        $datosUsuario = $row;
    }

    cerrarConexion();
    return $datosUsuario;
}

function consultarNombreProducto($codProducto){
    abrirConexion();

    global $conexion;
    $sql = "SELECT Nombre FROM tbl_productos  WHERE Codigo = '$codProducto'";
    $resultado =  $conexion->query($sql);
    // arreglo para almecenar el usuario
    $nombreProducto = "";
    $row = $resultado->fetch_assoc();
    if($row){
        $nombreProducto = $row['Nombre'];
    }

    cerrarConexion();
    return $nombreProducto;
}

function consultarCiudad($ciudad){
    abrirConexion();

    global $conexion;
    $sql = "SELECT CI.municipio, DE.departamento FROM tbl_ciudades AS CI INNER JOIN tbl_departamentos AS DE ON DE.id_departamento = CI.departamento_id WHERE CI.id_municipio = '$ciudad'";
    $resultado =  $conexion->query($sql);
    // arreglo para almecenar el usuario
    $nombreCiudad = [];
    $row = $resultado->fetch_assoc();
    if($row){
        $nombreCiudad = $row;
    }

    cerrarConexion();
    return $nombreCiudad;
}


// ingresar venta
function  ingresarVenta($vendedor, $cliente, $formaPago, $direccion, $ciudad, $cantidad, $precio, $codProducto){
    
    abrirConexion();

    global $conexion;
    $sql = "INSERT INTO tbl_venta (Vendedor, Cliente, Empresa_Transportadora, Forma_Pago, Direccion, Ciudad, Imagen_Guia, Fecha_Venta) VALUES ('$vendedor', '$cliente', NULL, $formaPago, '$direccion', '$ciudad', NULL, CURDATE())"; // insertamos los datos en la base de datos

     // con la variable conexion hacemos la query, esta query devuelve true o false y usamos esto para verificar que si se ejecuto la query exitosamente
    if($conexion->query($sql)===true){  
        cerrarConexion();
        enviarCorreoVendedor($vendedor, $cliente, $codProducto, $cantidad, $direccion, $ciudad, $precio );
        enviarCorreoComprador($vendedor, $cliente, $codProducto, $cantidad, $direccion, $ciudad, $precio);
        session_start();
        $_SESSION['msjAlerta'] ="!Felicidades producto comprado!";
        header("Location: ../../html/mis_pedidos.php");
    }else{
        cerrarConexion();
        return "error al crear producto" . $conexion->error;
    }
}

// consultar venta
function consultarVenta($vendedor, $cliente){

    abrirConexion();

    global $conexion;
    $sql = "SELECT * FROM tbl_venta  WHERE Vendedor = '$vendedor' AND Cliente = '$cliente' ORDER BY Codigo DESC limit 1";
    $resultado =  $conexion->query($sql);
    // arreglo para almecenar el usuario
    $venta = [];
    $row = $resultado->fetch_assoc();
    if($row){
        $venta[] = $row;
    }

    cerrarConexion();
    return $venta;
}

// ingresar venta producto
function ingresarVentaProducto($codProducto, $codVenta, $precio, $cantidad){

    
    abrirConexion();

    global $conexion;
    $sql = "INSERT INTO tbl_venta_producto (Codigo_producto, Codigo_venta, Precio, Cantidad) VALUES ($codProducto, $codVenta, $precio, $cantidad)"; // insertamos los datos en la base de datos

     // con la variable conexion hacemos la query, esta query devuelve true o false y usamos esto para verificar que si se ejecuto la query exitosamente
    if($conexion->query($sql)===true){  
        cerrarConexion();
        return "venta producto creada correctamente ";
    }else{
        cerrarConexion();
        return "error al crear venta producto" . $conexion->error;
    }
}

//Funcion para restar la cantidad disponible de cada producto al hacer una compra
function restarCantidadDisponible($cantidad, $cantidadDisponible, $codProducto){

    abrirConexion();

    global $conexion;

    $cantidadActualizada = ($cantidadDisponible - $cantidad);


    $sql = "UPDATE tbl_productos SET Unidades_Disponibles = $cantidadActualizada  WHERE Codigo = $codProducto";

    if ($conexion->query($sql) === TRUE){

        cerrarConexion();
        return "Cantidad actualizada correctamente";

    } else {
        return "Error al actualizar cantidad" . $conexion->error;
        cerrarConexion();
    }

};

function obtenerCantidadProducto($codProducto){
    abrirConexion();

    global $conexion;
    $sql = "SELECT Unidades_Disponibles FROM tbl_productos  WHERE Codigo = '$codProducto'";
    $resultado =  $conexion->query($sql);
    // arreglo para almecenar el usuario
    $cantidad = "";
    $row = $resultado->fetch_assoc();
    if($row){
        $cantidad = $row['Nombre'];
    }

    cerrarConexion();
    return $cantidad;
}

//Funcion para obtener el codigo del carrito para poder borrar los productos del carrito al realizar la compra
function obtenerCodigoCarrito($codUsuario){
    abrirConexion();

    global $conexion;
   
    $sql = "SELECT CP.Codigo_Carrito FROM tbl_carrito_productos as CP 
        inner join tbl_carrito as CA 
        on CP.Codigo_Carrito = CA.Codigo
        inner join tbl_usuario as US on CA.Usuario = US.Documento where US.Documento = '$codUsuario' 
        limit 1;";
    $resultado =  $conexion->query($sql);
    // arreglo para almecenar el usuario
    $codCarrito = null;
    $row = $resultado->fetch_assoc();
    if($row){
        $codCarrito = $row['Codigo_Carrito'];
    }

    cerrarConexion();
    return $codCarrito;
}

function borrarProductosCarrito($codUsuario){
    global $conexion;

    $codCarrito = obtenerCodigoCarrito($codUsuario);

    abrirConexion();

    $sql = "DELETE FROM tbl_carrito_productos WHERE Codigo_Carrito = $codCarrito";
    if ($conexion -> query($sql)=== true){
        cerrarConexion();
    }else{
        cerrarConexion();
        return "error al eliminar producto" . $conexion->error;
    }
}

?>