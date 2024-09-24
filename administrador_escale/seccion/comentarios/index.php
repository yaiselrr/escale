<?php
include("../../bd.php");

if (isset($_GET['txtId'])) {
    $txtId = (isset($_GET["txtId"])) ? $_GET["txtId"] : "";

    //Proceso de borrado que busque la imagen y la pueda borrar
    $sentencia = $conexion->prepare("SELECT * FROM `tbl_comentarios`  WHERE id = :id");
    $sentencia->bindParam(":id", $txtId);
    $sentencia->execute();

    // borra en la base de datos
    $sentencia =  $conexion->prepare("DELETE FROM `tbl_comentarios` WHERE id = :id");

    $sentencia->bindParam(":id", $txtId);
    $sentencia->execute();

    header("Location: index.php");
}


$sentencia = $conexion->prepare("SELECT * FROM `tbl_comentarios`");
$sentencia->execute();

$resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);

include("../../templates/header.php");
?>

<div class="card">
    <div class="card-header">
        Bandeja de comentarios
        <!-- <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar Registros</a> -->

    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Mensaje</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($resultado as $key => $value) {
                    ?>
                        <tr class="">
                            <td scope="row"><?php echo $value['id']; ?></td>
                            <td><?php echo $value['nombre']; ?></td>                            
                            <td><?php echo $value['correo']; ?></td>
                            <td><?php echo $value['mensaje']; ?></td>
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