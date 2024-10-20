<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversor de divisas</title>
</head>
<body>
    <h1>Conversor de divisas</h1>
    <form action="" method="post">
        <label for="moneda" name="moneda"></label>
        <input type="text" name="moneda">
        <select name="origen" id="origen">
            <option value="euro">Euro</option>
            <option value="dolar">Dolar</option>
            <option value="yen">Yen</option>
        </select>
        <br>
        <select name="destino" id="destino">
            <option value="euro">Euro</option>
            <option value="dolar">Dolar</option>
            <option value="yen">Yen</option>
        </select>
        <input type="submit" value="Calcular">
    </form>

    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $moneda = $_POST["moneda"];
            $origen = $_POST["origen"];
            $destino = $_POST["destino"];
            $resultado = 0;
            if($origen != "" && $moneda !="" && $destino !=""){

                    if($origen == "euro"){
                        if($destino == "dolar"){
                            $resultado = $moneda * 1.09;
                        }elseif($destino == "yen"){
                            $resultado = $moneda * 163.38;
                        }
                    }
                    elseif($origen == "dolar"){
                        if($destino == "euro"){
                            $resultado = $moneda * 0.92;
                        }elseif($destino == "yen"){
                            $resultado = $moneda * 149.67;
                        }
                    }
                    elseif($origen == "yen"){
                        if($destino == "euro"){
                            $resultado = $moneda * 0.0061;
                        }elseif($destino == "dolar"){
                            $resultado = $moneda * 0.0067;
                        }
                    }
                    echo "<p>$resultado</p>";
            }else{
                echo "<h3>Faltan datos</h3>";
            }
        }
    ?>
</body>
</html>