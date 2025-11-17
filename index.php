<?php 
session_start(); 
include "conexion.php"; 
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Turismo en Panamá</title>

<style>
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f0f8ff;
    padding-top: 140px;
    padding-bottom: 80px;
}

header {
    background-color: #0038a8;
    color: white;
    padding: 1em;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: fixed;
    top:0;
    width:100%;
    z-index:1000;
}

.left-zone {
    display:flex;
    align-items:center;
    gap:12px;
    margin-left: 10px;
}

.logo {
    width:80px;
    height:80px;
    display:flex;
    align-items:center;
    justify-content:center;
    overflow:hidden;
}

.logo img{
    max-width:100%;
    max-height:100%;
    object-fit:contain;
}

.cart-btn{
    background:white;
    color:#0038a8;
    padding:8px 12px;
    border-radius:6px;
    text-decoration:none;
    font-weight:bold;
}

nav ul {
    list-style-type:none;
    padding:0;
    display:flex;
    justify-content:center;
    gap:18px;
    margin:0;
    width:100%;
}

nav ul li a {
    color:white;
    text-decoration:none;
    font-weight:bold;
}

.auth-buttons {
    margin-right: 25px; 
}

.auth-buttons a{
    background:white;
    color:#0038a8;
    padding:8px 10px;
    border-radius:6px;
    text-decoration:none;
    margin-left:8px;
    font-weight:bold;
}

main {
    padding: 2em;
    max-width: 1200px;
    margin: 0 auto;
}

.hero {
    background-image: url('fondo.jpg'); 
    background-size: cover;
    background-position: center;
    height: 400px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    text-align: center;
    margin-bottom: 2em;
    position: relative;
}

.hero::before {
    content: "";
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background-color: rgba(0,0,0,0.4); 
    z-index: 1;
}

.hero h2{
    font-size: 3em;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
    position: relative;
    z-index: 2;
}

.destinations{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
    gap:2em;
}

.destination-card{
    background-color:white;
    border-radius:8px;
    overflow:hidden;
    box-shadow:0 4px 6px rgba(0,0,0,0.1);
    transition:transform 0.3s;
    padding-bottom:10px;
}

.destination-card img{
    width:100%;
    height:200px;
    object-fit:cover;
}

.destination-card h3{
    padding:1em;
    margin:0;
    background-color:#0038a8;
    color:white;
}

.destination-card p{
    padding:0 1em 1em;
}

footer{
    background-color:#0038a8;
    color:white;
    text-align:center;
    padding:1em;
    position:fixed;
    bottom:0;
    width:100%;
    left:0;
}

form button{
    background:#ffd700;
    color:#0038a8;
    padding:8px 12px;
    border:none;
    border-radius:6px;
    cursor:pointer;
    font-weight:bold;
    margin:0 1em 1em 1em;
}
</style>
</head>
<body>

<header>
    <div class="left-zone">
        <div class="logo">
            <img src="logo.webp" alt="logo">
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
        <?php if (isset($_SESSION['user_id'])): ?>
            <span style="color:white;margin-right:8px;">Hola, <?=htmlspecialchars($_SESSION['user_name'])?></span>
            <a href="logout.php">Salir</a>
        <?php else: ?>
            <a href="login.php">Iniciar sesión</a>
            <a href="registro.php">Registrarse</a>
        <?php endif; ?>
    </div>
</header>

<main>

    <div class="hero">
        <h2>Descubre la Magia de Panamá</h2>
    </div>

    <p>Bienvenido al corazón de Centroamérica. Panamá te ofrece una experiencia única que combina historia, modernidad y belleza natural.</p>

    <h3>Destinos populares</h3>

    <div class="destinations">

        <!-- Tarjeta 1 -->
        <div class="destination-card">
            <img src="canal.jpg" alt="Canal de Panamá">
            <h3>Canal de Panamá</h3>
            <p>Un lugar histórico y emblemático, donde se puede observar el paso de barcos de todo el mundo.</p>
        </div>

        <!-- Tarjeta 2 -->
        <div class="destination-card">
            <img src="bocas.jpg" alt="Bocas del Toro">
            <h3>Bocas del Toro</h3>
            <p>Hermosas playas y paisajes naturales que enamoran a todos los visitantes.</p>
        </div>

        <!-- Tarjeta 3 -->
        <div class="destination-card">
            <img src="casco.jpg" alt="Casco Viejo">
            <h3>Casco Viejo</h3>
            <p>Centro histórico de la ciudad, lleno de cultura, arquitectura y vida nocturna.</p>
        </div>

    </div>

</main>

<footer>
    <p>© 2025 Turismo en Panamá</p>
</footer>

</body>
</html>
