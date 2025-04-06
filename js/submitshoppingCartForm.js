//mandar el formulario para la creacion de un registro en carrito producto desde el archivo producto.php :
const submitDatosCarrito = document.getElementById('agregarCarrito');

const datosCarritoForm  =document.getElementById('formularioCarrito');

submitDatosCarrito.addEventListener('click', ()=>{
    datosCarritoForm.submit();
})




