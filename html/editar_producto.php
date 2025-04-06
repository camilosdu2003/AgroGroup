<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar producto</title>
    <link rel="stylesheet" href="../css/estilos_footer.css">
    <link rel="stylesheet" href="../css/estilos_header.css">
    <link rel="stylesheet" href="../css/estilos_agregar_producto.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,300;0,400;0,800;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/png" href="../img/logoIcon.jpeg">
</head>

<body class="body">
    <!-- header -->
    <?php
    include("./header.php");

        $id = $_SESSION['id'];
        $nombre = $_SESSION['nombre'];

    if (!isset($_SESSION['nombre'])) {
        header('Location: ./iniciar_sesion.php');  
        exit();
    }

    include("../logica/mostrarProductos/funciones.php");

    $codigo = $_GET['codigo'];
    $producto = obtenerUnProducto($codigo)[0];
    $fotos = obtenerImagenes($codigo);
    $categoria = obtenerCategoria($producto['Categoria'])[0];

    
    ?>

    <!-- contenido principal  -->
    <form class="form" action="../logica/agregarProducto/controlador.php"  method="POST" enctype="multipart/form-data">

        <h2 class="form__title">Agregar Producto</h2>

        <div class="form__input">
            <label for="name">Nombre del producto</label>
            <input type="text" name="name" id="name" value="<?php echo $producto['Nombre'] ?>" >
        </div>

        <div class="form__img">
            <div class=" label__img">
                <label for="imagen">Fotos del producto</label>
            </div>
            <label for="inputImg" class="labelImg">Subir fotos del producto</label>
            <input type="file" class="inputImg" id="inputImg" name="fotos[]" multiple >
    
            <div class="form__mainimg">
                <img class="main__img" src="../<?php echo $fotos[0]['imagen']; ?>" alt="motocierra" id="containerImg0">
            </div>

            <div class="form__secundary_img">
                <img  class="secundary_img" src="../<?php echo $fotos[1]['imagen']; ?>" alt="motocierra" id="containerImg1">
                <img class="secundary_img" src="../<?php echo $fotos[2]['imagen']; ?>" alt="motocierra" id="containerImg2">
                <img class="secundary_img" src="../<?php echo $fotos[3]['imagen']; ?>" alt="motocierra" id="containerImg3">
            </div>
      
        </div>

        <div class="form__input">
            <label for="Descripción"> Descripción</label>
            <textarea name="descripcion" id="descripcion" cols="30" rows="5" placeholder="Descripción" maxlength="400" ><?php echo $producto['Descripcion'] ?></textarea>
        </div>

        <div class="form__input-double">
            <div class=form__input-categories>
                <label for="categoria">Categoría:</label>
                <select id="categoria" name="categoria" >
                    <option value="<?php echo $producto['Categoria'] ?>"><?php echo $categoria['categoria'] ?></option>
                    <option value="2">Bovinos</option>
                    <option value="3">Fertilizantes</option>
                </select>
            </div>

            <div class="form__input-units">
                <label for="Unidades">Unidades disponibles</label>
                <input type="number" name="unidades" id="Unidades" value="<?php echo $producto['Unidades_Disponibles'] ?>" min="0" max="999" >
            </div> 

        </div>

        <div class="form__input">
            <label for="Precio">Precio</label>
            <input type="text" id=" Precio" name="precio" value="<?php echo formatear_precio($producto['Precio_Venta'])  ?>" onkeyup="this.value = agregarSeparadorMiles(this.value)" >
        </div>

        <!-- obtener id del usuario -->
        <?php
                function formatear_precio($precio) {
                    return number_format($precio, 0, ',');}
        echo "<input type='hidden' name='id' value='".$id ."'>";
        // codigo del producto
        echo "<input type='hidden' name='codProducto' value='".$codigo."'>";
        ?>
    
        <div class="form__btn">
            <input class="btn__agg" type="submit" value="Cancelar" name="cancelar">

            <input class="btn__agg" type="submit" value="Actualizar" name="actualizar">
        </div>
 
    </form> 
    
    <!-- header -->
    <?php
    include("./footer.php");
    ?>

    <script src="../js/image_preview.js"></script>
    <script src="../js/puntosMilesPrecio.js"></script>
</body>
</html>