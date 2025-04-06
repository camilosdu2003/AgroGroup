<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Recuperar contraseña</title>
<link rel="stylesheet" href="../css/estilos_recuperar_contraseña_3.css">
<link rel="stylesheet" href="../css/estilos_footer.css">
<link rel="stylesheet" href="../css/estilos_header.css">
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

    if (!isset($_SESSION['email'])) {
        header('Location: ./recuperar_contraseña_1.php');
        exit();
    }

    if(isset($_SESSION['email'])){
        $email = $_SESSION['email'];
    }
    ?>

    <!-- Contenido -->
    <div class="main-content">
        <div class="content">
            <h1 class="tittle">Recuperación de Contraseña</h1>
            <form class="pasword-content" action="../logica/restablecerContraseña/controladorRestablecerContraseña.php" method="POST">

            <?php
            if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
                echo "<ul class='error-messages'>
                        <li>".$_SESSION['errors']."</li>
                    </ul>";
                unset($_SESSION['errors']);
            }
            unset($_SESSION['form_data']);
            ?>

                <input type="password" placeholder="Nueva Contraseña" name="nuevaContraseña" class="password" required>
                <input type="password" placeholder="Confirmar Contraseña" name="confirmarContraseña" class="password" required>
                <input type="hidden" name="restablecerEmail" value="<?php echo $email?>" required>
                <a href=""><button type="submit" name="restablecerContraseña" class="button">Restablecer</button></a>
            </form>
        </div>
    </div>
    
    <!-- footer -->
    <?php
        include("./footer.php");
    ?>

</body>
</html>

</html>


