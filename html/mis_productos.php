<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis productos</title>
    <link rel="stylesheet" href="../css/estilos_header.css">
    <link rel="stylesheet" href="../css/estilos_footer.css">
    <link rel="stylesheet" href="../css/estilos_mis_productos.css">
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

    if (!isset($_SESSION['nombre'])) {
        header('Location: ./iniciar_sesion.php');
        exit();
    }

    include("../logica/mostrarProductos/funciones.php");
    $documento = $_SESSION['id'];
    $productos = obtenerMisProductos($documento);

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

    <!-- contenido --> 
    <main class="Main">

        <?php

function formatear_precio($precio) {
    return number_format($precio, 0, ',');}
        foreach($productos as $producto){

            $fotos = obtenerImagenes($producto['Codigo']);

            echo "<div class='product'>
            <h2>".$producto['Nombre']."</h2>
           <h3>$ " . formatear_precio($producto['Precio_Venta']) . "</h3>
            <p><strong>Cantidad: </strong>".$producto['Unidades_Disponibles']." </p>
            <img src='../".$fotos[0]['imagen']."' alt=''>
            <div class='product__buttons'>

                <form action='../logica/mostrarProductos/controladorEliminarProducto.php' method='POST'>
                    <input type='submit' name='ventas' class='button' value='Ventas'>
            
                    <input type='submit' name='editar' class='button' value='Editar'>
                    <input type='submit' name='eliminar' class='button' value='Eliminar'>
                    <input type='hidden' name='codigo' value='".$producto['Codigo']."'>
                </form> 
            </div>
        </div>";
        }
        ?>
    </main>
     
 <!-- footer -->
    <?php
        include("./footer.php");
    ?>
</body>
</html>