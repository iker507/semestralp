<?php
session_start();

// Limpiar variables de sesión
session_unset();

// Destruir sesión
session_destroy();

// Evitar que quede en caché (importante)
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");

// Redirigir al inicio
header("Location: index.php");
exit;
?>
