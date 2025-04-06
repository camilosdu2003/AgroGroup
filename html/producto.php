<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informacion del producto</title>
    <link rel="stylesheet" href="../css/estilos_producto.css">
    <link rel="stylesheet" href="../css/estilos_footer.css">
    <link rel="stylesheet" href="../css/estilos_header.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,300;0,400;0,800;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="icon" type="image/png" href="../img/logoIcon.jpeg">
</head>

<body>
    <!-- header -->
    <?php
    include("./header.php");
    include("../logica/mostrarProductos/funciones.php");
    include("../logica/carrito/funcionesCarrito.php");

    $codigo = $_GET['codigo'];

    $producto = obtenerUnProducto($codigo);
    $fotos = obtenerImagenes($codigo);
    if (isset($_SESSION['id'])) {
        $carrito = obtenerCodCarrito($_SESSION['id']);
        $nombre = $_SESSION['nombre'];
    }

    
    // Mensaje de alerta de producto agregado al carrito
    if (isset($_SESSION['msjAlerta'])) {
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

    <!-- contenido -->
    <div class="conteiner-product">

        <div class="product-image">
            <div class="container-img-main">

                <img src="../<?php echo $fotos[0]['imagen']; ?>" alt="motocierra" class="imagen-main">
            </div>

            <div class="container-img-secondary">
                <?php foreach ($fotos as $index => $foto) : ?>

                    <div class="images-product">
                        <img src="../<?php echo $foto['imagen']; ?>" class="images_secondary<?php echo ($index === 0) ? ' active' : ''; ?>" alt="imagen secundaria<?php echo $index + 1; ?>">
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="info-product">

            <h1><?php echo $producto[0]['Nombre'] ?></h1>
            <h2>$ <?php echo formatear_precio($producto[0]['Precio_Venta']) ?></h2>
            <p><?php echo $producto[0]['Descripcion'] ?></p>
            <p><strong>Unidades Disponibles:</strong> <?php echo $producto[0]['Unidades_Disponibles'] ?></p> <!-- Mostrar unidades disponibles -->

            <!-- Validacion que muestra el boton de comprar y añadir al carrito solo cuando esta disponible y no es el mismo vendedor -->
            <?php
            if (isset($_SESSION['id'])) {
                if ($producto[0]['Unidades_Disponibles'] > 0 and $producto[0]['Estado'] == 'disponible' and $producto[0]['Vendedor'] != $_SESSION['id']) {
                    echo "<a href='pago.php?codigo=$codigo'><button class='info__btn'>Comprar</button></a>
                        <button class='info__btn' id='agregarCarrito'>Añadir al carrito</button>  
                    ";
                }
            } else {
                if ($producto[0]['Unidades_Disponibles'] > 0 and $producto[0]['Estado'] == 'disponible') {
                    echo "<a href='pago.php?codigo=$codigo'><button class='info__btn'>Comprar</button></a>
                        <button class='info__btn' id='agregarCarrito'>Añadir al carrito</button>  
                    ";
                }
            }

            ?>

            <!-- Formulario oculto para añadir producto al carrito -->
            <form action="../logica/Carrito/contoladorCarrito.php" method="POST" id="formularioCarrito">
                <input type="hidden" name="codProducto" value="<?php echo $codigo ?>">
                <?php
                //esta validacion se hace para que en caso de no iniciar sesion, el campo del codigo del carrito no se mande al controlador ya que con este campo se valida si ya  se inicio sesion o no a la hora de agregar el producto al carrito
                if (isset($_SESSION['id'])) {
                    echo "<input type='hidden' name='codCarrito' value='" . $carrito[0]['Codigo'] . "'>";
                }
                ?>
                <input type="hidden" name="precio" value="<?php echo $producto[0]['Precio_Venta'] ?>">
            </form>
        </div>
    </div>

    <hr>
    <h2 class="title-products-similar">Productos similares</h2>

    <div class="container-products-similar">

        <?php
        function formatear_precio($precio)
        {
            return number_format($precio, 0, ',');
        }

        $productos = obtenerProductos();

        foreach ($productos as $producto) {

            $fotos = obtenerImagenes($producto['Codigo']);

            echo "<div class='product-similar'>
                    <a href='producto.php?codigo=" . $producto['Codigo'] . "'>
                        <img src='../" . $fotos['0']['imagen'] . "'>
                    </a>
                    <h2>" . $producto['Nombre'] . "</h2>
                    <h3>$ " . formatear_precio($producto['Precio_Venta']) . "</h3>
                </div>";
        }

        ?>
    </div>

    <!-- footer -->
    <?php
    include("./footer.php");
    ?>

    <script src="../js/product_img_selector.js"></script>
    <script src="../js/submitshoppingCartForm.js"></script>
</body>

</html>