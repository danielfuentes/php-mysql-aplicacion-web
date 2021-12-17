<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Daniel Fuentes</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Inicio</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Nosotros
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Historia</a></li>
                        <li><a class="dropdown-item" href="#">Misión</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Visión</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="servicios.php">Servicios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contacto.php">Contacto</a>
                </li>
                <?php  if(isset($_SESSION['nombre'])) : ?>
                    <?php if(intval($_SESSION['perfil']) === 9) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="administrar.php">Administrar</a>
                        </li>
                    <?php endif; ?>    
                <?php endif; ?>    
            </ul>
            <?php if(!isset($_SESSION['nombre'])) :?>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Iniciar sesión</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="registro.php">Registrarme</a>
                    </li>
                </ul>
            <?php else :?>    

                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="perfil.php">Perfil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Salir</a>
                    </li>
                    <li class="nav-item">
                        <img style="width: 50px; border-radius:50%" src="imagenes/<?= $_SESSION['avatar'];?>" alt="Avatar">       
                    </li>
                </ul>
            <?php endif; ?>    
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Buscar..." aria-label="Search">
                <button class="btn btn-outline-danger" type="submit">Buscar</button>
            </form>
        </div>
    </div>
</nav>