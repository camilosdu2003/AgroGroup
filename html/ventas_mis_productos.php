<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ventas mis productos</title>
    <link rel="stylesheet" href="../css/estilos_header.css">
    <link rel="stylesheet" href="../css/estilos_ventas_mis_productos.css">
    <link rel="stylesheet" href="../css/estilos_footer.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/png" href="../img/logoIcon.jpeg">
</head>
<body>
    <!-- Header -->
    <?php
    include("./header.php");
    include("../logica/mostrarVentas/funciones.php");
    include('../logica/mostrarProductos/funciones.php');

    
    if (!isset($_SESSION['nombre'])) {
        header('Location: ./iniciar_sesion.php');
        exit();
    }

    $codigo = $_GET['codigo'];

    $codVendedor = $_SESSION['id'];

    $ventas = obtenerVentasUnProducto($codigo);
    $fotos = obtenerImagenes($codigo);

    ?>

    <!-- Contenido -->
    <div class="main__container">

        <?php


        foreach($ventas as $venta){
            $FotoCliente = obtenerFotoCliente($venta['Codigo'], $codVendedor);
           echo"<div class='sales__container'>

                    <div class='image__container'>
                        <a href='producto.php?codigo=$codigo'>
                        <img class='product__imgage' src='../".$fotos[0]['imagen']."' alt='imagen del producto'>
                        </a>
                    </div>

                    <div class='product__container'>
                        <div class='product__wrap'>
                            <h1>".$venta['producto']."</h1>
                            <h2>Cantidad vendida</h2>
                            <h3>".$venta['Cantidad']."</h3>
                            <h2>Codigo de venta</h2>
                            <h3 class='sales__code'>".$venta['Codigo']."</h3>
                            <h2>Fecha de compra</h2>
                            <h3>".$venta['Fecha_Venta']."</h3>
                            <h2 class=''>dirección de envío:</h2>
                            <h3 class='shipping__address'> ".$venta['municipio'] ." - ".$venta['Departamento']." </h3>
                            <h3 class='shipping__address'>".$venta['Direccion']."</h3>
                        </div>
               
                    </div>

                    <div class='buyer__container'>
                        <h2 class='buyer__title'>Comprador:</h2>
                        <h2 class='buyer__name'>".$venta['cliente']."</h2>
                        <img src='../".$FotoCliente['Foto']."' alt=''>
                        
               
                    </div>

                    <div class='guide__container'>
                        <a href='numero_guia.php?codigoVenta=".$venta['Codigo']."'>
                            <span class='material-symbols-outlined'>
                                add_photo_alternate
                            </span> 
                        </a>
                        <h2>Subir guía</h2>
                    </div>

                </div>";

        }

        ?>        
    </div>

    <!-- footer -->
    <?php
        include("./footer.php");
    ?>

</body>
</html>