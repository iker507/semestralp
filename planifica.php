<?php session_start(); include "conexion.php"; ?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Planifica tu Viaje</title>

<style>
body{
    font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;
    margin:0; padding:0;
    background:#f0f8ff;
    padding-top:140px;
    padding-bottom:80px;
}
header{
    background:#0038a8;color:white;
    padding:1em;
    display:flex;justify-content:space-between;align-items:center;
    position:fixed;top:0; width:100%; z-index:1000;
    box-shadow:0 2px 4px rgba(0,0,0,0.1);
}
.left-zone{display:flex;align-items:center; gap:12px;}
.logo{width:80px;height:80px;display:flex;align-items:center;justify-content:center;}
.logo img{ max-width:100%;max-height:100%;object-fit:contain; }
.cart-btn{ background:white;color:#0038a8; padding:8px 12px;border-radius:6px; text-decoration:none;font-weight:bold;}
nav ul{list-style:none;display:flex; gap:20px;margin:0;padding:0;}
nav ul li a{color:white;text-decoration:none;font-weight:bold;}
.auth-buttons{display:flex;align-items:center;margin-right:20px;}
.auth-buttons a{background:white;color:#0038a8;padding:8px 10px;border-radius:6px;text-decoration:none;margin-left:8px;font-weight:bold;}
main{ max-width:900px;margin:auto;padding:2em;}
form{background:white;padding:2em; border-radius:8px; box-shadow:0 4px 6px rgba(0,0,0,0.1);}
label{ font-weight:bold; }
input, select{ width:100%;padding:10px;margin-top:6px;margin-bottom:15px;border-radius:6px;border:1px solid #ccc;}
button{ 
    background:#0038a8; /* azul */
    color:white; /* letras blancas */
    padding:10px 20px;
    border:none;
    border-radius:6px;
    font-weight:bold;
    cursor:pointer;
}
#precio_total{ font-weight:bold; margin-top:10px; }
</style>
</head>

<body>

<header>
    <div class="left-zone">
        <div class="logo"><img src="logo.webp" alt="logo"></div>
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
<h2>Planifica tu viaje</h2>

<form action="guardar_plan.php" method="POST" id="formulario">
    <label>Nombre</label>
    <input type="text" name="nombre_viajero" required>

    <label>Destino</label>
    <select name="destino" id="destino" required>
        <option value="Canal de Panamá">Canal de Panamá</option>
        <option value="Bocas del Toro">Bocas del Toro</option>
        <option value="Casco Viejo">Casco Viejo</option>
    </select>

    <label>Tipo de viaje</label>
    <select name="tipo_viaje" id="tipo_viaje" required>
        <option value="Normal">Normal</option>
        <option value="VIP">VIP</option>
    </select>

    <label>Fecha estimada</label>
    <input type="date" name="fecha_viaje" required>

    <p id="precio_total">Precio total: $0</p>

    <button type="submit">Enviar solicitud</button>
</form>

<script>
// Precios según destino y tipo
const precios = {
    "Canal de Panamá": { "Normal": 25, "VIP": 50 },
    "Bocas del Toro": { "Normal": 50, "VIP": 80 },
    "Casco Viejo": { "Normal": 15, "VIP": 30 }
};

const destinoSelect = document.getElementById('destino');
const tipoSelect = document.getElementById('tipo_viaje');
const precioTotal = document.getElementById('precio_total');

function actualizarPrecio(){
    const destino = destinoSelect.value;
    const tipo = tipoSelect.value;
    const total = precios[destino][tipo];
    precioTotal.textContent = `Precio total: $${total}`;
}

destinoSelect.addEventListener('change', actualizarPrecio);
tipoSelect.addEventListener('change', actualizarPrecio);
window.addEventListener('load', actualizarPrecio);
</script>

</main>

</body>
</html>
