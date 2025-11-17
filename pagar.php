<?php
session_start();
include "conexion.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirmar'])) {
    $user_id = $_SESSION['user_id'];

    // obtener carrito
    $stmt = $conexion->prepare("SELECT id, destino, precio, cantidad FROM carrito WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $res = $stmt->get_result();
    $items = $res->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    if (empty($items)) {
        header("Location: carrito.php");
        exit;
    }

    // calcular total
    $total = 0;
    foreach ($items as $it) $total += $it['precio'] * $it['cantidad'];

    // crear pedido
    $ins = $conexion->prepare("INSERT INTO pedidos (user_id, total) VALUES (?, ?)");
    $ins->bind_param("id", $user_id, $total);
    $ins->execute();
    $pedido_id = $ins->insert_id;
    $ins->close();

    // insertar items
    $insItem = $conexion->prepare("INSERT INTO pedido_items (pedido_id, destino, precio, cantidad) VALUES (?, ?, ?, ?)");
    foreach ($items as $it) {
        $insItem->bind_param("isdi", $pedido_id, $it['destino'], $it['precio'], $it['cantidad']);
        $insItem->execute();
    }
    $insItem->close();

    // limpiar carrito
    $del = $conexion->prepare("DELETE FROM carrito WHERE user_id = ?");
    $del->bind_param("i", $user_id);
    $del->execute();
    $del->close();

    // redirigir a carrito con OK
    header("Location: carrito.php?paid=1");
    exit;
} else {
    header("Location: carrito.php");
    exit;
}
?>
