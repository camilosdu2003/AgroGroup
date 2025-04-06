<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="../css/estilos_header.css">
    <link rel="stylesheet" href="../css/estilos_registrarse.css">
    <link rel="stylesheet" href="../css/estilos_selectores.css">
    <link rel="stylesheet" href="../css/estilos_footer.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,300;0,400;0,800;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/location.js"></script>
    <link rel="icon" type="image/png" href="../img/logoIcon.jpeg">
</head>
<body>
     
    <!-- Header -->
    <?php include("./header.php"); ?>

    <!-- Contenido -->
    <div id="login-container">
      <h2 id="titulo-registrarse">Registrar cuenta</h2>
      <form action="../logica/registroUsuario/controlador.php" method="POST" id="login-form">

        <!-- Contenedor para los mensajes de error -->
        <?php
        if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
          echo '<ul class="error-messages">';
          foreach ($_SESSION['errors'] as $error) {
            echo "<li>$error</li>";
          }
          echo '</ul>';
          unset($_SESSION['errors']);
        }
        $formData = $_SESSION['form_data'] ?? [];
        unset($_SESSION['form_data']);
        ?>

        <label for="nombres">Nombres:</label>
        <input class="input" type="text" id="nombres" name="nombres" value="<?= htmlspecialchars($formData['nombres'] ?? '') ?>" required>
    
        <label for="apellidos">Apellidos:</label>
        <input class="input" type="text" id="apellidos" name="apellidos" value="<?= htmlspecialchars($formData['apellidos'] ?? '') ?>" required>

        <!-- Campos ocultos para almacenar información de departamento y ciudad -->
        <input type="hidden" id="codigo_departamento" name="codigo_departamento">
        <input type="hidden" id="nombre_departamento" name="nombre_departamento">
        <input type="hidden" id="codigo_ciudad" name="codigo_ciudad">
        <input type="hidden" id="nombre_ciudad" name="nombre_ciudad">

        <label for="docid">Documento de identidad:</label>
        <input class="input" type="text" id="docid" name="documentoIdentidad" value="<?= htmlspecialchars($formData['documentoIdentidad'] ?? '') ?>" required>

        <label for="address">Direccion:</label>
        <input class="input" type="text" id="address" name="direccion" value="<?= htmlspecialchars($formData['direccion'] ?? '') ?>" required>

        <div class="input-department">
          <label for="departamento">Departamento:</label>
          <select id="departamento-select" name="departamento" required onclick="muestraSelect(this.value)">
            <option value="">Seleccionar departamento</option>
            <?php include "../logica/ciudadesDepartamentos/departamentos.php" ?>
          </select>
        </div>

        <div class="input-city" id="input-city">
          <label for="ciudad">Ciudad:</label>         
          <select id="ciudad-select" name="ciudad" required>
            <option id="optionCityValue" value=""></option>
          </select>
        </div>

        <label for="correo">Correo electrónico:</label>
        <input class="input" type="email" id="correo" name="correo" value="<?= htmlspecialchars($formData['correo'] ?? '') ?>" required>

        <label for="celular">Número de celular:</label>
        <input class="input" type="text" id="celular" name="celular" value="<?= htmlspecialchars($formData['celular'] ?? '') ?>" required>

        <label for="password">Contraseña:</label>
        <input class="input" type="password" id="password" name="contraseña" required>

        <div class="terms">
          <input type="checkbox" name="terms" id="terms" required> 
          <label for="terms"> Estoy de acuerdo con los </label>  
          <a href="./terminos_condiciones.php" target="_blank" class="enlace-terminos"> términos y condiciones</a> 
        </div>

        <button type="submit" name="crearUsuario">Registrarse</button>
      </form>

    </div>

    <!-- Footer -->
    <?php include("./footer.php"); ?>

</body>
</html>
