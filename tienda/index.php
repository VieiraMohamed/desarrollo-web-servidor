<!-- listado con los productos que podran ver todos los usuarios,perosin botones de borrar y editar
 , sin iniciar sesion,SINO NO SE INICIA SESION SOLO SE PODRA ACCESDER A INICIAR_SESIO.PHP
 O AL INDEX.PHP DE TIENDA
 -SI SE INTENTA ACCEDER A CUALQUIER OTRA PAGINA SIN INICIAR SESION,REDIGIRA A INICIAR_SESION.PHP
 DONDE TAMBIEN HABRA UN BOTON PARA IR AL INDEX.PHP DE TIENDA
 -CUANDO SE INICIA SESION,REDIGIRA AL INDEX.PHP DE TIENDA
 .EN INDEX.PHP DE TIENDA,SI NO SE HA INICIADO SESION,SE MOSTRARA EL BOTON DE INICIAR SESION
 -EN INDEX.PHP DE TIENDA,SI SE HA INICIADO SESION,SE MOSTRARA EL BOTON DE CERRAR SESION Y EL NOMBRE DE USUARIO LOGUEADO
 Y BOTONES PARA IR A PRODCUTOS,A CATEGORIAS Y A MODIFICAR LOS CREDENCIALES
 
 
 UN NAV BAR DE BOOTRAB
 https://getbootstrap.com/docs/5.3/components/navs-tabs/
 
 
 
 vALIDACION DE USUARIO:
 usuario -> entre 3 y 15 caracter y solo puede tener letras y numeros
 contraseña -> entre 8 y 15 caracteres y tiene que tener letras en mayu y minus,algun numero y puede tener 
 caracteres especiales (consultar expesion regexr)
 
 VALIDACION PRODUCTOS:
 nombre -> minimo 2 caracteres,maximos los de duga la base de datosm solo puede tener letras,espacion
 en blanco y numeros
 precio -> minimo 0 ymaximo lo que aguanta la bsa de datos.Tiene que ser un numero
 descripcion -> maximo 255 caracteres,poner lo que os de la gana
 stock -> minimo 0 y maximo lo que permita nuestra base de datos. tiene que ser un numero
 imagen -> no hace falta,si alguien quierer podeis buscaros la vida y puntuara favorablemente
 !!  NO PODEIS VALIDAR ABSOLUTAMENTE NADA CON HTML BAJO PENA DE SUSPENSO
 
 SI SE INTENTA INSERTAR-->

 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    
    require('./util/conexion.php');
    session_start();
 
    ?>
</head>
<body>
<div class="container">

    <div class="d-flex justify-content-center"> 
        <?php if (isset($_SESSION["usuario"])) {
            echo "<h2>Bienvenid@ ". $_SESSION["usuario"] . "</h2>"; 
            } else { 
                echo "<h2>Bienvenid@ invitado</h2>"; 
            } ?> 
    </div>

    <?php
    

    // si el formulario es enviado por POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // obtener el id_producto desde el formulario
        $id_producto = $_POST["id_producto"];
        //echo "<h1>Borrando producto con ID: $id_producto</h1>";

        // borrar producto usando el id correcto
        $sql = "DELETE FROM productos WHERE id_producto = $id_producto";
        if ($_conexion->query($sql)) {
            echo "<p class='text-success'>Producto eliminado correctamente.</p>";
        } else {
            echo "<p class='text-danger'>Error al eliminar el producto: " . $_conexion->error . "</p>";
        }
    }

    //  todos los productos
    $sql = "SELECT * FROM productos";
    $resultado = $_conexion->query($sql); //  usar la variable correcta
    ?>

    <!-- NAVBAR -->
    <?php
        if (isset($_SESSION["usuario"])) { ?>
            <ul class="nav justify-content-end">               
                <li class="nav-item">
                    <a class="nav-link" href="./categorias/index.php">Categorías</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./productos/index.php">Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./usuario/modificar_contrasena.php">Modificar Contraseña</a>
                </li>
                <li>
                    <a class="btn btn-warning" href="./usuario/cerrar_sesion.php">Cerrar sesión</a>
                </li>
            </ul>
        <?php } else { ?>
            <ul class="nav justify-content-end">
                <li class="nav-item">
                    <a class="nav-link" href="./usuario/registro.php">Registrarse</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./usuario/iniciar_sesion.php">Login</a>
                </li>
            </ul>
    <?php } ?>

    
    

    <!-- FIN NAVBAR -->

    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Categoría</th>
                <th>Stock</th>
                <th>Imagen</th>
                <th>Descripción</th>
            </tr>
        </thead>
        <tbody>
        <?php
            while($fila = $resultado -> fetch_assoc()) {
                echo "<tr>";
                echo "<td>". $fila["nombre"] ."</td>";
                echo "<td>". $fila["precio"] ."</td>";
                echo "<td>". $fila["categoria"] ."</td>";
                echo "<td>". $fila["stock"] ."</td>";
                ?>
                <td>
                    <img width='100' height='150' src="./productos/imagen/<?php echo $fila["imagen"]; ?>" >
                </td>
                <?php
                echo "<td>". $fila["descripcion"] ."</td>";
                ?>
                <?php
                    echo "</tr>";
            }
        ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
