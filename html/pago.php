<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago</title>
    <link rel="stylesheet" href="../css/estilos_header.css">
    <link rel="stylesheet" href="../css/estilos_footer.css">
    <link rel="stylesheet" href="../css/estilos_pago.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="../js/location.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

    include("../logica/mostrarProductos/funciones.php");

    $codigo = $_GET['codigo'];
    $producto = obtenerUnProducto($codigo);
    $fotos = obtenerImagenes($codigo);
    ?>

    <!-- contenido -->
    <div class="main_container">
        <form action="" method="POST" id="information_form" name="information_form" class="container-information">
           
            <input  id="price" type="hidden" value="<?php echo $producto[0]['Precio_Venta'] ?>">
            <input type="hidden" name="priceHidden" id="priceHidden" value="<?php echo $producto[0]['Precio_Venta'] ?>">
            <input type="hidden" name="codeHidden" id="codeHidden" value="<?php echo $producto[0]['Codigo'] ?>">
            
            <div class="quantity-container">
                <label for="cantidad"><h2 class="tittle">Cantidad a comprar</h2></label>
                <input type="number" class="quantity-input" name="cantidad" id="inputQuantity" min="1" max="<?php echo $producto[0]['Unidades_Disponibles'] ?>" required>
            </div>

            <div class="direction-container">
    
                 <div class="Direccion-container">   
                    <h2 class="tittle">Direccion de envío</h2>
                    <input type="text" class="input-direccion" name="direccion" placeholder="Ej. Carrera 22 #5c - 05 " required> 
                    
                    <div class="ubication-container">                
                        <div class="input-department">
                            <select class="selector-department" id="departamento-select" name="departamento" onclick="muestraSelect(this.value)" required>
                                <option value="">Seleccionar departamento</option>
                                <?php include "../logica/ciudadesDepartamentos/departamentos.php" ?>  
                            </select>
                        </div>

                        <div class="input-city" id="input-city">
                            <select class="selector-city" name="ciudad" id="departamento-select" required>
                                <option id="optionCityValue" value="">Seleciona una ciudad</option>
                            </select> 
                        </div>  
                    </div>  
                </div>  
            </div>

            <div class="pay-container">
                <h2 class="tittle">Selecciona Metodo de pago</h2>

                <div class="methods-container"> 

                    <div class="method-container">  
                        <input type="radio" class="visa" value="1" name="opcion" id="visa" required>  <option class="fa-brands fa-cc-visa"> </option>
                        <label for="visa">Tarjeta Debito/Credito</label> 
                    </div>
                    <hr>
                    <div class="method-container">    
                        <input type="radio" class="paypal" value="3" name="opcion" id="paypal" required> <option class="fa-brands fa-cc-paypal"></option> 
                        <label for="paypal">PayPal</label>  
                    </div>
                    <hr>
                    <div class="method-container"> 
                        <input type="radio" class="masterCard" value="4" name="opcion" id="masterCard">  <option class="fa-brands fa-cc-mastercard"></option> 
                        <label for="masterCard">PSE</label>  
                    </div>
                </div>
            </div>
        </form>

        <div id="product_form" class="container-product">
            <img src="../<?php echo $fotos[0]['imagen']; ?>" alt="">
            <h2><?php echo $producto[0]['Nombre'] ?></h2>
            <h3 id="showPrice"><?php echo $producto[0]['Precio_Venta'] ?></h3>
        </div>

    </div>

    <div class="container-submit">
        <button class="btn" id="submit_forms" name="submit_forms">Realiazar Compra</button>
        <a href="./index.php"><button class="btn">Cancelar Compra</button></a>
    </div>
    <!-- footer -->
    <?php
        include("./footer.php");
    ?>
    <script src="../js/value_quantity.js"></script>
</body>
</html>