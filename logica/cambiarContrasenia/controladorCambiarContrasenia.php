<?php
session_start();
include_once('../conexionBd.php');
include_once('./funcionesCambiarContrasenia.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    $errors = [];

    // Validar que las nuevas contraseñas coincidan
    if ($newPassword !== $confirmPassword) {
        $errors[] = "Las nuevas contraseñas no coinciden.";
    }

    // Obtener la contraseña actual del usuario desde la base de datos
    $usuario = obtenerUsuarioPorDocumento($_SESSION['id']);

    // Verificar que la contraseña actual sea correcta
    if (!password_verify($currentPassword, $usuario['Contrasenia'])) {
        $errors[] = "La contraseña actual es incorrecta.";
    }

    if (empty($errors)) {
        // Actualizar la contraseña en la base de datos
        if (cambiarContraseña($_SESSION['id'], $newPassword)) {
            $_SESSION['success_message'] = "Contraseña actualizada correctamente.";
        } else {
            $errors[] = "Error al actualizar la contraseña.";
        }
    }

    // Almacenar errores en $_SESSION si existen
    if (!empty($errors)) {
        $_SESSION['error_messages'] = $errors;
    }

    // No redirigir explícitamente, manejar en la página cambiar_contrasenia.php
    header("Location: ../../html/Cambiar_Contraseña.php");
    exit();
}
?>
