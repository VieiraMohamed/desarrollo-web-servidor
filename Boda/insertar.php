<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $autobus = $_POST['autobus'];
    $alergias = $_POST['alergias'];

    // Insertar en la base de datos
    $sql = "INSERT INTO asistentes (nombre, apellidos, autobus, alergias) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nombre, $apellidos, $autobus, $alergias]);

    echo "<script>alert('¡Registro exitoso!'); window.location.href='index.html';</script>";
}
?>
