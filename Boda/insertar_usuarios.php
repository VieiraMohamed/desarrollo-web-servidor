<?php
include 'conexion.php'; // Conexión a la base de datos

// Definir los usuarios y las contraseñas en texto plano
$usuario1 = 'alba';
$contraseña1 = 'contraseña1'; // La contraseña en texto claro
$contraseña_hash1 = password_hash($contraseña1, PASSWORD_DEFAULT); // Hasheamos la contraseña

$usuario2 = 'javi';
$contraseña2 = 'contraseña2'; // La contraseña en texto claro
$contraseña_hash2 = password_hash($contraseña2, PASSWORD_DEFAULT); // Hasheamos la contraseña

// Insertar los usuarios con las contraseñas hasheadas
$sql = "INSERT INTO usuarios (usuario, contraseña) VALUES
        ('$usuario1', '$contraseña_hash1'),
        ('$usuario2', '$contraseña_hash2')";

try {
    $pdo->exec($sql);
    echo "Usuarios insertados correctamente.";
} catch (PDOException $e) {
    echo 'Error al insertar usuarios: ' . $e->getMessage();
}
?>
