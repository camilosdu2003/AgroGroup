const inputQuantity = document.getElementById('inputQuantity');
const price = document.getElementById('price');
const showPrice = document.getElementById('showPrice');
const priceHidden = document.getElementById('priceHidden');
// const codeHidden = document.getElementById('codeHidden')


//actualizar a valor maximo en el input de cantidad, en caso de que se supere el valor maximo permitido 
inputQuantity.addEventListener('keyup', function() {
    const max = parseInt(this.max);
    const min = parseInt(this.min);
    const value = parseInt(this.value);
    console.log(value)

    if (isNaN(value)) {
        this.value = ""; // Default to min if the input is not a number
    } else if (value > max) {
        this.value = max;
    } else if (value < min) {
        this.value = min;
    }
});


function formatNumberWithCommas(number) {
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

(function showPriceWhithCommas(){
    let price = showPrice.textContent;
    let priceWhithCommas = formatNumberWithCommas(price)
    showPrice.innerHTML ="$ "+ priceWhithCommas;
})(); 


inputQuantity.addEventListener('change', ()=>{
    let totalPrice = inputQuantity.value * price.value;

    let priceWhithCommas = formatNumberWithCommas(totalPrice)
    showPrice.innerHTML ="$ "+ priceWhithCommas;
    priceHidden.value = totalPrice;
    // codeHidden.value = inputQuantity.value
})



//mandar los dos formularios con un mismo boton:
const informationForm = document.getElementById('information_form');

const submitForms =document.getElementById('submit_forms');

submitForms.addEventListener('click', ()=>{
    const radios = document.getElementsByName('opcion');
            let selectedValue = null;

            for (const radio of radios) {
                if (radio.checked) {
                    selectedValue = radio.value;
                    break;
                }
            }

            if (selectedValue == 1) {
                informationForm.action = './datos_pago.php'
                if (informationForm.checkValidity()) {
                    informationForm.submit();
                } else {
                    Swal.fire({
                        title: '¡Error!',
                        text: 'Porfavor Completa todos los campos',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
                
            } else {
                if(selectedValue == 3){
                    informationForm.action = './datos_pago_paypal.php'
                    if (informationForm.checkValidity()) {
                        informationForm.submit();
                    } else {
                        Swal.fire({
                            title: '¡Error!',
                            text: 'Porfavor Completa todos los campos',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                }else{
                    informationForm.action = './datos_pago_Pse.php'
                    if (informationForm.checkValidity()) {
                        informationForm.submit();
                    } else {
                        Swal.fire({
                            title: '¡Error!',
                            text: 'Porfavor Completa todos los campos',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                }
            }
})

