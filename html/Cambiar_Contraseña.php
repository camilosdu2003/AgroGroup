<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar contraseña</title>
    <link rel="stylesheet" href="../css/estilos_footer.css">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/estilos_cambiar_contraseña.css">
    <link rel="stylesheet" href="../css/estilos_header.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
    ?>

    <!-- contenido principal -->
    <main class="main-container">
        <form id="cambiarContraseniaForm" method="POST" action="../logica/cambiarContrasenia/controladorCambiarContrasenia.php"
            onsubmit="return validarFormulario()">
            <div class="password_container">
                <label class="label">Contraseña actual</label>
                <div class="input-container">
                    <input id="password_Current" name="current_password" type="password" required>
                    <span class="material-symbols-outlined eye-icon"
                        onclick="togglePasswordVisibility('password_Current')">visibility</span>
                </div>
            </div>

            <div class="password_container new">
                <label class="label">Nueva Contraseña</label>
                <div class="input-container">
                    <input id="new_password" name="new_password" type="password" required>
                    <span class="material-symbols-outlined eye-icon"
                        onclick="togglePasswordVisibility('new_password')">visibility</span>
                </div>
            </div>

            <div class="password_container confirm">
                <label class="label">Confirmar Contraseña</label>
                <div class="input-container">
                    <input id="confirm_password" name="confirm_password" type="password" required>
                    <span class="material-symbols-outlined eye-icon"
                        onclick="togglePasswordVisibility('confirm_password')">visibility</span>
                </div>
            </div>

            <div class="container-submit">
                <input type="submit" id="send" value="Guardar cambios">
            </div>
        </form>
    </main>

    <?php
    include("./footer.php");
    ?>

    <script src="../js/password_toggle.js"></script>

    <script>
        function validarFormulario() {
            // Validar aquí los campos según tus necesidades
            var currentPassword = document.getElementById('password_Current').value;
            var newPassword = document.getElementById('new_password').value;
            var confirmPassword = document.getElementById('confirm_password').value;

            if (newPassword !== confirmPassword) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Las nuevas contraseñas no coinciden.',
                    confirmButtonText: 'OK'
                });
                return false; // Evitar envío del formulario
            }

            // Puedes agregar más validaciones aquí según tus necesidades

            return true; // Permitir envío del formulario si todo está correcto
        }

        // Mostrar mensajes de éxito o error si existen en $_SESSION
        <?php
        if (isset($_SESSION['error_messages']) && !empty($_SESSION['error_messages'])) {
            echo "Swal.fire({
                icon: 'error',
                title: 'Error',
                html: '" . implode("<br>", $_SESSION['error_messages']) . "',
                confirmButtonText: 'OK'
            });";
            unset($_SESSION['error_messages']);
        }

        if (isset($_SESSION['success_message'])) {
            echo "Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: '" . $_SESSION['success_message'] . "',
                confirmButtonText: 'OK'
            });";
            unset($_SESSION['success_message']);
        }
        ?>
    </script>
</body>

</html>
