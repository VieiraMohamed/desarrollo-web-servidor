<?php
$host = 'localhost';  // Cambiar si tu servidor MySQL está en otro host
$usuario = 'estudiante';    // Usuario de MySQL (root es el predeterminado)
$contraseña = 'estudiante';     // Contraseña de MySQL (deja vacío si no tienes contraseña)
$base_datos = 'boda'; // Nombre de la base de datos

try {
    $pdo = new PDO("mysql:host=$host;dbname=$base_datos", $usuario, $contraseña);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Error de conexión: ' . $e->getMessage();
}
?>
