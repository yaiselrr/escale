<?php
include("../../bd.php");

if (isset($_GET['txtId'])) {
    $txtId = (isset($_GET["txtId"])) ? $_GET["txtId"] : "";

    $sentencia = $conexion->prepare("SELECT * FROM `tbl_servicios_complementarios` WHERE id = :id");
    $sentencia->bindParam(":id", $txtId);
    $sentencia->execute();

    $registro = $sentencia->fetch(PDO::FETCH_LAZY);

    $titulo = $registro["nombre"];
    $descripcion = $registro["descripcion"];
    $enlace = $registro["enlace"];
    $precio = $registro["precio"];
    $foto = $registro["foto"];
}

if ($_POST) {
    $titulo = (isset($_POST["titulo"])) ? $_POST["titulo"] : "";
    $descripcion = (isset($_POST["descripcion"])) ? $_POST["descripcion"] : "";
    $enlace = (isset($_POST["enlace"])) ? $_POST["enlace"] : "";
    $precio = (isset($_POST["precio"])) ? $_POST["precio"] : "";
    $txtId = (isset($_POST["txtId"])) ? $_POST["txtId"] : "";

    $sentencia =  $conexion->prepare("UPDATE `tbl_servicios_complementarios` SET `nombre`=:titulo,`descripcion`=:descripcion,`precio`=:precio, `enlace`=:enlace WHERE id = :id;");

    $sentencia->bindParam(":titulo", $titulo);
    $sentencia->bindParam(":descripcion", $descripcion);
    $sentencia->bindParam(":enlace", $enlace);
    $sentencia->bindParam(":precio", $precio);
    $sentencia->bindParam(":id", $txtId);

    $sentencia->execute();

    //  proceso de actualizacion de foto
    $foto = (isset($_FILES["foto"]["name"])) ? $_FILES["foto"]["name"] : "";
    $tmp_foto = $_FILES["foto"]["tmp_name"];

    if ($foto != "") {
        $fecha_foto = new DateTime();
        $nombre_foto = $fecha_foto->getTimestamp() . "_" . $foto;
        move_uploaded_file($tmp_foto, "../../../images/servicios/" . $nombre_foto);

        $sentencia = $conexion->prepare("SELECT * FROM `tbl_servicios_complementarios`  WHERE id = :id");
        $sentencia->bindParam(":id", $txtId);
        $sentencia->execute();

        $registro_foto = $sentencia->fetch(PDO::FETCH_LAZY);

        if (isset($registro_foto["foto"])) {
            if (file_exists("../../../images/servicios/" . $registro_foto["foto"])) {
                unlink("../../../images/servicios/" . $registro_foto["foto"]);
            }
        }
        $sentencia =  $conexion->prepare("UPDATE `tbl_servicios_complementarios` SET `foto`=:foto WHERE id = :id;");

        $sentencia->bindParam(":foto", $nombre_foto);
        $sentencia->bindParam(":id", $txtId);

        $sentencia->execute();
    }

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
                <label for="txtId" class="form-label">ID:</label>
                <input type="text" class="form-control" value="<?php echo $txtId ?>" name="txtId" id="txtId" aria-describedby="helpId" placeholder="Escriba el id" />

            </div>

            <div class="mb-3">
                <label for="titulo" class="form-label">Nombre:</label>
                <input type="text" class="form-control" value="<?php echo $titulo ?>" name="titulo" id="titulo" aria-describedby="helpId" placeholder="Escriba el título" />

            </div>

            <div class="mb-3">
                <label for="foto" class="form-label">Foto:</label><br />
                <img width="100" src="../../../images/servicios/<?php echo $foto ?>" alt="Foto">
                <input type="file" class="form-control" name="foto" id="foto" placeholder="" aria-describedby="fileHelpId" />
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción:</label>
                <input type="text" class="form-control" value="<?php echo $descripcion ?>" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="Escriba la descripción" />

            </div>
            <div class="mb-3">
                <label for="precio" class="form-label">Precio:</label>
                <input type="text" class="form-control" value="<?php echo $precio ?>" name="precio" id="precio" aria-describedby="helpId" placeholder="Escriba el precio" />

            </div>
            <div class="mb-3">
                <label for="enlace" class="form-label">Enlace:</label>
                <input type="text" class="form-control" value="<?php echo $enlace ?>" name="enlace" id="enlace" aria-describedby="helpId" placeholder="Escriba el enlace" />

            </div>
            <button type="submit" class="btn btn-success">
                Modificar servicio
            </button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>

        </form>


    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include("../../templates/footer.php") ?>