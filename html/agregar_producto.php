<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Producto</title>
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

    ?>
    
    <!-- contenido principal  -->
    <form class="form" id="formulario" action="../logica/agregarProducto/controlador.php"  method="POST" enctype="multipart/form-data">

        <h2 class="form__title">Agregar Producto</h2>

        <div class="form__input">
            <label for="name">Nombre del producto</label>
            <input type="text" name="name" id="name" placeholder="Nombre" required>
        </div>

        <div class="form__img">
            <div class=" label__img">
                <label for="imagen">Fotos del producto</label>
            </div>
            <label for="inputImg"  class="labelImg">Subir fotos del producto</label>
            <p id="mensaje-error" class="mensaje-error"></p>
            <input type="file" class="inputImg" id="inputImg" name="fotos[]" multiple required>
    
            <div class="form__mainimg">
                <img class="main__img" src="../img/defaultImg.png" alt="motocierra" id="containerImg0">
            </div>

            <div class="form__secundary_img">
                <img  class="secundary_img" src="../img/defaultImg.png" alt="motocierra" id="containerImg1">
                <img class="secundary_img" src="../img/defaultImg.png" alt="motocierra" id="containerImg2">
                <img class="secundary_img" src="../img/defaultImg.png " alt="motocierra" id="containerImg3">
            </div>
      
        </div>

        <div class="form__input">
            <label for="Descripción"> Descripción</label>
            <textarea name="descripcion" id="descripcion" cols="30" rows="5" placeholder="Descripción" maxlength="400" required></textarea>
        </div>

        <div class="form__input-double">
            <div class=form__input-categories>
                <label for="categoria">Categoría:</label>
                <select id="categoria" name="categoria">
                    <option value="13">Seleccione una categoria</option>
                    <option value="8">Maquinaria y equipos agrícolas</option>
                    <option value="9">Insumos y productos químicos</option>
                    <option value="10">Infraestructura y manejo del entorno</option>
                    <option value="11">Alimentación animal y accesorios</option>
                    <option value="12">Tecnología y monitoreo</option>
                    <option value="13">Otros</option>
                </select>
            </div>

            <div class="form__input-units">
                <label class="labelUnits" for="Unidades">Unidades disponibles</label>
                <input type="number" name="unidades" id="Unidades" placeholder="Unidades disponibles" min="1" max="999" required>
            </div> 

        </div>

        <div class="form__input">
            <label for="Precio">Precio</label>
            <input type="text" id=" Precio" name="precio" placeholder="Precio" onkeyup="this.value = agregarSeparadorMiles(this.value)" required>
        </div>


        <!-- obtener id del usuario -->
        <?php
        
        echo "<input type='hidden' name='id' value='".$id ."'>";
         
        ?>
    

        <div class="form__btn">
            <input class="btn__agg" type="submit" value="Agregar" name="agregarProducto">
        </div>
        
    </form> 

    <!-- header -->
    <?php
    include("./footer.php");
    ?>

    <script src="../js/image_preview.js"></script>
    <script src="../js/puntosMilesPrecio.js"></script>
    <script src="../js/formValidationsAgregarProducto.js"></script>
</body>
</html>