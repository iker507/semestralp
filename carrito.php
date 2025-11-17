<?php 
session_start();
include "conexion.php"; 

if (!isset($_SESSION["user_id"])) {
    echo "<script>alert('Debes iniciar sesión para ver tu carrito'); window.location='login.php';</script>";
    exit;
}

$user_id = $_SESSION["user_id"];
$result = $conexion->query("SELECT * FROM carrito WHERE user_id=$user_id");
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Carrito</title>
<style>
body{
    margin:0; 
    padding:0; 
    font-family:'Segoe UI'; 
    padding-top:140px; 
    padding-bottom:80px; 
    background:#f0f8ff; 
    text-align:center;
}

header{ 
    background:#0038a8;
    color:white; 
    padding:1em; 
    display:flex; 
    justify-content:space-between; 
    align-items:center; 
    position:fixed; 
    top:0; 
    width:100%; 
    z-index:1000; 
}

.left-zone{ 
    display:flex;
    align-items:center;
    gap:12px; 
}

.logo{ 
    width:80px;
    height:80px;
    display:flex;
    align-items:center; 
}

.logo img{ 
    max-width:100%;
    max-height:100%; 
}

.cart-btn{ 
    background:white;
    color:#0038a8; 
    padding:8px 12px;
    border-radius:6px; 
    text-decoration:none;
    font-weight:bold; 
}

nav ul{ 
    list-style:none;
    display:flex; 
    gap:20px;
    margin:0;
    padding:0; 
}

nav ul li a{ 
    color:white;
    text-decoration:none;
    font-weight:bold; 
}

.auth-buttons {
    display:flex;
    align-items:center;
    margin-right:20px;
}

.auth-buttons span {
    margin-right:12px; /* separa un poco el nombre del botón */
}

.auth-buttons a{ 
    background:white;
    color:#0038a8; 
    padding:8px 10px;
    border-radius:6px; 
    text-decoration:none;
    margin-left:4px; /* reduce la separación del botón para que no se corte */
    font-weight:bold; 
}

main{ 
    max-width:900px; 
    margin:0 auto; 
    padding:2em; 
}

h2{
    text-align:center;
    margin-bottom:20px;
}

table{
    width:80%;
    margin:0 auto; 
    border-collapse:collapse; 
    background:white;
    border-radius:8px;
    overflow:hidden;
}

th, td{
    padding:12px;
    border-bottom:1px solid #ddd;
    text-align:center; 
}

th{ 
    background:#0038a8;
    color:white; 
}

footer{ 
    background:#0038a8;
    color:white; 
    text-align:center; 
    padding:1em; 
    position:fixed;
    bottom:0; 
    left:0;
    width:100%; 
}
</style>
</head>
<body>

<header>
    <div class="left-zone">
        <div class="logo">
            <img src="logo.webp" alt="Logo">
        </div>
        <a class="cart-btn" href="carrito.php">🛒 Carrito</a>
        <h1 style="margin-left:10px;">Turismo en Panamá</h1>
    </div>

    <nav>
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="destinos.php">Destinos</a></li>
            <li><a href="planifica.php">Planifica tu viaje</a></li>
        </ul>
    </nav>

    <div class="auth-buttons">
        <?php if(isset($_SESSION['user_id'])): ?>
            <span style="color:white;">Hola, <?=htmlspecialchars($_SESSION['user_name'])?></span>
            <a href="logout.php">Salir</a>
        <?php else: ?>
            <a href="login.php">Iniciar sesión</a>
            <a href="registro.php">Registrarse</a>
        <?php endif; ?>
    </div>
</header>

<main>
    <h2>Tu carrito</h2>

    <table>
        <tr>
            <th>Nombre</th>
            <th>Destino</th>
            <th>Tipo de viaje</th>
            <th>Fecha del viaje</th>
            <th>Precio total</th>
        </tr>

        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row["nombre_viajero"]) ?></td>
            <td><?= htmlspecialchars($row["destino"]) ?></td>
            <td><?= htmlspecialchars($row["tipo_viaje"]) ?></td>
            <td><?= htmlspecialchars($row["fecha_viaje"]) ?></td>
            <td>$<?= number_format($row["precio_total"], 2) ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</main>

<footer>
</footer>

</body>
</html>
