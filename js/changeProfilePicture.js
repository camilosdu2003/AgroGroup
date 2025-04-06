const inputImagenPerfil = document.getElementById('inputImagenPerfil');
const img = document.querySelector('.perfil-recuadro');
const formCambiarImagen = document.getElementById('formCambiarImagen');

img.addEventListener('click',()=>{
    inputImagenPerfil.click();
})


inputImagenPerfil.addEventListener('change', () => {
    // Verificar si se seleccionó un archivo
    if (inputImagenPerfil.files.length > 0) {
        formCambiarImagen.submit();
    } else {
        // Si no se selecciona un archivo, mostrar un mensaje o realizar otra acción
        console.log('No se seleccionó ningún archivo');
    }
});