<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar contraseña</title>
    <link rel="stylesheet" href="../css/estilos_header.css">
    <link rel="stylesheet" href="../css/estilos_footer.css">
    <link rel="stylesheet" href="../css/estilos_recuperar_contraseña_1.css ">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="icon" type="image/png" href="../img/logoIcon.jpeg">
</head>
<body>
    <!-- Header -->
    <?php
    include("./header.php");

     // mensaje de alerta 
     if(isset($_SESSION['msjAlerta'])){
        $msj = $_SESSION['msjAlerta'] ?>
        <script>
            Swal.fire({
                title: "<?php echo $msj ?>",
                icon: "error"
            });
        </script>

        <?php
            unset($_SESSION['msjAlerta']);
    }
    ?>

    <!-- Contenido -->
    <div class="main-content">
        <div class="content">
            <h2 class="tittle">Recuperar contraseña</h2>
            
            <form class="email-content" action="../logica/restablecerContraseña/controladorRestablecerContraseña.php" method="POST">

                <label for="email">Ingresa tú correo electronico</label>
                <input type="email" name="email" placeholder="correo electronico" id="email" class="email">
                <button  type="submit" class="button">Enviar código</button>
              
            </form>
          </div>
    </div>
    <!-- footer -->
    <?php
        include("./footer.php");
    ?>
</body>
</html>