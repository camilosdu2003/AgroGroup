<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil usuario</title>
    <link rel="stylesheet" href="../css/estilos_perfil_usuario.css">
    <link rel="stylesheet" href="../css/estilos_footer.css">
    <link rel="stylesheet" href="../css/estilos_header.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,300;0,400;0,800;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../js/location.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="icon" type="image/png" href="../img/logoIcon.jpeg">
</head>
<body>
    <!-- Header -->
    <?php
    include("./header.php");

    if (!isset($_SESSION['nombre'])) {
        header('Location: ./iniciar_sesion.php');
        exit();
    }

    include('../logica/usuarios/funciones.php');

    $id = $_SESSION['id'];
    $usuario = obtenerUnUsuario($id)[0];

    include('../logica/ciudadesDepartamentos/obtenerCiudadDepartamentoUsuario.php');
    $ciudadDepartamento = obtenerCiudadDepartamento($usuario['Ciudad'])[0];

    // mensaje de alerta 
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

    
    echo "<div class='contenedor'>
            <div class='perfil-recuadro'>
                <form action='../logica/registroUsuario/controlador.php' method='POST' id='formCambiarImagen' enctype='multipart/form-data'>
                    <input type='file' id='inputImagenPerfil' name='fotoPerfil'>
                    <input type='text' value='". $id ."' name='codUsuario'>
                </form>";
                if(empty($usuario['Foto'])){
                    echo "<img src='../img/perfil_usuario.png' alt='Foto de perfil'>";
                }else{
                    echo "<img src='../".$usuario['Foto']."' alt='Foto de perfil'>";
                }
                
           echo " </div>

            <form class='form' action='../logica/registroUsuario/controlador.php' method='POST'>";

                  if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
                    echo '<ul class="error-messages">';
                    foreach ($_SESSION['errors'] as $error) {
                        echo "<li>$error</li>";
                    }
                    echo '</ul>';
                    unset($_SESSION['errors']);
                    }
                    unset($_SESSION['form_data']); 

               echo " <label for='nombres'>Nombres:</label>
                <input class='input' type='text' id='nombres' name='nombres' value='".$usuario['Nombre']."' required>

                <label for='apellidos'>Apellidos:</label>
                <input class='input' type='text' id='apellidos' name='apellidos' value='".$usuario['Apellido']."' required>

                <label for='documento_id'>Documento de identidad:</label>
                <input class='input' type='text' id='documento_id' name='documento_id' value='".$usuario['Documento']."'readonly >

                <label for='numero_celular'>Numero de celular:</label>
                <input class='input' type='text' id='numero_celular' name='numero_celular' value='".$usuario['Telefono']."' required>

                <label for='correo'>Correo:</label>
                <input class='input' type='email' id='correo' name='correo' value='".$usuario['Email']."' required>

                <div class='input-department '>
                    <label for='departamento'>Departamento:</label>
                    <select id='departamento-select' name='departamento' required onclick='muestraSelect(this.value)'>
                        <option value='".$ciudadDepartamento['idDepartamento']."'>".$ciudadDepartamento['departamento']."</option>";
                        include '../logica/ciudadesDepartamentos/departamentos.php';
                   echo " </select>
                </div>

                <div class='input-city ' id='input-city'>
                    <label for='ciudad'>Ciudad:</label>         
                    <select  id='ciudad-select' name='ciudad' required >
                        <option id='optionCityValue' value='".$usuario['Ciudad']."'>".$ciudadDepartamento['ciudad']."</option>
                    </select>
                </div>
            

                <label for='direccion'>Dirección:</label>
                <input class='input' type='text' id='direccion' name='direccion' value='".$usuario['Direccion_de_Residencia']."' required>

                <p><a href='cambiar_contraseña.php'>¿Deseas cambiar tu contraseña?</a></p>

                <div class='buttons_content'>
                    <button class='btnupdate' type='submit' name='update'>Actualizar</button>
                </div>
                    
            </form>

                <form  class ='form' action='../logica/session/controlador_session.php' method='POST'>
                    <div class='buttons_content'>
                        <button class='btnlogout' type='submit' name='logout'>Cerrar Sesión</button>
                    </div>
                </form> 
        </div>";
    ?>
    <!-- footer -->
    <?php include("./footer.php"); ?>

    <script src="../js/changeProfilePicture.js"></script>
</body>
</html>
