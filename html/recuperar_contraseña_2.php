<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar contraseña</title>
    <link rel="stylesheet" href="../css/estilos_recuperar_contraseña_2.css">
    <link rel="stylesheet" href="../css/estilos_header.css">
    <link rel="stylesheet" href="../css/estilos_footer.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                icon: "success"
            });
        </script>

        <?php
            unset($_SESSION['msjAlerta']);
    }

    if(isset($_SESSION['emailVerificacion'])){
        $email = $_SESSION['emailVerificacion'];
    }
    ?>

    <!-- Contenido -->
    <div class="main__content">
        <form class="content" action="../logica/restablecerContraseña/controladorRestablecerContraseña.php" method="POST">
            <h1>Recuperar contraseña</h1><br><br>
            <p>Te enviamos un codigo de 6 digitos a tu correo electrónico</p><br>
            <p>Ingresa el codigo para recuperar tu contraseña</p>

            <input class="entrada" type="text" id="entrada" name="codigo" placeholder="___ ___" required>
            <input type="hidden" name="ingresarEmail" value="<?php echo $email ?>">
            <button class="boton" type="submit" id="validacion_codigo" name="validarCodigo">Validar</button>
        </form>
    </div>
    <!-- footer -->
    <?php
        include("./footer.php");
    ?>
</body>
</html>