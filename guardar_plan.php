<?php
session_start();
include "conexion.php";

if(!isset($_SESSION["user_id"])){
    echo "<script>alert('Debes iniciar sesión'); window.location='login.php';</script>";
    exit;
}

$user_id = $_SESSION["user_id"];
$nombre_viajero = $_POST["nombre_viajero"];
$destino = $_POST["destino"];
$tipo_viaje = $_POST["tipo_viaje"];
$fecha_viaje = $_POST["fecha_viaje"];

// Calcular precio según destino y tipo
$precios = [
    "Canal de Panamá" => ["Normal" => 25, "VIP" => 50],
    "Bocas del Toro"  => ["Normal" => 50, "VIP" => 80],
    "Casco Viejo"     => ["Normal" => 15, "VIP" => 30]
];
$precio_total = $precios[$destino][$tipo_viaje];

$stmt = $conexion->prepare("INSERT INTO carrito (user_id, nombre_viajero, destino, tipo_viaje, fecha_viaje, precio_total) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("issssd", $user_id, $nombre_viajero, $destino, $tipo_viaje, $fecha_viaje, $precio_total);
$stmt->execute();
$stmt->close();

echo "<script>alert('Solicitud agregada al carrito'); window.location='carrito.php';</script>";
?>
