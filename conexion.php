<?php
// conexion.php

$host = "localhost";
$user = "root";
$pass = "";
$db   = "turismo";

// Reportar errores de mysqli
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$conexion = new mysqli($host, $user, $pass, $db);

// Configurar charset
$conexion->set_charset("utf8mb4");

// Verificar conexión
if ($conexion->connect_errno) {
    die("Error de conexión: (" . $conexion->connect_errno . ") " . $conexion->connect_error);
}
?>
