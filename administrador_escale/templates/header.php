<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location:" . $url_base . "login.php");
}
$url_base = "http://localhost/escale/administrador_escale/";
?>
<!doctype html>
<html lang="en">

<head>
    <title>Administrador del sitio web</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand navbar-light bg-light">
            <div class="nav navbar-nav">
                <a class="nav-item nav-link active" href="<?php echo $url_base; ?>index.php" aria-current="page">Administrador <span class="visually-hidden">(current)</span></a>
                <a class="nav-item nav-link" href="<?php echo $url_base; ?>seccion/carrusel">Banners</a>
                <a class="nav-item nav-link" href="<?php echo $url_base; ?>seccion/miembros">Miembros</a>
                <a class="nav-item nav-link" href="<?php echo $url_base; ?>seccion/alojamiento">Alojamiento</a>
                <a class="nav-item nav-link" href="<?php echo $url_base; ?>seccion/confecciones">Confecciones textiles</a>
                <a class="nav-item nav-link" href="<?php echo $url_base; ?>seccion/eventos">Eventos</a>
                <a class="nav-item nav-link" href="<?php echo $url_base; ?>seccion/excursiones">Excursiones</a>
                <a class="nav-item nav-link" href="<?php echo $url_base; ?>seccion/servicios-compl">Servicios Complementarios</a>
                <a class="nav-item nav-link" href="<?php echo $url_base; ?>seccion/transportacion">Transportación</a>
                <a class="nav-item nav-link" href="<?php echo $url_base; ?>seccion/mantenimientos">Mantenimientos</a>
                <a class="nav-item nav-link" href="<?php echo $url_base; ?>seccion/comentarios">Comentarios</a>
                <a class="nav-item nav-link" href="<?php echo $url_base; ?>seccion/usuarios">Usuarios</a>
                <a class="nav-item nav-link" href="<?php echo $url_base; ?>cerrar.php">Cerrar sesión</a>
            </div>
        </nav>

    </header>
    <main>
        <section class="container mt-4">