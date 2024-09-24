<?php
include("../../bd.php");

if (isset($_GET['txtId'])) {
    $txtId = (isset($_GET["txtId"])) ? $_GET["txtId"] : "";

    $sentencia = $conexion->prepare("SELECT * FROM `tbl_miembros` WHERE id = :id");
    $sentencia->bindParam(":id", $txtId);
    $sentencia->execute();

    $registro = $sentencia->fetch(PDO::FETCH_LAZY);

    $titulo = $registro["titulo"];
    $descripcion = $registro["descripcion"];
    $facebook = $registro["linkfacebook"];
    $instagram = $registro["linkinstagram"];
    $linkedin = $registro["linklinkedin"];
    $foto = $registro["foto"];
}

if ($_POST) {
    $titulo = (isset($_POST["titulo"])) ? $_POST["titulo"] : "";
    $descripcion = (isset($_POST["descripcion"])) ? $_POST["descripcion"] : "";
    $facebook = (isset($_POST["facebook"])) ? $_POST["facebook"] : "";
    $instagram = (isset($_POST["instagram"])) ? $_POST["instagram"] : "";
    $linkedin = (isset($_POST["linkedin"])) ? $_POST["linkedin"] : "";
    $txtId = (isset($_POST["txtId"])) ? $_POST["txtId"] : "";

    $sentencia =  $conexion->prepare("UPDATE `tbl_miembros` SET `titulo`=:titulo,`descripcion`=:descripcion,`linkfacebook`=:facebook,`linkinstagram`=:instagram,`linklinkedin`=:linkedin WHERE id = :id;");

    $sentencia->bindParam(":titulo", $titulo);
    $sentencia->bindParam(":descripcion", $descripcion);
    $sentencia->bindParam(":facebook", $facebook);
    $sentencia->bindParam(":instagram", $instagram);
    $sentencia->bindParam(":linkedin", $linkedin);
    $sentencia->bindParam(":id", $txtId);

    $sentencia->execute();

    //  proceso de actualizacion de foto
    $foto = (isset($_FILES["foto"]["name"])) ? $_FILES["foto"]["name"] : "";
    $tmp_foto = $_FILES["foto"]["tmp_name"];

    if ($foto != "") {
        $fecha_foto = new DateTime();
        $nombre_foto = $fecha_foto->getTimestamp() . "_" . $foto;
        move_uploaded_file($tmp_foto, "../../../images/miembros/" . $nombre_foto);

        $sentencia = $conexion->prepare("SELECT * FROM `tbl_miembros`  WHERE id = :id");
        $sentencia->bindParam(":id", $txtId);
        $sentencia->execute();

        $registro_foto = $sentencia->fetch(PDO::FETCH_LAZY);

        if (isset($registro_foto["foto"])) {
            if (file_exists("../../../images/miembros/" . $registro_foto["foto"])) {
                unlink("../../../images/miembros/" . $registro_foto["foto"]);
            }
        }
        $sentencia =  $conexion->prepare("UPDATE `tbl_miembros` SET `foto`=:foto WHERE id = :id;");

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
    <div class="card-header">Miembros</div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="txtId" class="form-label">ID:</label>
                <input type="text" class="form-control" value="<?php echo $txtId ?>" name="txtId" id="txtId" aria-describedby="helpId" placeholder="Escriba el título del banner" />

            </div>

            <div class="mb-3">
                <label for="titulo" class="form-label">Nombre:</label>
                <input type="text" class="form-control" value="<?php echo $titulo ?>" name="titulo" id="titulo" aria-describedby="helpId" placeholder="Escriba el nombre completo" />

            </div>

            <div class="mb-3">
                <label for="foto" class="form-label">Foto:</label><br />
                <img width="100" src="../../../images/miembros/<?php echo $foto ?>" alt="Foto">
                <input type="file" class="form-control" name="foto" id="foto" placeholder="" aria-describedby="fileHelpId" />
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Cargo:</label>
                <input type="text" class="form-control" value="<?php echo $descripcion ?>" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="Escriba el cargo" />

            </div>
            <div class="mb-3">
                <label for="facebook" class="form-label">Facebook:</label>
                <input type="text" class="form-control" value="<?php echo $facebook ?>" name="facebook" id="facebook" aria-describedby="helpId" placeholder="Escriba el enlace facebook" />

            </div>
            <div class="mb-3">
                <label for="instagram" class="form-label">Instagram:</label>
                <input type="text" class="form-control" value="<?php echo $instagram ?>" name="instagram" id="instagram" aria-describedby="helpId" placeholder="Escriba el enlace instagram" />

            </div>
            <div class="mb-3">
                <label for="linkedin" class="form-label">Linkedin:</label>
                <input type="text" class="form-control" value="<?php echo $linkedin ?>" name="linkedin" id="linkedin" aria-describedby="helpId" placeholder="Escriba el enlace linkedin" />

            </div>
            <button type="submit" class="btn btn-success">
                Modificar miembro
            </button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>



        </form>


    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include("../../templates/footer.php") ?>