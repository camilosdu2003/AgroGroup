let categoria = document.getElementById('selectCategories');
let formulario = document.getElementById('formCategories');


categoria.addEventListener('change', () => {
    let inputHidden = document.getElementById('inputCategories');
    inputHidden.value = categoria.value;

    formulario.submit();
})

