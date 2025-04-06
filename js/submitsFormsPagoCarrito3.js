document.addEventListener('DOMContentLoaded', () => {
    const submitFormPagoCarrito2 = document.getElementById('btnRealizarPago');
    const addresForm = document.getElementById('direccion');

    submitFormPagoCarrito2.addEventListener('click', (event) => {
        console.log("Botón de realizar pago clickeado");
        if (addresForm.checkValidity()) {
            console.log("Formulario válido, enviando...");
            addresForm.submit();
        } else {
            console.log("Formulario no válido");
            Swal.fire({
                title: '¡Error!',
                text: 'Todos los datos son requeridos. Por favor, llena todos los campos.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            event.preventDefault();
        }
    });
});
