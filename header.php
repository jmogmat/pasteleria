
<header>
    <nav class="navbar navbar-expand-lg navbar-light">
        <a href="index.php"><img class="logo" src="images/logo.svg" alt="logo" /></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Inicio<span class="sr-only"></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="panaderia.php">Panadería</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pasteleria.php">Pastelería</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Categorías
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="productsWithoutGluten.php">Productos sin gluten</a>
                        <a class="dropdown-item" href="productsWithGluten.php">Productos con gluten</a>                     
                    </div>                   
                </li>  
                <li class="nav-item"><a class="nav-link" href="blog.php" class="pag_actual">Blog</a></li>
                <li class="nav-item"><a class="nav-link" href="contacto.php" class="pag_actual">Contacto</a></li>
            </ul>
            <a class="nav-link" style="color: gray; cursor:pointer; font-size: 22px;"><i class="fas fa-shopping-cart"></i>
        </div>
    </nav>

    <ul class="navbar-nav" style="margin-right: 1%">
        <li class="li_header">
            <?php
            $page = "";
            $rol = "";
            $us = "";
            $nombre = "";
            $apellido = "";

            if (isset($_SESSION['rol']) && $_SESSION['rol'] != '3') {

                $user = json_decode($_SESSION['usuario']);

                foreach ($user as $key => $v) {

                    if ($key == 'nombre') {

                        $nombre = $v;
                    }
                    if ($key == 'apellido') {

                        $apellido = $v;
                    }

                    if ($key == 'rol') {

                        $rol = $v;
                    }

                    $usuario = $nombre . " " . $apellido;
                }

                if ($rol == '1') {
                    $us = 'Administrador';
                } if ($rol == '2') {
                    $us = 'Usuario';
                }
                ?>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: gray; font-size: 17px">
                    <?php echo $us . " " . $usuario; ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <?php
                    if ($rol == '1') {
                        ?>
                        <a class="dropdown-item" href="userAdminPage.php">Panel de administrador</a>
                        <a class="dropdown-item" href="logout.php" name="logout">Cerrar sesion</a>

                        <?php
                    } else if ($rol == '2') {
                        ?>
                        <a class="dropdown-item" href="userStandarPage.php">Escritorio</a>
                        <a class="dropdown-item" href="logout.php" name="logout">Cerrar sesion</a>  
                        <?php
                    }
                    ?>  
                </div>
            </li>  
        </ul>

    <?php } else { ?>

        <a class="btn_login" href="login.php"  style="color: gray; cursor:pointer; font-size: 32px">
            <i class="fa fa-user-circle" aria-hidden="true"></i>
        </a>
    <?php } ?>
</li>  
</ul>
</header>

