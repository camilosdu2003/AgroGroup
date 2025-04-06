//mandar el formulario desde pago_carrito2 que manda la direccion y el metodo de pago para realizar la compra
const submitFormPagoCarrito2 = document.getElementById('btnRealizarPago');

const methodPayForm  = document.getElementById('pay-method');

const addresForm  = document.getElementById('direccion');

submitFormPagoCarrito2.addEventListener('click', ()=>{
    const radios = document.getElementsByName('opcion');
            let selectedValue = null;

            for (const radio of radios) {
                if (radio.checked) {
                    selectedValue = radio.value;
                    break;
                }
            }

            if (selectedValue == 1) {
                addresForm.action = './pago_carrito2_tarjeta.php'
                if (addresForm.checkValidity()) {
                    addresForm.submit();
                } else {
                    Swal.fire({
                        title: '¡Error!',
                        text: 'Todos los datos son requeridos, Porfavor llena todos los campos',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            } else {
                if(selectedValue == 3){
                    addresForm.action = './pago_carrito2_paypal.php'
                    if (addresForm.checkValidity()) {
                        addresForm.submit();
                    } else {
                        Swal.fire({
                            title: '¡Error!',
                            text: 'Todos los datos son requeridos, Porfavor llena todos los campos',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                }else{
                    addresForm.action = './pago_carrito2_Pse.php'
                    if (addresForm.checkValidity()) {
                        addresForm.submit();
                    } else {
                        Swal.fire({
                            title: '¡Error!',
                            text: 'Todos los datos son requeridos, Porfavor llena todos los campos',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                }
            }
})