<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4</title>
</head>
<body>
    <!-- EJERCICIO 4: Realiza un formulario que funcione a modo de conversor de temperaturas. 
     Se introducirá en un campo de texto la temperatura, y luego tendremos un select para elegir
      las unidades de dicha temperatura, y otro select para elegir las unidades a las que queremos
       convertir la temperatura.
    Por ejemplo, podemos introducir "10", y seleccionar "CELSIUS", y luego "FAHRENHEIT". 
    Se convertirán los 10 CELSIUS a su equivalente en FAHRENHEIT.
    En los select se podrá elegir entre: CELSIUS, KELVIN y FAHRENHEIT. -->
    
    <h1>Ejercicio 4</h1>
    <form action="" method="post">
        <label for="temp">Temperatura</label>
        <input type="text" name="temp" placeholder="Introduce temperatura">
        <select name="origen" id="origen">
            <option value="celsius">Celsius</option>
            <option value="kelvin">Kelvin</option>
            <option value="fahrenheit">Fahrenheit</option>
        </select>
        <br>
        <select name="destino" id="destino">
            <option value="celsius">Celsius</option>
            <option value="kelvin">Kelvin</option>
            <option value="fahrenheit">Fahrenheit</option>
        </select>
        <input type="submit" value="Convertir">
    </form>

    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $temp = $_POST["temp"];
            $origen = $_POST["origen"];
            $destino = $_POST["destino"];
            $resultado = $temp;

            if($temp !=""){

            
                // Conversión de Celsius
                if($origen == "celsius"){
                    if($destino == "fahrenheit"){
                        $resultado = $temp * 9/5 + 32;
                    } elseif($destino == "kelvin"){
                        $resultado = $temp + 273.15;
                    }
                }
                // Conversión de Fahrenheit
                elseif($origen == "fahrenheit"){
                    if($destino == "celsius"){
                        $resultado = ($temp - 32) * 5/9;
                    } elseif($destino == "kelvin"){
                        $resultado = ($temp - 32) * 5/9 + 273.15;
                    }
                }
                // Conversión de Kelvin
                elseif($origen == "kelvin"){
                    if($destino == "celsius"){
                        $resultado = $temp - 273.15;
                    } elseif($destino == "fahrenheit"){
                        $resultado = ($temp - 273.15) * 9/5 + 32;
                    }
                }

                echo "<p>$temp $origen son $resultado $destino</p>";
            }else{
                echo "<h3>Faltan datos</h3>";
            }
        }
    ?>
</body>
</html>
