<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agrogroup</title>
    <link rel="stylesheet" href="../css/estilos_header.css">
    <link rel="stylesheet" href="../css/estilos_footer.css">
    <link rel="stylesheet" href="../css/estilos_inicio.css"> 
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,300;0,400;0,800;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/png" href="../img/logoIcon.jpeg">

</head>
<body>
    <!--header -->
    <?php
    include("./header.php");
    ?>

    <!-- contenido -->
    <h2 class="category-title">Categorias</h2>
    <div class="container-slider">

        <div class="slider" id="slider">
            <div class="slider__section">
                <img src="../img/img1.jpg.jpg" alt="" class="slider__img">

                <div class="slider__content">
                    <h2 class="slider__title">Maquinaria y equipos agricolas</h2>
                    <p class="slider__txt">Aumenta la eficiencia de tu campo con nuestras soluciones tecnológicas</p>
                    <a href="categoria.php?categoria=8" class="btn-shop">VER MÁS</a>
                </div>
            </div>

            <div class="slider__section">
                <img src="../img/insumos.jpg" alt="" class="slider__img">

                <div class="slider__content">
                    <h2 class="slider__title">Insumos y productos quimicos </h2>
                    <p class="slider__txt">Innovación y calidad para tus cultivos</p>
                    <a href="categoria.php?categoria=9" class="btn-shop">VER MÁS</a>
                </div>
            </div>

            <div class="slider__section">
                <img src="../img/manejoEntorno.jpg" alt="" class="slider__img">

                <div class="slider__content">
                    <h2 class="slider__title">Infraestructura y manejo del entorno</h2>
                    <p class="slider__txt">Construye un entorno óptimo para el desarrollo de tus cultivos</p>
                    <a href="categoria.php?categoria=10" class="btn-shop">VER MÁS</a>
                </div>
            </div>

            <div class="slider__section">
                <img src="../img/img2.jpg.jpg" alt="" class="slider__img">

                <div class="slider__content">
                    <h2 class="slider__title">Alimentación animal y accesorios</h2>
                    <p class="slider__txt">Provee lo mejor para la alimentación y bienestar de tus animales</p>
                    <a href="categoria.php?categoria=11" class="btn-shop">VER MÁS</a>
                </div>
                
            </div>
             <div class="slider__section"> 
                <img src="../img/tecnologiaMonitoreo.jpg" alt="" class="slider__img">

                <div class="slider__content">
                    <h2 class="slider__title">Tecnologia y monitoreo</h2>

                    <p class="slider__txt">Vigila y optimiza tu campo con las últimas tecnologías</p>
                    <a href="categoria.php?categoria=12" class="btn-shop">VER MÁS</a>
                </div>

            </div>
        </div>
            <div class="slider__btn slider__btn--right" id="btn-right">&#62;</div>
            <div class="slider__btn slider__btn--left" id="btn-left">&#60;</div>
    </div>       
    <?php
     
    if(isset( $_SESSION['nombre'])){
        $nombre = $_SESSION['nombre'];
    }

    //invovo el archivo de funciones para mostrar los productos
    include('../logica/mostrarProductos/funciones.php');
   
    // variable para almacenar los productos de la base de datos con la funcion "obtenerProductos()"
    $productos = obtenerProductos();

    ?>
    <!-- titulo articulos -->
    <h2 class=" title-news-art">Nuevos articulos</h2>

    <div class="container-news-art">
        <?php

        //Funcion para ponerles las comas de pesos al precio 
        function formatear_precio($precio) {
            return number_format($precio, 0, ',');
        }

        foreach($productos as $producto){
            
            $fotos = obtenerImagenes($producto['Codigo']);
            
            // echo var_dump($fotos);

            echo "<div class='news-art'>
                    <a href='producto.php?codigo=".$producto['Codigo']."'><img src='../".$fotos[0]['imagen']."'></a>
                    <h2>".$producto['Nombre']."</h2>
                    <h3>$ " . formatear_precio($producto['Precio_Venta']) . "</h3>
                </div>";
            }
        ?>
    </div>

    <!-- <a class="btn-see-more">Ver Más</a> -->

     <!-- footer -->
    <?php
        include("./footer.php");
    ?>

    <script src="../js/slider.js"></script>
   
</body>
</html>