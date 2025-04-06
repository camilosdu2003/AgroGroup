<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Busqueda de producto</title>
    <link rel="stylesheet" href="../css/estilos_header.css">
    <link rel="stylesheet" href="../css/estilos_footer.css">
    <link rel="stylesheet" href="../css/estilos_categoria.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,300;0,400;0,800;1,400&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="../img/logoIcon.jpeg">
</head>

<body>
    <!-- header -->
    <?php
    include("./header.php");
    include("../logica/buscador/controladorBuscador.php");
    include('../logica/mostrarProductos/funciones.php');

    if (isset($_GET['busqueda'])) {
        $busqueda = $_GET['busqueda'];
        $ordenar = $_GET['ordenar'];

        $productosBuscados = definirOrdenConsulta($busqueda, $ordenar);
    }

    ?>

    <!-- contenido -->
    <div class="main-container">
        <div class="content-container">

            <div class="tittle-container">
                <h1>Resultados para: "<?php echo $_GET['busqueda'] ?>"</h1>
            </div>

            <div class="img-container">

                <?php
                function formatear_precio($precio)
                {
                    return number_format($precio, 0, ',');
                }

                foreach ($productosBuscados as $producto) {
                    $fotos = obtenerImagenes($producto['Codigo']);

                    echo "<div class='img'>
                    <a href='producto.php?codigo=" . $producto['Codigo'] . "'><img src='../" . $fotos[0]['imagen'] . "'></a>
                    <h2>" . $producto['Nombre'] . "</h2>
                     <h3>$ " . formatear_precio($producto['Precio_Venta']) . "</h3>
                </div>";
                }

                ?>
            </div>
        </div>
    </div>

    <?php
    include("./footer.php");
    ?>

</body>

</html>