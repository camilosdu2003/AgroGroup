<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="../css/estilos_header.css">
    <link rel="stylesheet" href="../css/estilos_iniciar_sesion.css">
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
    <!-- header -->
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
        ?>

    <?php
    // mensaje de alerta 
    if(isset($_SESSION['errorSesion'])){
        $msj = $_SESSION['errorSesion'] ?>
        <script>
            Swal.fire({
                text: "<?php echo $msj ?>",
                icon: "error"
            });
        </script>

        <?php
            unset($_SESSION['errorSesion']);
    }
    ?>

<!-- contenido -->
    <div class="main__content">

        <form class="form" action="../logica/session/controlador_session.php" method="POST" >

            <h1>Iniciar Sesión</h1>

            <div class="wrap">
                <label for="email">Correo:</label>
                <input class="input" type="text" id="email" name="email" required>
            </div>

            <div class="wrap">
                <label for="password">Contraseña:</label>
                <input class="input" type="password" id="password" name="password" required>
            </div>
          
            <div class="buttons__container">
                <button type="submit" name="login">Iniciar Sesión</button>
                <button type="button" onclick="window.location.href='registrarse.php'">Registrarse</button>
            </div>

            <h2 class="h2"><a href="recuperar_contraseña_1.php">¿No recuerdo mi contraseña?</a></h2>
        </form>          
    </div>

    <!-- footer -->
    <?php
        include("./footer.php");
    ?>    
</body>
</html>
