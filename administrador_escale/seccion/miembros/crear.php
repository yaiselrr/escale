<?php
include("../../bd.php");

print_r($_POST);

if ($_POST) {
    $titulo = (isset($_POST["titulo"])) ? $_POST["titulo"] : "";
    $descripcion = (isset($_POST["descripcion"])) ? $_POST["descripcion"] : "";
    $facebook = (isset($_POST["facebook"])) ? $_POST["facebook"] : "";
    $instagram = (isset($_POST["instagram"])) ? $_POST["instagram"] : "";
    $linkedin = (isset($_POST["linkedin"])) ? $_POST["linkedin"] : "";

    $foto = (isset($_FILES["foto"]["name"])) ? $_FILES["foto"]["name"] : "";
    $fecha_foto = new DateTime();
    $nombre_foto = $fecha_foto->getTimestamp()."_".$foto;
    $tmp_foto = $_FILES["foto"]["tmp_name"];

    if ($tmp_foto != "") {
        move_uploaded_file($tmp_foto,"../../../images/miembros/".$nombre_foto);
    }

    $sentencia =  $conexion->prepare("INSERT INTO `tbl_miembros`(`id`, `titulo`, `descripcion`, `linkfacebook`, `linkinstagram`, `linklinkedin`, `foto`) VALUES (NULL, :titulo, :descripcion, :facebook, :instagram, :linkedin, :foto);");

    $sentencia->bindParam(":foto", $nombre_foto);
    $sentencia->bindParam(":titulo", $titulo);
    $sentencia->bindParam(":descripcion", $descripcion);
    $sentencia->bindParam(":facebook", $facebook);
    $sentencia->bindParam(":instagram", $instagram);
    $sentencia->bindParam(":linkedin", $linkedin);

    $sentencia->execute();

    header("Location: index.php");
}

include("../../templates/header.php")
?>

<br />
<div class="card">
    <div class="card-header">Miembros</div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="titulo" class="form-label">Nombre:</label>
                <input type="text" class="form-control" name="titulo" id="titulo" aria-describedby="helpId" placeholder="Escriba el nombre completo" />

            </div>

            <div class="mb-3">
                <label for="foto" class="form-label">Foto</label>
                <input type="file" class="form-control" name="foto" id="foto" placeholder="" aria-describedby="fileHelpId" />                
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Cargo:</label>
                <input type="text" class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="Escriba el cargo" />

            </div>
            <div class="mb-3">
                <label for="facebook" class="form-label">Facebook:</label>
                <input type="text" class="form-control" name="facebook" id="facebook" aria-describedby="helpId" placeholder="Escriba el enlace facebook" />

            </div>
            <div class="mb-3">
                <label for="instagram" class="form-label">Instagram:</label>
                <input type="text" class="form-control" name="instagram" id="instagram" aria-describedby="helpId" placeholder="Escriba el enlace instagram" />

            </div>
            <div class="mb-3">
                <label for="linkedin" class="form-label">Linkedin:</label>
                <input type="text" class="form-control" name="linkedin" id="linkedin" aria-describedby="helpId" placeholder="Escriba el enlace linkedin" />

            </div>
            <button type="submit" class="btn btn-success">
                Agregar miembro
            </button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>



        </form>


    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include("../../templates/footer.php") ?>