<?php session_start(); include "conexion.php"; ?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Destinos</title>

<style>
body{
    font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;
    margin:0; padding:0;
    background:#f0f8ff;
    padding-top:140px;
    padding-bottom:80px;
}

header{
    background:#0038a8;
    color:white;
    padding:1em;
    display:flex;
    justify-content:space-between;
    align-items:center;
    position:fixed;
    top:0; width:100%;
    z-index:1000;
    box-shadow:0 2px 4px rgba(0,0,0,0.1);
}

.left-zone{
    display:flex;
    align-items:center;
    gap:12px;
}

.logo{
    width:80px; height:80px;
    display:flex; justify-content:center; align-items:center;
}

.logo img{ max-width:100%; max-height:100%; object-fit:contain; }

.cart-btn{
    background:white;color:#0038a8;padding:8px 12px;
    border-radius:6px;text-decoration:none;font-weight:bold;
}

nav ul{
    list-style:none;
    display:flex;
    gap:20px;
    margin:0; padding:0;
}

nav ul li a{
    color:white;
    text-decoration:none;
    font-weight:bold;
}

.auth-buttons{
    display:flex;
    align-items:center;
    margin-right:20px;
}

.auth-buttons a{
    background:white;color:#0038a8;
    padding:8px 10px;
    border-radius:6px;
    text-decoration:none;
    margin-left:8px;
    font-weight:bold;
}

main{
    max-width:1200px;
    margin:auto;
    padding:2em;
}

.destinations{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
    gap:2em;
}

.destination-card{
    background:white;
    border-radius:8px;
    overflow:hidden;
    box-shadow:0 4px 6px rgba(0,0,0,0.1);
    padding-bottom:10px;
}

.destination-card img{
    width:100%; height:200px;
    object-fit:cover;
}

.destination-card h3{
    background:#0038a8;
    color:white;
    padding:1em;
    margin:0;
}

.destination-card p{
    padding:0 1em 1em;
    color:#333;
    line-height:1.4;
}

footer{
    background:#0038a8;color:white;
    text-align:center;
    padding:1em;
    position:fixed;
    bottom:0; left:0;
    width:100%;
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
        <?php if(isset($_SESSION['user_id'])): ?>
            <span style="color:white;margin-right:8px;">Hola, <?=htmlspecialchars($_SESSION['user_name'])?></span>
            <a href="logout.php">Salir</a>
        <?php else: ?>
            <a href="login.php">Iniciar sesión</a>
            <a href="registro.php">Registrarse</a>
        <?php endif; ?>
    </div>
</header>

<main>
    <h2>Explora todos nuestros destinos</h2>

    <div class="destinations">

        <div class="destination-card">
            <img src="esclusas.jpg" alt="Canal de Panamá">
            <h3>Canal de Panamá</h3>
            <p>Una de las maravillas de la ingeniería moderna, conecta el océano Atlántico con el Pacífico y es un icono de Panamá.</p>
        </div>

        <div class="destination-card">
            <img src="playas bocas.jpg" alt="Bocas del Toro">
            <h3>Bocas del Toro</h3>
            <p>Un archipiélago paradisíaco con playas de arena blanca, aguas cristalinas y una gran diversidad cultural y natural.</p>
        </div>

        <div class="destination-card">
            <img src="calle.webp" alt="Casco Viejo">
            <h3>Casco Viejo</h3>
            <p>El centro histórico de la ciudad de Panamá, lleno de calles empedradas, arquitectura colonial y vibrante vida cultural.</p>
        </div>

    </div>

</main>

<footer>
    <p>© 2025 Turismo en Panamá</p>
</footer>

</body>
</html>
