<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos de pago</title>
    <link rel="stylesheet" href="../css/estilos_header.css">
    <link rel="stylesheet" href="../css/estilos_footer.css">
    <link rel="stylesheet" href="../css/estilos_datos_pago_paypal.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="icon" type="image/png" href="../img/logoIcon.jpeg">
</head>

<body>
    <!-- header -->
    <?php

function formatear_precio($precio) {
    return number_format($precio, 0, ',');}
    include("./header.php");

    if (!isset($_SESSION['nombre'])) {
        header('Location: ./iniciar_sesion.php');
        exit();
    }
    
    include("../logica/mostrarProductos/funciones.php");

    $codigo = $_POST['codeHidden'];
    $producto = obtenerUnProducto($codigo);
    $fotos = obtenerImagenes($codigo);
    $precio = $_POST['priceHidden'];
    $cantidad = $_POST['cantidad'];
    ?>

    <!-- contenido -->
    <form  action="../logica/datosPago/controladorDatosPago.php" method="POST"  name="datosPagoForm" id="datosPagoForm" class="main_container">

        <div class="container-product">
            <img src="../<?php echo $fotos[0]['imagen']; ?>" alt="">
            <div class="product-name">
                <h2>Producto:</h2>
                <h3><?php echo $producto[0]['Nombre'] ?></h3>  
            </div>
            
            <div class="wrap-product product-quantity">
                <h2>Unidades:</h2>
                <h3><?php echo $cantidad ?></h3>
            </div>
            <div class="wrap-product product-price">
                <h2>Total a pagar: </h2>
                <h3>$ <?php echo formatear_precio($precio )?></h3> 
            </div>
            
        </div>

        <div class="container-account">
            <label for="cuantaPaypal">Cuenta de PayPal</label>
            <input type="email" placeholder="Email" required>
        </div>

        <input type="hidden" name="vendedor" value="<?php echo $producto[0]['Vendedor'] ?>">
        <input type="hidden" name="unidadesDisponibles" value="<?php echo $producto[0]['Unidades_Disponibles'] ?>">
        <input type="hidden" name="cliente" value="<?php  echo $_SESSION['id'] ?>">
        <input type="hidden" name="formaPago" value="<?php echo $_POST['opcion'] ?>">
        <input type="hidden" name="direccion" value="<?php echo $_POST['direccion'] ?>">
        <input type="hidden" name="ciudad" value="<?php echo $_POST['ciudad'] ?>">
        <input type="hidden" name="precio" value="<?php echo $precio ?>">
        <input type="hidden" name="cantidad" value="<?php echo $cantidad ?>">
        <input type="hidden" name="codProducto" value="<?php echo $codigo ?>">
        
    </form>

    <div class="container-submit">
        <button class="btn" id="submitDatosPago">Realizar Compra</button> 
        <a href="./index.php"><button class="btn">Cancelar Compra</button></a>
        </div>
    </div>
    <!-- footer -->
    <?php
        include("./footer.php");
    ?>
    <script src="../js/submitDatosPago.js"></script>
</body>
</html>