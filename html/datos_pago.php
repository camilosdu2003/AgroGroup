<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos pago</title>
    <link rel="stylesheet" href="../css/estilos_header.css">
    <link rel="stylesheet" href="../css/estilos_footer.css">
    <link rel="stylesheet" href="../css/estilos_datos_pago.css">
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
        <div class="container-information">
            <div class="container-id-number">
                <label for="numero-documento" class="label">Número del documento</label>
                <input type="text" name="numero-documento" id="numero-documento" required>  
            </div>

            <div class="container-names">
                <label  for="nombres" class="label">Nombres y apellidos del titular</label>
                <input type="text"  id="nombres" class="input-names" required>
            </div>

            <div class="container-card-numer">
                <label for="numero-tarjeta" class="label">Número de tarjeta</label>
                <input type="text" id="numero-tarjeta" class="input-card-numer" required>
            </div>

            <div class="container-security-code">
                <label for="codigo-seguridad" class="label">Codigo de seguridad</label>
                <input type="text" name="codigo-seguridad" id="codigo-seguridad" class="input-security-code" required>
            </div>

            <div class="container-expiration-date">
                <label for="fecha-vencimiento">Fecha de vencimiento</label>
                <input type="month" name="fecha-vencimiento" id="expire-date" required>
            </div>
            
        </div>

        <div class="container-product">
            <img src="../<?php echo $fotos[0]['imagen']; ?>" alt="">
            <h2><?php echo $producto[0]['Nombre'] ?></h2>
            <h2>Unidades</h2>
            <h3><?php echo $cantidad ?></h3>
            <h2>Total a pagar </h2>
            <h3>$ <?php echo formatear_precio($precio )?></h3>
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