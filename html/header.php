
<header class="header__container">
  <div class="header">
    <button class="menu-toggle">
        <span class="material-symbols-outlined">menu</span>
    </button>

    <div class="header__logo">
      <a href="index.php"><img class="img__logo" src="../img/logo.png" alt="logo de agrogroup"></a>
    </div>

    <div class="header__search">
      <form class="formSearch" action="./producto_buscado.php" method="GET">
        <input type="search" name="busqueda" placeholder="Buscar..." class="search">
        <input type="submit" class="bnt-search">
        
        <select name="ordenar" class="search__sort">
          <option value="sinOrdenar">Ordenar por precio</option>
          <option value="mayorMenor">De menor a mayor</option>
          <option value="menorMayor">De mayor a menor</option>
        </select>
      </form>
    </div>

    <div class="header__cart">
      <a href="carrito.php">
        <span class="material-symbols-outlined shopping_cart">
          shopping_cart_checkout
        </span>
      </a>
    </div>
    
    <?php
    session_start();
    if (isset($_SESSION['nombre'])) {
      echo "<div class='header__account'>
              <a href='perfil_usuario.php'>
                <span class='material-symbols-outlined acount-icon'>
                  account_circle
                </span>
              </a>
            </div>";
    } else {
      echo "<div class='header__account'>
              <a href='iniciar_sesion.php' class='account__login'>Iniciar sesión</a>
              <a href='registrarse.php' class='account__signup'>Registrarse</a>
            </div>";
    }
    ?>
  </div>

  <nav class="nav">
    <ul class="nav__list">
      <li class="element__list">
        <select id="selectCategories" class="categories__element">
          <option value="9">Seleccione una categoria</option>
          <option value="8">Maquinaria y equipos agrícolas</option>
          <option value="9">Insumos y productos químicos</option>
          <option value="10">Infraestructura y manejo del entorno</option>
          <option value="11">Alimentación animal y accesorios</option>
          <option value="12">Tecnología y monitoreo</option>
          <option value="13">Otros</option>
        </select>
      </li>

      <form id="formCategories" action="./categoria.php" method="GET">
        <input id="inputCategories" name="categoria" type="hidden" value="">
      </form>

      <li class="element__list add_product"><a href="agregar_producto.php">Vender producto</a></li>
      <li class="element__list my_products"><a href="mis_productos.php">Mis productos</a></li>
      <li class="element__list my_orders"><a href="mis_pedidos.php">Mis pedidos</a></li>
    </ul>
  </nav>
</header>
<script src="../js/menuToggle.js"></script> <!-- Asegúrate de enlazar tu JS -->
<script src="../js/submitFormCategories.js"></script>

