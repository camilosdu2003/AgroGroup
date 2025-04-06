<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilos_pago_carrito2_tarjeta.css">
    <link rel="stylesheet" href="../css/estilos_footer.css">
    <link rel="stylesheet" href="../css/estilos_header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Pago desde el carrito</title>
    <link rel="icon" type="image/png" href="../img/logoIcon.jpeg">
</head>
<body>

    <!-- header -->
    <?php
    include("./header.php");

    if (!isset($_SESSION['nombre'])) {
        header('Location: ./iniciar_sesion.php');
        exit();
    }
    ?>

    <!-- contenido -->
    <div class="main-container">
        <form action="../logica/Carrito/controladorVentaCarrito.php" method="POST" class="direction-container info-container" id="direccion">
            <div class="info">
                <h2>Número del documento</h2>
                <input type="text" class="id" name="documento" placeholder="Digite su número de documento" required>
            </div>
    
            <div class="info">
                <h2>Nombres y apellidos del titular</h2>
                <input type="text" class="name" name="nombre" placeholder="Digite nombres y apellidos" required>
            </div>
    
            <div class="info">
                <h2>Número de la tarjeta</h2>
                <input type="text" class="Card-number" name="tarjeta" pattern="[0-9]{13,16}" placeholder="XXXX XXXX XXXX" required>
            </div>
    
            <div class="info">
                <h2>Código de seguridad</h2>
                <input type="password" class="cvc" name="cvc" pattern="[0-9]{3}" placeholder="Ingrese cvc" required>
            </div>
    
            <div class="info">
                <h2>Fecha de vencimiento</h2>
                <input type="month" class="due-date" name="vencimiento" required>
            </div> 
            <input type="text" value="<?php echo $_POST['opcion'] ?>" name="opcion" hidden>
            <input type="text" value="<?php echo $_POST['cliente'] ?>" name="cliente" hidden>
            <input type="text" value="<?php echo $_POST['direccion'] ?>" name="direccion" hidden>
            <input type="text" value="<?php echo $_POST['ciudad'] ?>" name="ciudad" hidden>
        </form>
    </div>
    
    <div class="button-container">
        <button class="button-buy" id="btnRealizarPago">Realizar Pago</button>
        <a href="./carrito.php"><button class="button-cancel" type="button">Cancelar compra</button></a>
    </div>

    <!-- footer -->
    <?php
        include("./footer.php");
    ?>
    
    <script src="../js/submitsFormsPagoCarrito3.js"></script>
</body>
</html>
