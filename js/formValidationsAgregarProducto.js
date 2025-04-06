document.getElementById('formulario').addEventListener('submit', function(event) {
    var inputArchivos = document.getElementById('inputImg');
    var mensajeError = document.getElementById('mensaje-error');
    if (inputArchivos.files.length < 1 || inputArchivos.files.length > 4 ) {
        mensajeError.textContent = 'Solo se permiten entre una o cuatro imagenes.';
        mensajeError.style.display = 'block';
        event.preventDefault(); // Evita que se envíe el formulario
        window.scrollTo(0,0)
    }
});