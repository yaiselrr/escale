<?php
include("administrador_escale/bd.php");

// $sentencia = $conexion->prepare("Select * from tbl_carrusel limit 1");

$sentencia = $conexion->prepare("SELECT * FROM `tbl_carrusel`");
$sentencia->execute();

$resultadoBanners = $sentencia->fetchAll(PDO::FETCH_ASSOC);


$sentencia = $conexion->prepare("SELECT * FROM `tbl_miembros` ORDER BY id ASC");
$sentencia->execute();

$resultadoMiembros = $sentencia->fetchAll(PDO::FETCH_ASSOC);

$sentencia = $conexion->prepare("SELECT * FROM `tbl_alojamiento` ORDER BY id ASC");
$sentencia->execute();

$resultadoAlojamiento = $sentencia->fetchAll(PDO::FETCH_ASSOC);


$sentencia = $conexion->prepare("SELECT * FROM `tbl_confecciones` ORDER BY id ASC");
$sentencia->execute();

$resultadoConfecciones = $sentencia->fetchAll(PDO::FETCH_ASSOC);


$sentencia = $conexion->prepare("SELECT * FROM `tbl_eventos` ORDER BY id ASC");
$sentencia->execute();

$resultadoEventos = $sentencia->fetchAll(PDO::FETCH_ASSOC);


$sentencia = $conexion->prepare("SELECT * FROM `tbl_excursiones` ORDER BY id ASC");
$sentencia->execute();

$resultadoExcursiones = $sentencia->fetchAll(PDO::FETCH_ASSOC);


$sentencia = $conexion->prepare("SELECT * FROM `tbl_mantenimiento` ORDER BY id ASC");
$sentencia->execute();

$resultadoMantenimientos = $sentencia->fetchAll(PDO::FETCH_ASSOC);


$sentencia = $conexion->prepare("SELECT * FROM `tbl_transportacion` ORDER BY id ASC");
$sentencia->execute();

$resultadoTransportacion = $sentencia->fetchAll(PDO::FETCH_ASSOC);


$sentencia = $conexion->prepare("SELECT * FROM `tbl_servicios_complementarios` ORDER BY id ASC");
$sentencia->execute();

$resultadoServicios = $sentencia->fetchAll(PDO::FETCH_ASSOC);

