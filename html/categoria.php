<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Busqueda por Categoria</title>
    <link rel="stylesheet" href="../css/estilos_header.css">
    <link rel="stylesheet" href="../css/estilos_footer.css">
    <link rel="stylesheet" href="../css/estilos_categoria.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,300;0,400;0,800;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/png" href="../img/logoIcon.jpeg">
</head>
<body>
    <!-- header -->
    <?php
    include("./header.php");
    include("../logica/mostrarProductos/funciones.php");

    $categoria = $_GET['categoria'];
    ?>

    <!-- contenido -->
    <div class="main-container">
        <div class="content-container">

            <?php
                    function formatear_precio($precio) {
                        return number_format($precio, 0, ',');}
                if(empty($productos)){

                }else{
                   echo "
                    <div class='tittle-container'>
                        <h1> Nombre de la categoria</h1>
                    </div>
                   ";
                }

            ?>

            <div class="img-container">

                <?php
                $productos = obtenerProductosCategoria($categoria);

                if(empty($productos)){

                    echo"<h1 class='mensajeError'>Actualmente no exiten productos con la categoria seleccionada. porfavor intentolo en otro momento</h1>";
                        
                }else{
                    foreach($productos as $producto){
                        
                        $fotos = obtenerImagenes($producto['Codigo']);
            
                        echo "
                            <div class='img'>
                                <a href='producto.php?codigo=".$producto['Codigo']."'><img src='../".$fotos[0]['imagen']."'></a>
                                <h2>".$producto['Nombre']."</h2>
                                 <h3>$ " . formatear_precio($producto['Precio_Venta']) . "</h3>
                            </div>
                        ";
                    }
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