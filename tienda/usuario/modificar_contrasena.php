<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Contraseña</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .error{
            color:red;
        }
    </style>
    <?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    require('../util/conexion.php');
    session_start();

    if (!isset($_SESSION["usuario"])) {
        header("Location: iniciar_sesion.php");
        exit();
    }

    $usuario = $_SESSION["usuario"];
    $err_contrasena_actual = $err_contrasena = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $contrasena_actual = $_POST["contrasena_actual"];
        $nueva_contrasena = $_POST["nueva_contrasena"];
        $confirmar_contrasena = $_POST["confirmar_contrasena"];

        $sql = "SELECT contrasena FROM usuarios WHERE usuario = ?";
        $stmt = $_conexion->prepare($sql);
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows === 1) {
            $datos_usuario = $resultado->fetch_assoc();
            $hashed_contrasena_actual = $datos_usuario["contrasena"];
            
            // Añadiendo depuración
            echo "Contraseña ingresada: $contrasena_actual<br>";
            echo "Contraseña almacenada (hashed): $hashed_contrasena_actual<br>";

            if (password_verify($contrasena_actual, $hashed_contrasena_actual)) {
                if ($nueva_contrasena === $confirmar_contrasena) {
                    $hashed_contrasena = password_hash($nueva_contrasena, PASSWORD_DEFAULT);
                    $sql_update = "UPDATE usuarios SET contrasena = ? WHERE usuario = ?";
                    $stmt_update = $_conexion->prepare($sql_update);
                    $stmt_update->bind_param("ss", $hashed_contrasena, $usuario);
                    if ($stmt_update->execute()) {
                        echo "<p class='text-success'>Contraseña actualizada correctamente.</p>";
                    } else {
                        echo "<p class='text-danger'>Error al actualizar la contraseña: " . $_conexion->error . "</p>";
                    }
                } else {
                    $err_contrasena = "Las nuevas contraseñas no coinciden.";
                }
            } else {
                $err_contrasena_actual = "La contraseña actual es incorrecta.";
            }
        } else {
            $err_contrasena_actual = "El usuario no existe.";
        }
        $stmt->close();
    }
    ?>
</head>
<body>
    <div class="container">
        <h1>Cambiar Contraseña</h1>
        <form class="col-6" action="" method="post">
            <div class="mb-3">
                <label class="form-label">Contraseña Actual</label>
                <input class="form-control" type="password" name="contrasena_actual" required>
                <?php if (!empty($err_contrasena_actual)) echo "<span class='error'>$err_contrasena_actual</span>" ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Nueva Contraseña</label>
                <input class="form-control" type="password" name="nueva_contrasena" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Confirmar Nueva Contraseña</label>
                <input class="form-control" type="password" name="confirmar_contrasena" required>
                <?php if (!empty($err_contrasena)) echo "<span class='error'>$err_contrasena</span>" ?>
            </div>
            <div class="mb-3">
                <input class="btn btn-primary" type="submit" value="Cambiar Contraseña">
                <a class="btn btn-secondary" href="../index.php">Volver</a>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