// Envio de formulario contacto
if ($_POST) {
    $nombre = filter_var($_POST["nombre"], FILTER_SANITIZE_STRING);
    $correo = filter_var($_POST["correo"], FILTER_VALIDATE_EMAIL);
    $mensaje = filter_var($_POST["mensaje"], FILTER_SANITIZE_STRING);

    if ($nombre && $correo && $mensaje) {
        $sql =  "INSERT INTO tbl_comentarios (nombre, correo, mensaje) VALUES (:nombre, :correo, :mensaje);";

        $resultadoComentario = $conexion->prepare($sql);
        $resultadoComentario->bindParam(":nombre", $nombre, PDO::PARAM_STR);
        $resultadoComentario->bindParam(":correo", $correo, PDO::PARAM_STR);
        $resultadoComentario->bindParam(":mensaje", $mensaje, PDO::PARAM_STR);
        $resultadoComentario->execute();
    }
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ESCALE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <!-- <link rel="stylesheet" href="style.css"> -->
</head>

<body>
    <!-- barra de navegacion -->
    <nav class="navbar navbar-expand-lg bg-dark border-bottom border-body fixed-top" data-bs-theme="dark">
        <div class="container">
            <a class="navbar-brand" href="#">ESCALE</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-start" aria-controls="navbar-start" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar-start">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#qsomos">Quienes Somos</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Servicios
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#alojamiento"><i class="bi bi-houses-fill"></i> Alojamiento</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#servicios"><i class="bi bi-collection-fill"></i> Servicios complementarios</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#transportacion"><i class="bi bi-car-front-fill"></i> Transportación</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#eventos"><i class="bi bi-person-walking"></i> Eventos</a></li>
                            <li><a class="dropdown-item" href="#excursiones"><i class="bi bi-person-walking"></i> Excursiones</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#confecciones"><i class="bi bi-scissors"></i> Confecciones textiles</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#eventos"><i class="bi bi-calendar-event-fill"></i> Organización de eventos</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#mantenimientos"><i class="bi bi-tools"></i> Mantenimiento constructivo ligero a embajadas</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#enlaces">Enlaces</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contacto">Contacto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#testimonios">Testimonios</a>
                    </li>
                </ul>
                <!-- <form class="d-flex" role="search">
              <input class="form-control ms-2" type="search" placeholder="Buscar" aria-label="Buscar">
              <button class="btn btn-outline-success" type="submit">Buscar</button>
            </form> -->
            </div>
        </div>
    </nav>

    <div>
        <?php print_r($_POST); ?>
    </div>

    <!-- banner slider -->
    <section class="container-fluid p-0">
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 4"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="2000">
                    <img src="images/carrusel/<?php echo $resultadoBanners[0]['foto']; ?>" class="d-block w-100" alt="..." style="height: 700px;">
                    <div class="carousel-caption d-none d-md-block">
                        <h1><?php echo $resultadoBanners[0]['titulo']; ?></h1>
                        <p><?php echo $resultadoBanners[0]['descripcion']; ?></p>
                        <a href="<?php echo $resultadoBanners[0]['enlace']; ?>" class="btn btn-primary">Ir al artículo</a>
                    </div>
                </div>
                <div class="carousel-item" data-bs-interval="2000">
                    <img src="images/carrusel/<?php echo $resultadoBanners[1]['foto']; ?>" class="d-block w-100" alt="..." style="height: 700px;">
                    <div class="carousel-caption d-none d-md-block">
                        <h1><?php echo $resultadoBanners[1]['titulo']; ?></h1>
                        <p><?php echo $resultadoBanners[1]['descripcion']; ?></p>
                        <a href="<?php echo $resultadoBanners[1]['enlace']; ?>" class="btn btn-primary">Ir al artículo</a>
                    </div>
                </div>
                <div class="carousel-item" data-bs-interval="2000">
                    <img src="images/carrusel/<?php echo $resultadoBanners[2]['foto']; ?>" class="d-block w-100" alt="..." style="height: 700px;">
                    <div class="carousel-caption d-none d-md-block">
                        <h1><?php echo $resultadoBanners[2]['titulo']; ?></h1>
                        <p><?php echo $resultadoBanners[2]['descripcion']; ?></p>
                        <a href="<?php echo $resultadoBanners[2]['enlace']; ?>" class="btn btn-primary">Ir al artículo</a>
                    </div>
                </div>
                <div class="carousel-item" data-bs-interval="2000">
                    <img src="images/carrusel/<?php echo $resultadoBanners[3]['foto']; ?>" class="d-block w-100" alt="..." style="height: 700px;">
                    <div class="carousel-caption d-none d-md-block">
                        <h1><?php echo $resultadoBanners[3]['titulo']; ?></h1>
                        <p><?php echo $resultadoBanners[3]['descripcion']; ?></p>
                        <a href="<?php echo $resultadoBanners[3]['enlace']; ?>" class="btn btn-primary">Ir al artículo</a>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>

    <!-- mensaje -->
    <section id="" class="container mt-4 text-center">
        <div class="jumbotron bg-dark text-white">
            </br>
            <h2>Bienvenid@ al confort de ESCALE</h2>
            <p>
                Descubre una experiencia única.
            </p>
            </br>
        </div>

    </section>

    <!-- equipo -->
    <section id="miembros" class="container mt-5 text-center">
        <h2>Miembros de ESCALE</h2>

        <div class="row">
            <?php foreach ($resultadoMiembros as $miembro) { ?>
                <div class="col-md-3">
                    <div class="card">
                        <img src="images/miembros/<?php echo $miembro["foto"] ?>" alt="Miembro 1" class="card-img-top" style="height: 100%; width: 100%; object-fit: cover;" />
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $miembro["titulo"] ?></h5>
                            <p class="card-text"> <?php echo $miembro["descripcion"] ?></p>
                            <div class="social-icons mt-3">
                                <a href="<?php echo $miembro["linkfacebook"] ?>" class="text-dark me-2"><i class="bi bi-facebook"></i></a>
                                <a href="<?php echo $miembro["linkinstagram"] ?>" class="text-dark me-2"><i class="bi bi-instagram"></i></a>
                                <a href="<?php echo $miembro["linklinkedin"] ?>" class="text-dark me-2"><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>

                    </div>

                </div>
            <?php } ?>
        </div>

    </section>

    <!-- testimonios -->
    <!-- <section id="testimonios" class="bg-light py-5">
        <div class="container">
            <h2 class="text-center mb-4"> Testimonios</h2>
            <div class="row">
                <div class="col-md-6 d-flex">
                    <div class="card mb-4 w-100">
                        <div class="card-body">
                            <p class="card-text">
                                Muy buen servicio
                            </p>
                            <div class="card-footer text-muted">
                                Juan PP
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 d-flex">
                    <div class="card mb-4 w-100">
                        <div class="card-body">
                            <p class="card-text">
                                Muy buen servicio
                            </p>
                            <div class="card-footer text-muted">
                                Juan PP
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section> -->

    <!-- Alojamiento -->
    <section class="container mt-5" id="alojamiento">
        <h2 class="text-center">Alojamiento</h2>
        <br />
        <div class="row row-cols-1 row-cols-md-4 g-4">
            <?php foreach ($resultadoAlojamiento as $alojameinto) { ?>
                <div class="col d-flex">
                    <div class="card">
                        <img src="images/alojamiento/<?php echo $alojameinto["foto"] ?>" alt="Habitacion" class="card-img-top" style="height: 100%; width: 100%; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title"> <?php echo $alojameinto["nombre"] ?></h5>
                            <p class="card-text small"><strong> Descrpción:</strong><?php echo $alojameinto["descripcion"] ?></p>
                            <p class="card-text"> <strong> Precio:</strong> $<?php echo $alojameinto["precio"] ?> por noche</p>
                            <a href="#" class="btn btn-dark">Ver más ...</a>
                        </div>
                    </div>

                </div>
            <?php } ?>
        </div>
    </section>

    <!-- Confecciones textiles -->
    <section class="container mt-5" id="confecciones">
        <h2 class="text-center">Confecciones textiles</h2>
        <br />
        <div class="row row-cols-1 row-cols-md-4 g-4">
            <?php foreach ($resultadoConfecciones as $confeccion) { ?>
                <div class="col d-flex">
                    <div class="card">
                        <img src="images/confecciones-textiles/<?php echo $confeccion["foto"] ?>" alt="Confección" class="card-img-top" style="height: 100%; width: 100%; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title"> <?php echo $confeccion["nombre"] ?></h5>
                            <p class="card-text small"><strong> Descrpción:</strong><?php echo $confeccion["descripcion"] ?></p>
                            <p class="card-text"> <strong> Precio:</strong> $<?php echo $confeccion["precio"] ?></p>
                            <a href="#" class="btn btn-dark">Ver más ...</a>
                        </div>
                    </div>

                </div>
            <?php } ?>
        </div>
    </section>

    <!-- Eventos -->
    <section class="container mt-5" id="eventos">
        <h2 class="text-center">Eventos</h2>
        <br />
        <div class="row row-cols-1 row-cols-md-4 g-4">
            <?php foreach ($resultadoEventos as $evento) { ?>
                <div class="col d-flex">
                    <div class="card">
                        <img src="images/eventos/<?php echo $evento["foto"] ?>" alt="Evento" class="card-img-top" style="height: 100%; width: 100%; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title"> <?php echo $evento["nombre"] ?></h5>
                            <p class="card-text small"><strong> Descrpción:</strong><?php echo $evento["descripcion"] ?></p>
                            <p class="card-text"> <strong> Precio:</strong> $<?php echo $evento["precio"] ?></p>
                            <a href="#" class="btn btn-dark">Ver más ...</a>
                        </div>
                    </div>

                </div>
            <?php } ?>
        </div>
    </section>

    <!-- Excursiones -->
    <section class="container mt-5" id="excursiones">
        <h2 class="text-center">Excursiones</h2>
        <br />
        <div class="row row-cols-1 row-cols-md-4 g-4">
            <?php foreach ($resultadoExcursiones as $excursion) { ?>
                <div class="col d-flex">
                    <div class="card">
                        <img src="images/excursiones/<?php echo $excursion["foto"] ?>" alt="Excursión" class="card-img-top" style="height: 100%; width: 100%; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title"> <?php echo $excursion["nombre"] ?></h5>
                            <p class="card-text small"><strong> Descrpción:</strong><?php echo $excursion["descripcion"] ?></p>
                            <p class="card-text"> <strong> Precio:</strong> $<?php echo $excursion["precio"] ?></p>
                            <a href="#" class="btn btn-dark">Ver más ...</a>
                        </div>
                    </div>

                </div>
            <?php } ?>
        </div>
    </section>

    <!-- Servicios complementarios -->
    <section class="container mt-5" id="servicios">
        <h2 class="text-center">Servicios complementarios</h2>
        <br />
        <div class="row row-cols-1 row-cols-md-4 g-4">
            <?php foreach ($resultadoServicios as $servicio) { ?>
                <div class="col d-flex">
                    <div class="card">
                        <img src="images/servicios/<?php echo $servicio["foto"] ?>" alt="Servicio" class="card-img-top" style="height: 100%; width: 100%; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title"> <?php echo $servicio["nombre"] ?></h5>
                            <p class="card-text small"><strong> Descrpción:</strong><?php echo $servicio["descripcion"] ?></p>
                            <p class="card-text"> <strong> Precio:</strong> $<?php echo $servicio["precio"] ?></p>
                            <a href="#" class="btn btn-dark">Ver más ...</a>
                        </div>
                    </div>

                </div>
            <?php } ?>
        </div>
    </section>

    <!-- Transportacion -->
    <section class="container mt-5" id="transportacion">
        <h2 class="text-center">Transportación</h2>
        <br />
        <div class="row row-cols-1 row-cols-md-4 g-4">
            <?php foreach ($resultadoTransportacion as $transportacion) { ?>
                <div class="col d-flex">
                    <div class="card">
                        <img src="images/transportacion/<?php echo $transportacion["foto"] ?>" alt="Transporte" class="card-img-top" style="height: 100%; width: 100%; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title"> <?php echo $transportacion["nombre"] ?></h5>
                            <p class="card-text small"><strong> Descrpción:</strong><?php echo $transportacion["descripcion"] ?></p>
                            <p class="card-text"> <strong> Precio:</strong> $<?php echo $transportacion["precio"] ?></p>
                            <a href="#" class="btn btn-dark">Ver más ...</a>
                        </div>
                    </div>

                </div>
            <?php } ?>
        </div>
    </section>

    <!-- Mantenimientos constructivos -->
    <section class="container mt-5" id="mantenimientos">
        <h2 class="text-center">Mantenimientos constructivos</h2>
        <br />
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <?php foreach ($resultadoMantenimientos as $mantenimiento) { ?>
                <div class="col d-flex">
                <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-5">
                        <img src="images/mantenimientos/<?php echo $mantenimiento["foto"] ?>" alt="Mantenimiento" class="img-fluid rounded-start" style="height: 100%; width: 100%; object-fit: cover;">
                    </div>
                    <div class="col-md-7">
                        <div class="card-body">
                            <h5 class="card-title"> <?php echo $mantenimiento["nombre"] ?></h5>
                            <p class="card-text small"><strong> Descrpción:</strong><?php echo $mantenimiento["descripcion"] ?></p>
                            <p class="card-text"> <strong> Precio:</strong> $<?php echo $mantenimiento["precio"] ?></p>
                            <a href="#" class="btn btn-dark">Ver más ...</a>
                        </div>
                    </div>
                </div>
            </div>
                </div>

            <?php } ?>
        </div>
    </section>

    <!-- Contactos -->
    <!-- <section class="container mt-4">
        <h2>Contacto</h2>
        <p>Estamos aquí para servirle</p>
        <form action="?" method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Nombre:</label>
                <input type="text" class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="Escriba su nombre..." required />

            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico:</label>
                <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelpId" placeholder="Escribe tu correo electrónico" required />
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Mensaje:</label>
                <textarea class="form-control" name="message" id="message" rows="6" cols="50"></textarea>
            </div>
            <input type="submit" class="btn btn-primary" value="Enviar mensaje">


        </form>

    </section> -->

    <!-- Horario -->
    <!-- <div class="text-center bg-light p-4">
        <h3 class="mb-4">Horario de atención</h3>
        <div>
            <p><strong>Lunes a Viernes</strong></p>
            <p><strong>08:00 a.m. - 06:00 p.m.</strong></p>
        </div>

    </div> -->

    <!-- footer -->
    <footer class="mt-4">
        <div class="container-fluid">
            <div class="row p-5 pb-2 bg-dark text-white">
                <div class="col-xs-12 col-md-6 col-lg-3" id="qsomos">
                    <p class="h5 text-uppercase">ESCALE</p>
                    <hr class="mb-4">
                    <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                </div>
                <div class="col-xs-12 col-md-6 col-lg-3">
                    <p class="h5 text-uppercase">Servicios</p>
                    <hr class="mb-4">
                    <div class="mb-3">
                        <a class="text-secondary text-decoration-none" href="#">Alojamiento</a>
                    </div>
                    <div class="mb-3">
                        <a class="text-secondary text-decoration-none" href="#">Confecciones textiles</a>
                    </div>
                    <div class="mb-3">
                        <a class="text-secondary text-decoration-none" href="#">Excursiones</a>
                    </div>
                    <div class="mb-3">
                        <a class="text-secondary text-decoration-none" href="#">Servicios complementarios</a>
                    </div>
                    <div class="mb-3">
                        <a class="text-secondary text-decoration-none" href="#">Transportación</a>
                    </div>
                    <div class="mb-3">
                        <a class="text-secondary text-decoration-none" href="#">Mantenimiento constructivo</a>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6 col-lg-3" id="enlaces">
                    <p class="h5 mb-3 text-uppercase">Enlaces</p>
                    <hr class="mb-4">
                    <div class="mb-2">
                        <a class="text-secondary text-decoration-none" href="#">Términos & Condiciones</a>
                    </div>
                    <div class="mb-2">
                        <a class="text-secondary text-decoration-none" href="#">Política de Privacidad</a>
                    </div>
                    <div class="mb-2">
                        <a class="text-secondary text-decoration-none" href="#"><i class="bi bi-facebook"></i> Facebook</a>
                    </div>
                    <div class="mb-2">
                        <a class="text-secondary text-decoration-none" href="#"><i class="bi bi-instagram"></i> Imstagram</a>
                    </div>
                    <div class="mb-2">
                        <a class="text-secondary text-decoration-none" href="#"><i class="bi bi-whatsapp"></i> Whatsapp</a>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6 col-lg-3" id="contacto">
                    <p class="h5 mb-3 text-uppercase">Contacto</p>
                    <hr class="mb-4">
                    <form action="?" method="post">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="Escriba su nombre..." required />

                        </div>
                        <div class="mb-3">
                            <label for="correo" class="form-label">Correo electrónico:</label>
                            <input type="email" class="form-control" name="correo" id="correo" aria-describedby="emailHelpId" placeholder="Escribe tu correo electrónico" required />
                        </div>
                        <div class="mb-3">
                            <label for="mensaje" class="form-label">Mensaje:</label>
                            <textarea class="form-control" name="mensaje" id="mensaje" rows="6" cols="50"></textarea>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Enviar mensaje">

                    </form>
                </div>
                <div class="col-xs-12 pt-3">
                    <p class="text-white text-center">Copyright - Todos los derechos reservados © 2024</p>
                </div>

            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>