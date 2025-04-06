<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <title>Carrito de compras</title>
    <link rel="stylesheet" href="../css/estilos_footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet"A href="../css/estilos_header.css">
    <link rel="stylesheet" href="../css/estilos_Carrito.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,300;0,400;0,800;1,400&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/png" href="../img/logoIcon.jpeg">
</head>
<body>

    <!-- Header -->
    <?php
    include("./header.php");
    include("../logica/Carrito/funcionesCarrito.php");
    include('../logica/mostrarProductos/funciones.php');

    
    if (!isset($_SESSION['nombre'])) {
        header('Location: ./iniciar_sesion.php');
        exit();
    }

    $carrito = obtenerCodCarrito($_SESSION['id']);
    $productosCarrito = mostrarProductosCarrito($carrito[0]['Codigo']);

    foreach($productosCarrito as $index => $productoCarrito){
        $productoID = $productoCarrito['Codigo_Productos'];
        $precio =  $productoCarrito['Precio_Venta'];

        actualizarProductoCarrito($productoID, $precio, 1);
    }

    // mensaje de alerta 
    if(isset($_SESSION['msjAlerta'])){
        $msj = $_SESSION['msjAlerta'] ?>
        <script>
            Swal.fire({
                title: "<?php echo $msj ?>",
                icon: "success"
            });
        </script>

        
        <?php
            unset($_SESSION['msjAlerta']);  
    }
        ?>

    <!-- Contenido  -->
    <div class="container">
        <div class="title__container">
            <h1 class="title">Carrito de compras</h1>
        </div>

        <?php
                function formatear_precio($productoCarrito) {
                    return number_format($productoCarrito, 0, ',');}
        $valorTotalCarrito = 0;
        
        //  $cantidadProductos es un contador de la cantidad de productos en el carrito, se usa para el ciclo que crea el formulario del precio actualizado
        $cantidadProductos = 0;
        
        foreach($productosCarrito as $index => $productoCarrito){
            $fotos = obtenerImagenes($productoCarrito['Codigo_Productos']);
            $codProducto = $productoCarrito['Codigo_Productos'];
            echo "<div class='product'>
                    <div class='product-image'>
                        <a href='producto.php?codigo=".$productoCarrito['Codigo_Productos']."'><img src='../".$fotos[0]['imagen']."' alt='producto1'></a>
                    </div>
        
                    <div class='product-info'>
                        <h2 class='product-name'>".$productoCarrito['Nombre']."</h2>
                    </div>
        
                    <div class='product-price'>
                        <h2>Precio</h2>
                        <h3>$ ".formatear_precio($productoCarrito['Precio_Venta'])."</h3>
                    </div>
        
                    <div class='product-quantity'>
                        <label for='quantity_$index'>Cantidad</label>
                        <input type='number' id='quantity_$index' class='quantity' data-index='$index' value='1'  min ='1' max='".$productoCarrito['Unidades_Disponibles']."' required>
                    </div>
        
                    <div class='total__product'>
                        <h2>Precio total</h2>
                        <h3 id='showPrice_$index' class='total-price1' hidden>".$productoCarrito['Precio']."</h3>
                        <h3 id='showPrice1_$index' class='total-price'>".$productoCarrito['Precio']."</h3>

                        <input type='hidden' id='price_$index' class='price' value='".$productoCarrito['Precio']."'>
                    </div>
        
                    <div class='product-delete'>
                        <i class='fa-solid fa-trash' onclick='deleteItem(".$productoCarrito['Codigo_Productos'].")'></i>
                    </div>
                </div>";
        
            $valorTotalCarrito += $productoCarrito['Precio'];
            $cantidadProductos++;
        }
        ?>

        <!-- Formulario oculto para enviar la solicitud que borra un producto del carrito -->
        <form id="deleteItemForm" method="post" action="../logica/Carrito/contoladorCarrito.php">
            <input type="hidden" name="item_id" id="item_id">
        </form>

        <!-- Formulario que envia la cantidad y el precio actualizado -->
        <form id="updateForm" method="POST" action="../logica/Carrito/controladorActualizarCarrito.php">
            <?php
            for($index = 0; $index < $cantidadProductos; $index++){
                echo"<input type='hidden' name='itemIdEdit[]' id='item_id_edit_$index' value='".$productosCarrito[$index]['Codigo_Productos']."'>
                    <input type='hidden' name='itemPriceEdit[]' id='item_price_edit_$index' value='".$productosCarrito[$index]['Precio']."'>
                    <input type='hidden' name='itemQuantityEdit[]' id='item_quantity_edit_$index' value='".$productosCarrito[$index]['Cantidad']."'>
                    <input type='hidden' name='quantityProductsEdit' value='".$cantidadProductos."'>
                    <input type='hidden' name='vendedor[]' value='".$productosCarrito[$index]['Vendedor']."'>
                    <input type='hidden' name='cantidadDisponible[]' value='".$productosCarrito[$index]['Unidades_Disponibles']."'>
                ";
            }
            ?>
        </form>

        <div class="total">
            <p class="total-value">Valor Total: $ <?php echo $valorTotalCarrito ?></p>
        </div>

        <div class="buttons">
            <a href="index.php"><button class="button button-cancel">Ver más productos</button></a>
           <button type="button" class="button button-buy" id="btnBuyProduct">Comprar todo</button>
        </div>
    </div>

    <!-- footer -->
    <?php
    include("./footer.php");
    ?>

    <script src="../js/quantityShoppingCart.js"></script>
</body>
</html>