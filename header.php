
<header>
    <i class="fa fa-bars" aria-hidden="true" id="hambButton"></i>
    <a href="index.php"><img class="logo" src="images/logo.svg" alt="logo" /></a>

    <ul class="nav_links px-2 mt-3">
        <li class="li_header"><a href="index.php" class="pag_actual">Inicio</a></li>
        <li class="li_header"><a href="panaderia.php">Panadería</a></li>
        <li class="li_header"><a href="pasteleria.php">Pastelería</a></li>
        <li class="li_header"><a href="blog.php">Blog</a></li>
        <li class="li_header"><a href="contacto.php">Contacto</a></li>
    </ul>
    <ul class="nav_links px-2 mt-3">
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

                <div class="btn-group">
                    <div class="btn btn-primary"><?php echo $us . " " . $usuario; ?></div>
                    <div type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Desplegar menú</span>
                    </div>
                    <ul class="dropdown-menu" role="menu" style="background-color: rgb(246,246,246); border: 1px solid rgb(246,246,246)">
                        <?php
                        if ($rol == '1') {
                            ?>
                            <li><a href="userAdminPage.php">Panel de administrador</a></li>
                            <li><a href="logout.php" name="logout">Cerrar sesion</a></li>

                            <?php
                        } else if ($rol == '2') {
                            ?>
                            <li><a href="userStandarPage.php">Escritorio</a></li>
                            <li><a href="logout.php" name="logout">Cerrar sesion</a></li>   
                            <?php
                        }
                        ?>

                    </ul>
                </div>
                </a>
            <?php } else { ?>
                <a class="btn_login" href="login.php">
                    <i class="fa fa-user-circle" aria-hidden="true">
                    </i>
                </a>
            <?php } ?>
        </li>  
    </ul>
</header>

