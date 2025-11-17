<?php 
include("conexion.php");

$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$destino = $_POST['destino'];
$mensaje = $_POST['mensaje'];

$sql = "INSERT INTO solicitudes_viaje (nombre, correo, destino, mensaje) 
        VALUES ('$nombre', '$correo', '$destino', '$mensaje')";

if ($conexion->query($sql)) {
    echo "<h2>Solicitud enviada con éxito.</h2>";
    echo "<a href='index.php'>Volver al Inicio</a>";
} else {
    echo "Error: " . $conexion->error;
}
?>
