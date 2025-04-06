<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilos_pago_carrito2.css">
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
    
        <div class="adress-container">
    
            <form action="" method="POST" class="direction-container" id="direccion">
                <h2>Selecciona direccion de envio</h2> 
                
                <!-- Campo para mandar el id del usuario al controlador para realizar la venta -->
                <input type="hidden" name="cliente" value="<?php echo $_SESSION['id'] ?>">
    
                <div class="Direccion-container">   
                    <h2>Direccion</h2>
                    <input type="text" class="input-direccion" name="direccion" placeholder="Ej. Carrera 22 #5c - 05 " required> 
                    
                    
                    <div class="ubication-container">                
                        <div class="input-department">
                            <select class="selector-department" name="departamento" required onclick="muestraSelect(this.value)" required>
                                <option value="#" selected>Departamento</option>
                                <?php include "../logica/ciudadesDepartamentos/departamentos.php" ?>
                            </select> 
                        </div>  

                        <div class="input-city" id="input-city">
                            <select class="selector-city" name="ciudad" required>
                                <option value="#" selected>Ciudad</option>
                            
                            </select>
                        </div> 
                    </div>  
                </div>
               
                <div class="pay-container">
                    <h2 class="tittle-pay">Selecciona Metodo de pago</h2>
                    <div class="method-container">  <input name="opcion"type="radio" class="paypal" value="1" required> Tarjeta Debito/Credito  </div>
                    <hr>
                    <div class="method-container"> <input name="opcion"type="radio" class="visa" value="3" > PayPal </div>
                    <hr>
                    <div class="method-container"> <input name="opcion"type="radio" class="masterCard" value="4" > PSE </div>                
                </div>
            </div>
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
    
    <script src="../js/submitsFormsPagoCarrito2.js"></script>
</body>
</html>