<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    
    $apiURL = "https://api.jikan.moe/v4/top/anime";
   
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $apiURL);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $respuesta = curl_exec($curl);
    curl_close($curl);

    $datos = json_decode($respuesta, true);
    $animes = $datos["data"];
    //print_r($animes);
?>
<ol>
    <?php
        foreach($animes as $anime) { ?>
        <li><?php echo $anime["title"]?></li>        
        <?php }?>
</ol>
</body>
</html>
<!-- en top_anime.php
  mostrar en una tabla :
  -titulodel anime
  -nota
  -imagen-->