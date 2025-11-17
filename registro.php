<?php
session_start();
include "conexion.php";

$msg = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $correo = trim($_POST['correo']);
    $contrasena = $_POST['contrasena'];

    if ($nombre === "" || $correo === "" || $contrasena === "") {
        $msg = "Completa todos los campos.";
    } else {
        $stmt = $conexion->prepare("SELECT id FROM usuarios WHERE correo = ?");
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $msg = "Ese correo ya está registrado.";
            $stmt->close();
        } else {
            $stmt->close();
            $hash = password_hash($contrasena, PASSWORD_DEFAULT);

            $ins = $conexion->prepare("INSERT INTO usuarios (nombre, correo, contrasena) VALUES (?, ?, ?)");
            $ins->bind_param("sss", $nombre, $correo, $hash);

            if ($ins->execute()) {
                $_SESSION['user_id'] = $ins->insert_id;
                $_SESSION['user_name'] = $nombre;
                header("Location: index.php");
                exit;
            } else {
                $msg = "Error al registrar: " . $conexion->error;
            }

            $ins->close();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Registro - Turismo en Panamá</title>

<style>
body{
    font-family:'Segoe UI', Tahoma, Verdana;
    margin:0;
    background:#f0f8ff;
    padding-top:140px; /* espacio para header fijo */
    padding-bottom:80px; /* espacio para footer fijo */
}

header{
    background:#0038a8;
    color:white;
    padding:1em;
    position:fixed;
    top:0;
    width:100%;
    box-shadow:0 2px 4px rgba(0,0,0,0.1);
    display:flex;
    justify-content:center; /* centrado */
    align-items:center;
    z-index:1000;
    flex-wrap: wrap;
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

.form-box{
    width:90%;
    max-width:420px;
    margin:40px auto;
    background:white;
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
    color:white;
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
    <h2>Registrarse</h2>

    <?php if ($msg): ?>
        <p class="alert"><?=htmlspecialchars($msg)?></p>
    <?php endif; ?>

    <form method="POST">
        <input name="nombre" placeholder="Nombre" required>
        <input name="correo" type="email" placeholder="Correo" required>
        <input name="contrasena" type="password" placeholder="Contraseña" required>
        <button type="submit">Crear cuenta</button>
    </form>

    <p style="text-align:center;margin-top:10px;">
        ¿Ya tienes cuenta? <a href="login.php">Iniciar sesión</a>
    </p>
</div>

<footer>
    © 2024 Turismo en Panamá
</footer>

</body>
</html>
