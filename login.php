<?php
session_start();
include "conexion.php";

$msg = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = trim($_POST['correo']);
    $contrasena = $_POST['contrasena'];

    $stmt = $conexion->prepare("SELECT id, nombre, contrasena FROM usuarios WHERE correo = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows === 1) {
        $u = $res->fetch_assoc();
        if (password_verify($contrasena, $u['contrasena'])) {
            $_SESSION['user_id'] = $u['id'];
            $_SESSION['user_name'] = $u['nombre'];
            header("Location: index.php");
            exit;
        } else {
            $msg = "Contraseña incorrecta.";
        }
    } else {
        $msg = "Correo no registrado.";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Login - Turismo en Panamá</title>

<style>
body{
    font-family:'Segoe UI';
    background:#f0f8ff;
    margin:0;
    padding-top:140px; /* espacio para el header fijo */
    padding-bottom:80px; /* espacio para el footer fijo */
}

header{
    background:#0038a8;
    color:#fff;
    position:fixed;
    top:0;
    width:100%;
    padding:1em;
    display:flex;
    justify-content:center; /* centrado horizontal */
    align-items:center;
    z-index:1000;
    flex-wrap: wrap; /* para que no se corte en pantallas pequeñas */
    gap:12px;
}

header nav a{
    color:white;
    margin:0 8px;
    text-decoration:none;
    font-weight:bold;
}

header .auth-buttons{
    display:flex;
    gap:8px;
}

header .auth-buttons a{
    background:white;
    color:#0038a8;
    padding:8px 10px;
    border-radius:6px;
    text-decoration:none;
    font-weight:bold;
}

/* Caja central */
.form-box{
    width:90%;
    max-width:420px;
    margin:40px auto;
    background:#fff;
    padding:20px;
    border-radius:8px;
    box-shadow:0 2px 6px rgba(0,0,0,0.1);
}

input{
    width:100%;
    padding:10px;
    margin:8px 0;
    border:1px solid #ccc;
    border-radius:6px;
}

button{
    background:#0038a8;
    color:#fff;
    padding:10px;
    border:none;
    border-radius:6px;
    cursor:pointer;
    width:100%;
}

.alert{
    color:red;
    text-align:center;
}

footer{
    background:#0038a8;
    color:white;
    text-align:center;
    padding:12px;
    position:fixed;
    bottom:0;
    width:100%;
}
</style>
</head>
<body>

<header>
    <h1 style="margin:0;">Turismo en Panamá</h1>
    <div class="auth-buttons">
        <a href="carrito.php">🛒 Carrito</a>
        <a href="login.php">Iniciar sesión</a>
        <a href="registro.php">Registrarse</a>
    </div>
    <nav>
        <a href="index.php">Inicio</a>
        <a href="destinos.php">Destinos</a>
        <a href="planifica.php">Planifica tu viaje</a>
    </nav>
</header>

<div class="form-box">
    <h2>Iniciar sesión</h2>

    <?php if ($msg): ?>
        <p class="alert"><?=htmlspecialchars($msg)?></p>
    <?php endif; ?>

    <form method="POST">
        <input name="correo" type="email" placeholder="Correo" required>
        <input name="contrasena" type="password" placeholder="Contraseña" required>
        <button type="submit">Iniciar sesión</button>
    </form>
</div>

<footer>
    © 2024 Turismo en Panamá
</footer>

</body>
</html>
