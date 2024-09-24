<?php
include("../../bd.php");

if (isset($_GET['txtId'])) {
    $txtId = (isset($_GET["txtId"])) ? $_GET["txtId"] : "";

    //Proceso de borrado que busque la imagen y la pueda borrar
    $sentencia = $conexion->prepare("SELECT * FROM `tbl_usuarios`  WHERE id = :id");
    $sentencia->bindParam(":id", $txtId);
    $sentencia->execute();

    // borra en la base de datos
    $sentencia =  $conexion->prepare("DELETE FROM `tbl_usuarios` WHERE id = :id");

    $sentencia->bindParam(":id", $txtId);
    $sentencia->execute();

    header("Location: index.php");
}

$sentencia = $conexion->prepare("SELECT * FROM `tbl_usuarios`");
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
                        <th scope="col">Usuario</th>
                        <th scope="col">Contraseña</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($resultado as $key => $value) {
                    ?>
                        <tr class="">
                            <td scope="row"><?php echo $value['id']; ?></td>
                            <td><?php echo $value['usuario']; ?></td>
                            <td>***********</td>
                            <td><?php echo $value['correo']; ?></td>
                            <td>
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