<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Random Dog</title>
  </head>
  <body>
    <h1>A Random Dog</h1>
    <a href="<?php echo "perrito_prueba.php" ?>">FETCH</a>
    <?php
      $url = "https://dog.ceo/api/breeds/image/random"; 

      // Fetch the data from the API
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
      $data = curl_exec($ch);
      curl_close($ch); 

      // Decode the JSON response to a PHP array
      $json = json_decode($data, true);
      $imageId = $json['message']; 

      echo '<img src=" '. $imageId . '  "style="width: 300px";">'; 

    
      
    ?>
    
  </body>
</html>
