<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GuÍa</title>
    <link rel="stylesheet" href="../css/estilos_numero_guia.css">
    <link rel="stylesheet" href="../css/estilos_footer.css">    
    <link rel="stylesheet" href="../css/estilos_header.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="icon" type="image/png" href="../img/logoIcon.jpeg">
</head>
<body>
    
<!-- header -->
<?php
include("./header.php");
// include("../logica/conexionBd.php"); // Incluye tu archivo de conexión a la base de datos
include("../logica/guia/funcionesGuia.php");

if (!isset($_SESSION['id'])) {
    header('Location: ./iniciar_sesion.php');
    exit();
}

if(isset($_SESSION['msjAlerta'])){
    $msj = $_SESSION['msjAlerta'] ?>
    <script>
        Swal.fire({
            title: "<?php echo $msj ?>",
            icon: "success"
        });
    </script>

    <?php
        unset($_SESSION['msjAlerta']);
}

$idUsuario = $_SESSION['id']; // ID del usuario desde la sesión
// $permitir_ingreso = false; // Variable para permitir editar el input
$codigoVenta = $_GET['codigoVenta'];

// Abrir la conexión
// abrirConexion();

// if ($conexion) {
 
//     $sql_codigo = "SELECT Codigo FROM tbl_venta WHERE vendedor = ?"; 
//     $stmt_codigo = $conexion->prepare($sql_codigo);
//     $stmt_codigo->bind_param("i", $id_del_usuario);
//     $stmt_codigo->execute();
//     $result_codigo = $stmt_codigo->get_result();

//     if ($result_codigo->num_rows > 0) {
//         $row_codigo = $result_codigo->fetch_assoc();
//         $codigo = $row_codigo['Codigo'];


//         $sql_venta = "SELECT Codigo, Vendedor, empresa_transportadora FROM tbl_venta WHERE Codigo = ?";
//         $stmt_venta = $conexion->prepare($sql_venta);
//         $stmt_venta->bind_param("s", $codigo);
//         $stmt_venta->execute();
//         $result_venta = $stmt_venta->get_result();

//         if ($result_venta->num_rows > 0) {
//             $row_venta = $result_venta->fetch_assoc();
//             $id_venta = $row_venta['Codigo'];
//             $id_vendedor = $row_venta['Vendedor'];
//             $empresa_transportadora = $row_venta['empresa_transportadora'];

            
//             if ($id_del_usuario == $id_vendedor) {
//                 $permitir_ingreso = true;
//             }
//         }

//         $stmt_venta->close();
//     }

//     $stmt_codigo->close();
// } else {
//     echo "Error: No hay conexión a la base de datos.";
// }

// // Cerrar la conexión
// cerrarConexion();
// 
$validarPermiso = false;
$consultarVenta = validarVendedorCliente($idUsuario, $codigoVenta);
if($consultarVenta[0]['Vendedor'] == $idUsuario){
    $permitir_ingreso = true;
}else{
    $permitir_ingreso = false;
}
?>

<!-- contenido -->
<div class="main-container">
    <div class="img-container">
        <?php if ($permitir_ingreso): ?>
            <?php if(empty($consultarVenta[0]['Imagen_Guia'])){
                    echo"<img src='../img/fotosGuias/imgDefecto2.png' alt='img-guia'>";
                }else{
                    echo "<img src='../".$consultarVenta[0]['Imagen_Guia']."' alt='img-guia'>";
                } 
            ?>
            <!-- <img src="../img/fotosGuias/imgDefecto2.png" alt="img-guia"> -->
        <?php else:
            if(empty($consultarVenta[0]['Imagen_Guia'])){ 

               echo "<img src='../img/fotosGuias/imgDefecto.png' alt='img-guia'>";
            }else{
                echo "<img src='../".$consultarVenta[0]['Imagen_Guia']."' alt='img-guia'>";
            }

        ?>
            
        <?php endif; ?>
        
    </div>

    <div class="info-container">
    <form class="guide-number" action="../logica/guia/controladorGuia.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()"> 
    <div class="guia-left">
        <?php if ($permitir_ingreso): ?>
            <label class="label" for="inputImg">Subir imagen de la guía</label>
            <input type="text" value="<?php echo $codigoVenta ?>" name="codigoVenta" hidden>
            <input type="file" hidden id='inputImg' name="fotoGuia">
            <p id="imgError" style="color: red;"></p>
        <?php endif; ?>    

        <h1 class="guia-tittle">Numero de Guía</h1>

        <?php if ($permitir_ingreso): ?>
            <?php if(empty($consultarVenta[0]['numero_guia'])){
                    echo "<input type='number' class='input-number' placeholder='Ingrese numero de guía' name='numeroGuia' id='inputNumber'>";
                }else{
                    echo "<input type='number' class='input-number' value='".$consultarVenta[0]['numero_guia']."' name='numeroGuia' id='inputNumber'>";
                } 
            ?>
            <p id="numberError" style="color: red;"></p>
        <?php else: 
            if(empty($consultarVenta[0]['numero_guia'])){
                echo "<p>Aun no hay número de guía asignado</p>";
            }else{
                echo "<input id='inputText' class='input-number' value='".$consultarVenta[0]['numero_guia']."'>";
            }
        ?>
        <?php endif; ?>
        </div>

        <?php if ($permitir_ingreso): ?>
            <div class="guia-right">
                <input class="guia-submit" type="submit" value="Guardar">
            </div>
        <?php else: 
            if(!empty($consultarVenta[0]['numero_guia'])){
                echo "<button type='button' class='btn-copy'>Copiar</button>";
            }    
        ?>
        <?php endif; ?>
    </form>


        <div class="info-company">
            <h1 class="company-tittle">Empresa transportadora</h1>                        
            <select id="empresa" name="frutas">
                <option value="fedex">Fedex</option>
                <option value="interrapidisimo">Interrapidisimo</option>
                <option value="envia">Envia</option>
                <option value="servientrega">Servientrega</option>
            </select>   
        </div>

        <div class="info-shipment">
            <h1>Consultar envio</h1>
            <a id="enlace_envio" class="link-shipment" href="#">Enlace de la empresa seleccionada</a>
        </div>
    </div>
</div>

<!-- footer -->
<?php
include("./footer.php");
?>
<script src="../js/guide.js"></script>
<script>
    document.getElementById("empresa").addEventListener("change", function() {
        var enlace = document.getElementById("enlace_envio");
        var empresaSeleccionada = this.value;
        switch (empresaSeleccionada) {
            case "interrapidisimo":
                enlace.href = "https://interrapidisimo.com";
                break;
            case "servientrega":
                enlace.href = "https://www.servientrega.com/wps/portal/!ut/p/z1/04_Sj9CPykssy0xPLMnMz0vMAfIjo8ziTS08TTwMTAz93f1cTAwCg5yMfP0MHY0cfY30wwkpiAJKG-AAjgb6XoQUAF1gVOTr7JuuH1WQWJKhm5mXlq8f4Zyfk5-blJmoH1GQWlQMdGqxfkRmXmZyZj7QRVGEzCzIjajycbL0BACT8ktL/dz/d5/L2dBISEvZ0FBIS9nQSEh/";
                break;
            case "envia":
                enlace.href = "https://envia.co";
                break;
            case "fedex":
                enlace.href = "https://www.fedex.com/es-co/home.html";
                break;
            default:
                enlace.href = "#"; // Enlace predeterminado en caso de opción no reconocida
        }
    });
</script>
</body>
</html>
