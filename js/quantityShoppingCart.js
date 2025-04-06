document.addEventListener('DOMContentLoaded', function() {
    const quantityInputs = document.querySelectorAll('.quantity');

    function formatNumberWithCommas(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

     (function showPriceWhithCommas(){
            const totalvalue = document.querySelector('.total-value') 
            let price = totalvalue.textContent;
            let priceWhithCommas = formatNumberWithCommas(price)
            totalvalue.innerHTML ="$ "+ priceWhithCommas;
    })();


    let index = 0;

    quantityInputs.forEach(input => {

        const totalPriceElement = document.getElementById('showPrice1_' + index);
        valor = totalPriceElement.textContent
        let totalPriceWithCommas = formatNumberWithCommas(valor);
        totalPriceElement.textContent = '$ ' + totalPriceWithCommas;

        index++;


         

        // Verificación del valor máximo al escribir manualmente
        input.addEventListener('input', function() {
            const max = parseInt(this.max);
            const min = parseInt(this.min);
            const value = parseInt(this.value);

            if (isNaN(value)) {
                this.value = ""; // Default to min if the input is not a number
            } else if (value > max) {
                this.value = max;
            } else if (value < min) {
                this.value = min;
            }
        });

        // function formatNumberWithCommas(number) {
        //     return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        // }

    //    const Products = document.querySelectorAll('.product')
    //     let cont = 0;
    //     for(let i =0 ; i < quantityProducts; i++){
    //         console.log(cont)
    //         cont ++
    //     }
       
        // (function showPriceWhithCommas(){
        //     let price = totalPriceElement.textContent;
        //     let priceWhithCommas = formatNumberWithCommas(price)
        //     totalPriceElement.innerHTML ="$ "+ priceWhithCommas;
        // })();
        
        // Cálculo del valor según la cantidad
        input.addEventListener('change', function() {
            const index = this.dataset.index;
            const quantity = parseInt(this.value);
            const price = parseFloat(document.getElementById('price_' + index).value);
            const itemPriceEdit = document.getElementById('item_price_edit_' + index);
            const itemQuantityEdit = document.getElementById('item_quantity_edit_' + index);
            const totalPriceElement = document.getElementById('showPrice1_' + index);
            const totalPriceElementHidden = document.getElementById('showPrice_' + index);

            const newTotalPrice = price * quantity;
            totalPriceElementHidden.textContent = '$ ' +newTotalPrice
            let totalPriceWithCommas = formatNumberWithCommas(newTotalPrice)
            // Actualizar en pantalla el precio del producto según la cantidad 
            totalPriceElement.textContent = '$ ' + totalPriceWithCommas;

            // Actualizar el formulario que envía los datos para actualizar la cantidad y precio en la tabla Productos_Carrito de la DB
            itemPriceEdit.value = newTotalPrice;
            itemQuantityEdit.value = quantity;

            updateTotalCartValue();
        });
    });

    // Actualizar en pantalla el precio total del valor según la cantidad
    function updateTotalCartValue() {
        let totalCartValue = 0;

        const totalPrices = document.querySelectorAll('.total-price1');
        totalPrices.forEach(priceElement => {
            const price = parseFloat(priceElement.textContent.replace('$', '').trim());
            totalCartValue += price;
        });
         let totalValueWithCommas = formatNumberWithCommas(totalCartValue)
        document.querySelector('.total-value').textContent = 'Valor Total: $ ' + totalValueWithCommas;
    }
});


// Envío de formulario para eliminar producto del carrito
function deleteItem(itemId){
    // if(confirm('¿Estás seguro de que deseas borrar este artículo?')){
    //     document.getElementById('item_id').value = itemId;
    //     document.getElementById('deleteItemForm').submit();
    // }
    Swal.fire({
        title: 'Atencion',
        text: "¿Eliminar producto del carrito?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, bórralo!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('item_id').value = itemId;
            document.getElementById('deleteItemForm').submit();
        }
    });
}

// Envío de formulario para actualizar los datos de productos_carrito de la DB
const submitDatos = document.getElementById('btnBuyProduct');
const updateForm = document.getElementById('updateForm');

submitDatos.addEventListener('click', () => {
    if (updateForm.checkValidity()) {
        updateForm.submit();
    } else {
        Swal.fire({
            title: '¡Error!',
            text: 'Porfavor Selecciona la cantidad',
            icon: 'error',
            confirmButtonText: 'OK'
        });
    }
    
});



