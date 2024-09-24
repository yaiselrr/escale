<?php
include("../../bd.php");

if ($_POST) {
    $titulo = (isset($_POST["titulo"])) ? $_POST["titulo"] : "";
    $descripcion = (isset($_POST["descripcion"])) ? $_POST["descripcion"] : "";
    $enlace = (isset($_POST["enlace"])) ? $_POST["enlace"] : "";
    $precio = (isset($_POST["precio"])) ? $_POST["precio"] : "";

    $foto = (isset($_FILES["foto"]["name"])) ? $_FILES["foto"]["name"] : "";
    $fecha_foto = new DateTime();
    $nombre_foto = $fecha_foto->getTimestamp()."_".$foto;
    $tmp_foto = $_FILES["foto"]["tmp_name"];

    if ($tmp_foto != "") {
        move_uploaded_file($tmp_foto,"../../../images/servicios/".$nombre_foto);
    }

    $sentencia =  $conexion->prepare("INSERT INTO `tbl_servicios_complementarios`(`id`, `nombre`, `descripcion`, `foto`, `precio`, `enlace`) VALUES (NULL, :titulo, :descripcion, :foto, :precio, :enlace);");

    $sentencia->bindParam(":titulo", $titulo);
    $sentencia->bindParam(":descripcion", $descripcion);
    $sentencia->bindParam(":enlace", $enlace);
    $sentencia->bindParam(":precio", $precio);
    $sentencia->bindParam(":foto", $nombre_foto);

    $sentencia->execute();

    header("Location: index.php");
}

include("../../templates/header.php")
?>

<br />
<div class="card">
    <div class="card-header">Servicios complementarios</div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="titulo" class="form-label">Nombre:</label>
                <input type="text" class="form-control" name="titulo" id="titulo" aria-describedby="helpId" placeholder="Escriba el nombre" />

            </div>

            <div class="mb-3">
                <label for="foto" class="form-label">Foto</label>
                <input type="file" class="form-control" name="foto" id="foto" placeholder="" aria-describedby="fileHelpId" />                
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción:</label>
                <input type="text" class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="Escriba la descripción" />

            </div>

            <div class="mb-3">
                <label for="precio" class="form-label">Precio:</label>
                <input type="text" class="form-control" name="precio" id="precio" aria-describedby="helpId" placeholder="Escriba el precio" />

            </div>
            <div class="mb-3">
                <label for="enlace" class="form-label">Enlace:</label>
                <input type="text" class="form-control" name="enlace" id="enlace" aria-describedby="helpId" placeholder="Escriba el enlace" />

            </div>
            <button type="submit" class="btn btn-success">
                Crear servicio
            </button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>



        </form>


    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include("../../templates/footer.php") ?>