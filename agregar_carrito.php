<?php
session_start();
include "conexion.php";

if(!isset($_SESSION["user_id"])){
    echo "<script>alert('Debes iniciar sesión'); window.location='login.php';</script>";
    exit;
}

$user_id = $_SESSION["user_id"];
$destino = $_POST["destino"];
$precio = $_POST["precio"];
$cantidad = $_POST["cantidad"];

$stmt = $conexion->prepare("INSERT INTO carrito (user_id, destino, precio, cantidad, agregado_en) VALUES (?, ?, ?, ?, NOW())");
$stmt->bind_param("isdi", $user_id, $destino, $precio, $cantidad);
$stmt->execute();
$stmt->close();

echo "<script>alert('Agregado al carrito'); window.location='index.php';</script>";
?>
