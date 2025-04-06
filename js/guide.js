const inputFile = document.getElementById('inputImg');
const inputNumber = document.querySelector('.input-number');
const submitButton = document.querySelector('.guia-submit');

function checkInputs() {
    if (inputFile.files.length > 0 || inputNumber.value) {
        submitButton.classList.add('guia-submit-active');
    } else {
        submitButton.classList.remove('guia-submit-active');
    }
}

// inputFile.addEventListener('change', checkInputs);
inputNumber.addEventListener('input', checkInputs);

document.addEventListener('DOMContentLoaded', function() {
    const copyButton = document.querySelector('.btn-copy');
    const inputText = document.getElementById('inputText');

    if (copyButton && inputText) {
        copyButton.addEventListener('click', (e) => {
            e.preventDefault();
            
            // Seleccionar el contenido del input
            inputText.select();
            inputText.setSelectionRange(0, 99999); // Para dispositivos móviles

            // Copiar el texto seleccionado al portapapeles
            document.execCommand('copy');

            // Notificación opcional
            Swal.fire({
                icon: 'success',
                title: 'Texto copiado',
                showConfirmButton: false,
                toast: true,
                position: 'bottom-end',
                timer: 2000, // Duración en milisegundos (2 segundos en este ejemplo)
                customClass: {
                    popup: 'copiar-toast',
                    title: 'copiar-toast-title'
                }
            });
        });
    }
});



function validateForm() {
    let valid = true;

    const inputNumber = document.getElementById('inputNumber');
    const inputImg = document.getElementById('inputImg');
    const numberError = document.getElementById('numberError');
    const imgError = document.getElementById('imgError');

    numberError.textContent = "";
    imgError.textContent = "";

    if (inputNumber.value.trim() === "") {
        numberError.textContent = "El número de guía no puede estar vacío.";
        valid = false;
    }

    if (inputImg.files.length === 0) {
        imgError.textContent = "Debe subir una imagen de la guía.";
        valid = false;
    } else {
        const file = inputImg.files[0];
        const validImageTypes = ['image/jpeg', 'image/png', 'image/gif'];

        if (!validImageTypes.includes(file.type)) {
            imgError.textContent = "El archivo debe ser una imagen (jpg, jpeg, png, gif).";
            valid = false;
        }
    }

    return valid;
}