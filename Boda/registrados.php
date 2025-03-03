<?php
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
  <title>Lista de Registrados - Boda</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container my-5">
    <h1 class="text-center mb-4">Lista de Asistentes a la Boda</h1>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>#</th>
          <th>Nombre</th>
          <th>Apellidos</th>
          <th>Autobús</th>
          <th>Alergias</th>
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
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
