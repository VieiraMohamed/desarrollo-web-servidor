<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
         error_reporting(E_ALL);
         ini_set("display_errors", 1);
    ?>
    <title>Chistes ChuckNorris</title>
</head>
<body>

    


    <h1>Chistes de ChuckNorris</h1>
    <form action="" method="GET">
        <select name="categoria" value="categoria">
        <option value="" selected disabled>-- Selecciona una categoría --</option>
        <?php
            $apiURL = "https://api.chucknorris.io/jokes/categories";
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $apiURL);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $respuesta = curl_exec($curl);
            curl_close($curl);

            $categorias = json_decode($respuesta, true);
            
            foreach($categorias as $categoria){
                echo "<option value=".$categoria.">$categoria </option>";
            }
            
        ?>
        
        </select>
        <button type="submit">Cuéntame el chiste</button>
    </form>

    <?php
        $categoriaElegida = "";
        if(isset( $_GET["categoria"])){
            $categoriaElegida = $_GET["categoria"];


            $apiURL = "https://api.chucknorris.io/jokes/random?category=$categoriaElegida";
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $apiURL);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $respuesta = curl_exec($curl);
            curl_close($curl);

            $chiste = json_decode($respuesta, true);
            if(isset($chiste["value"])){
                echo "<p>". $chiste["value"]."</p>";
            }
            
        }else{
            echo "<p>Elige categoria</p>";
        }
        

        

    ?>

</body>
</html>