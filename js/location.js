function muestraSelect(str){
    var conexion;

    if(str===""){
        document.getElementById('optionCityValue').innerHTML="Seleciona una ciudad";
        return;
    }

    if(window.XMLHttpRequest){
        conexion = new XMLHttpRequest();
    }
    conexion.onreadystatechange = function(){
        if(conexion.readyState == 4 && conexion.status==200){
            document.getElementById('input-city').innerHTML=conexion.responseText;
        }
    }

    conexion.open('GET', '../logica/ciudadesDepartamentos/ciudades.php?c='+str, true);
    conexion.send();
}