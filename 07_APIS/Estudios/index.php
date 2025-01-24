<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estudios</title>
</head>
<body>
    <form action="" method="GET">
        <label for="" name="ciudad">Ciudad</label>
        <input type="text" name="ciudad">
        <input type="submit" value="Enviar">
    </form>
    <?php
    
        $apiURL = "http://localhost/Ejercicios/07_APIS/Estudios/api_estudios.php";
        if(!empty($_GET["ciudad"])){
            $ciudad = $_GET["ciudad"];
            $apiURL = "$apiURL?ciudad=$ciudad";
        }
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $apiURL);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $respusta = curl_exec($curl);
        curl_close($curl);

        $estudios = json_decode($respusta, true);
        //print_r($estudios);
    ?>
    <table>
        <thead>
            <tr>
                <th>Estudios</th>
                <th>Ciudad</th>
                <th>Año fundación</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($estudios as $estudio){ ?>
                <tr>
                    <td><?php echo $estudio["nombre_estudio"]?></td>
                    <td><?php echo $estudio["ciudad"]?></td>
                    <td><?php echo $estudio["anno_fundacion"]?></td>
                </tr>
                <?php } ?>
        </tbody>
    </table>
    
</body>
</html>