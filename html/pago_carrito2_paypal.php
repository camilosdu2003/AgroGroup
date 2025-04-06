<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilos_pago_carrito2_paypal.css">
    <link rel="stylesheet" href="../css/estilos_footer.css">
    <link rel="stylesheet" href="../css/estilos_header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="../js/location.js"></script>
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
            <h2 for="cuantaPaypal">Cuenta de PayPal</h2>
            <input type="email" placeholder="Email" required>
            </div>
    
            <input type="text"  value="<?php echo $_POST['opcion'] ?>" name="opcion" hidden >
            <input type="text"  value="<?php echo $_POST['cliente'] ?>" name="cliente" hidden >
            <input type="text"  value="<?php echo $_POST['direccion'] ?>" name="direccion" hidden >
            <input type="text"  value="<?php echo $_POST['ciudad'] ?>" name="ciudad" hidden >
        </form>
    </div>
    
        
    <div class="button-container">
        <button class="button-buy" id="btnRealizarPago">Realizar Pago</button>
        <a href="./carrito.php"><button class="button-cancel">Cancelar compra</button></a>
    </div>

    <!-- footer -->
    <?php
        include("./footer.php");
    ?>
    
    <script src="../js/submitsFormsPagoCarrito3.js"></script>
</body>
</html>