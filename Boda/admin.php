<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php"); // Redirigir al login si no está autenticado
    exit();
}

include 'conexion.php';

$sql = "SELECT * FROM asistentes";
$stmt = $pdo->query($sql);
$asistentes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container my-5">
        <h1 class="text-center mb-4">Lista de Asistentes - Boda</h1>
        <a href="logout.php" class="btn btn-danger mb-4">Cerrar sesión</a>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Autobús</th>
                    <th>Alergias</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($asistentes as $index => $asistente): ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= htmlspecialchars($asistente['nombre']) ?></td>
                    <td><?= htmlspecialchars($asistente['apellidos']) ?></td>
                    <td><?= htmlspecialchars($asistente['autobus']) ?></td>
                    <td><?= htmlspecialchars($asistente['alergias']) ?></td>
                    <td>
                        <!-- Formulario de eliminación -->
                        <form action="eliminar.php" method="post" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $asistente['id'] ?>">
                            <button type="submit" class="btn btn-danger">Borrar</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>
