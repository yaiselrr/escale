<?php 
$servidor = "localhost";
$baseDatos = "escale";
$usuario = "root";
$contrasenna = "";

try {
    $conexion = new PDO("mysql:host=$servidor;dbname=$baseDatos", $usuario, $contrasenna);

    // echo "Conexion establecida";
} catch (Exception $error) {
    echo $error->getMessage();
}

?>