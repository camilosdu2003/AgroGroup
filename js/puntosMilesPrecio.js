function formatearNumero(numero) {
    // Convertir el número a string para poder manipularlo
    numero = numero.toString();
    
    // Separar la parte entera de la parte decimal (si existe)
    let partes = numero.split('.');
    let parteEntera = partes[0];
    let parteDecimal = partes.length > 1 ? partes[1] : null;
    
    // Contar la cantidad de dígitos en la parte entera
    let longitud = parteEntera.length; 
    
    // Inicializar un contador para controlar la inserción de las comas
    let contador = 0;
    
    // Crear una cadena para almacenar los caracteres del número formateado
    let numeroFormateado = '';
    
    // Recorrer los dígitos de la parte entera en orden inverso
    for (let i = longitud - 1; i >= 0; i--) {
        // Añadir el dígito al número formateado
        numeroFormateado = parteEntera[i] + numeroFormateado;
        
        // Incrementar el contador
        contador++;
        
        // Si el contador llega a 3 y no estamos en el último dígito,
        // añadir una coma y reiniciar el contador
        if (contador === 3 && i !== 0) {
            numeroFormateado = ',' + numeroFormateado;
            contador = 0;
        }
    }
    
    // Si hay parte decimal, añadirla al número formateado
    if (parteDecimal !== null) {
        numeroFormateado += '.' + parteDecimal;
    }
    
    return numeroFormateado;
}

function agregarSeparadorMiles(numero) {
    // Eliminar comas existentes
    numero = numero.replace(/,/g, '');
    // Eliminar caracteres no numéricos
    numero = numero.replace(/\D/g, '');
    // Formatear el número
    numero = formatearNumero(numero);
    return numero;
}
