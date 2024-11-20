<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
        error_reporting( E_ALL );
        ini_set( "display_errors", 1 );    
    ?>
</head>
<body>
    <!-- 
        CREAR UN FORMULARIO QUE RECIBA EL NOMBRE Y LA EDAD DE UNA PERSONA

        SI LA EDAD ES MENOR QUE 18, SE MOSTRARÁ EL NOMBRE

        SI LA EDAD ESTÁ ENTRE 18 Y 65,SE MOSTRARÁ EL NOMBRE Y QUE ES MAYOR DE EDAD

        SI LA EDAD ES MÁS DE 65, SE MOSTRARÁ EL NOMBRE Y QUE SE HA JUBILADO
    -->
        
        <form action="" method="post">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" placeholder="Introduzca nombre">
            <br>
            <label for="edad">Edad</label>
            <input type="text" name="edad" id="edad" placeholder="Introduzca edad">
            <input type="submit" value="Enviar">
        </form>
        <?php
            if($_SERVER["REQUEST_METHOD"]== "POST"){
                $nombre = $_POST["nombre"];
                $edad = $_POST["edad"];
                if($edad < 18){
                    echo "<p>$nombre</p>";
                }
                elseif($edad >= 18 && $edad <= 65){
                    echo "<p>$nombre es mayor de edad</p>";
                }
                elseif($edad > 65){
                    echo "<p>$nombre está jubilado</p>";
                }
            }
        ?>
    
</body>
</html>