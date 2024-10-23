<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Varios formularios</title>
    <?php
        error_reporting( E_ALL );
        ini_set( "display_errors", 1 );
        
        require('../05_funciones/temperaturas.php');//esto es para importar
        require('../05_funciones/edades.php');//esto es para importar
    ?>
</head>
<body>
<h1>Formulario temperaturas</h1>
    <form action="" method="post">
        <label for="temp">Temperatura</label>
        <input type="text" name="temp" placeholder="Introduce temperatura">
        <br>
        <label for="">Unidad original</label>
        <select name="origen" id="origen">
            <option value="celsius">Celsius</option>
            <option value="kelvin">Kelvin</option>
            <option value="fahrenheit">Fahrenheit</option>
        </select>
        <br>
        <label for="">Unidad final</label>
        <select name="destino" id="destino">
            <option value="celsius">Celsius</option>
            <option value="kelvin">Kelvin</option>
            <option value="fahrenheit">Fahrenheit</option>
        </select>
        <br>
        <input type="hidden" name="action" value="formulario_temperaturas">
        <input type="submit" value="Convertir">
    </form>

    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            //Formulario de temperaturas
            if($_POST["action"] == "formulario_temperaturas"){
                $temp = $_POST["temp"];
                $origen = $_POST["origen"];
                $destino = $_POST["destino"];
                
                if($temp !=""){
                    if(is_numeric($temp)){
                        if($origen == "celsius" and $temp >= -273.15){
                            echo convertirTemperatura($temp,$origen,$destino);
                        }elseif($origen == "celsius" and $temp < -273.15){
                            echo "<p>La temperatura no puede ser inferior a -273.15 celsius</p>";
                        }

                        if($origen == "kelvin" and $temp >= 0){
                            echo convertirTemperatura($temp,$origen,$destino);
                        }elseif($origen == "kelvin" and $temp < 0){
                            echo "<p>La temperatura no puede ser inferior a 0 kelvin</p>";
                        }

                        if($origen == "fahrenheit" and $temp >= -249.67){
                            echo convertirTemperatura($temp,$origen,$destino);
                        }elseif($origen == "fahrenheit" and $temp < -249.67){
                            echo "<p>La temperatura no puede ser inferior a -249.67 fahrenheit</p>";
                        }
                    }else{
                        echo "<p>La temperatura debe ser un numero</p>";
                    }
                }else{
                    echo "<p>Falta la temperatura</p>";
                }
            }
            
        }
    ?>

    <br><br>

    <h1>Formulario edades</h1>
    <form action="" method="post">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" placeholder="Introduzca nombre">
            <br>
            <label for="edad">Edad</label>
            <input type="text" name="edad" id="edad" placeholder="Introduzca edad">
            <input type="hidden" name="action" value="formulario_edades">
            <input type="submit" value="Enviar">
    </form>
    <br>
    
    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            //Formulario de edades
            if($_POST["action"] == "formulario_edades"){
                $nombre = $_POST["nombre"];
                $edad = $_POST["edad"];
                comprobarEdades($nombre,$edad);
            }

            
        }
        //en otro fichero nuevo ,poner todos los demas formularios
        //y hacerlo con funciones -->> almenos con 4 formularios
    ?>
</body>
</html>