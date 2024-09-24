<?php
include("../../bd.php");

if (isset($_GET['txtId'])) {
    $txtId = (isset($_GET["txtId"])) ? $_GET["txtId"] : "";

    //Proceso de borrado que busque la imagen y la pueda borrar
    $sentencia = $conexion->prepare("SELECT * FROM `tbl_transportacion`  WHERE id = :id");
    $sentencia->bindParam(":id", $txtId);
    $sentencia->execute();

    $registro_foto = $sentencia->fetch(PDO::FETCH_LAZY);

    if (isset($registro_foto["foto"])) {
        if (file_exists("../../../images/transportacion/" . $registro_foto["foto"])) {
            unlink("../../../images/transportacion/" . $registro_foto["foto"]);
        }
    }

    // borra en la base de datos
    $sentencia =  $conexion->prepare("DELETE FROM `tbl_transportacion` WHERE id = :id");

    $sentencia->bindParam(":id", $txtId);
    $sentencia->execute();

    header("Location: index.php");
}



$sentencia = $conexion->prepare("SELECT * FROM `tbl_transportacion`");
$sentencia->execute();

$resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);

include("../../templates/header.php");
?>

<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar Registros</a>

    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Enlace</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($resultado as $key => $value) {
                    ?>
                        <tr class="">
                            <td scope="row"><?php echo $value['id']; ?></td>
                            <td><?php echo $value['nombre']; ?></td>
                            <td><img src="../../../images/transportacion/<?php echo $value['foto']; ?>" width="50" alt=""></td>
                            <td><?php echo $value['descripcion']; ?></td>
                            <td><?php echo $value['precio']; ?></td>
                            <td><?php echo $value['enlace']; ?></td>
                            <td>
                                <a name="" id="" class="btn btn-info" href="editar.php?txtId=<?php echo $value['id']; ?>" role="button">Editar</a>
                                <a name="" id="" class="btn btn-danger" href="index.php?txtId=<?php echo $value['id']; ?>" role="button">Eliminar</a>

                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include("../../templates/footer.php") ?>