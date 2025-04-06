function togglePasswordVisibility(elementId) {
    const passwordField = document.getElementById(elementId);
    const icon = passwordField.nextElementSibling;
    if (passwordField.type === "password") {
        passwordField.type = "text";
        icon.textContent = "visibility_off";
    } else {
        passwordField.type = "password";
        icon.textContent = "visibility";
    }
}

// scripts.js

function validarFormulario() {
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
