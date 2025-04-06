//mandar el formulario datos_pago.php:
const submitDatosPago = document.getElementById('submitDatosPago');

const datosPagoForm  =document.getElementById('datosPagoForm');

submitDatosPago.addEventListener('click', ()=>{
    if (datosPagoForm.checkValidity()) {
        datosPagoForm.submit();
    } else {
        Swal.fire({
            title: '¡Error!',
            text: 'Todos los datos son requeridos, Porfavor llena todos los campos',
            icon: 'error',
            confirmButtonText: 'OK'
        });
    }
    
})