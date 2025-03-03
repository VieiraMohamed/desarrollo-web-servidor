<?php
session_start();
session_destroy(); // Eliminar toda la sesión
header("Location: login.php"); // Redirigir a login
exit();
?>
