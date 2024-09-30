<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplos</title>
</head>
<body>
    <?php
        /* 
        todos los arraus en php son asociativos,como los map
        de java
        tienen pares clave-valor
        */

        $numeros = [5,10,9,6,7,4];//forma de declarar un array
        $numeros = array (6,10,9,4,3);//otra forma de hacer ARRAYS
        print_r($numeros);#PRINT RELACIONAL

        echo "<br><br>";

        $animales = ["Perro","Gato","Ornitorrinco","Suricato","Capibara"];
        $animales = [
            "A01" => "Perro",//la ID solo debe llevar o string o entero 
            "A02" => "Gato",
            "A03" => "Ornitorrinco",
            "A04" => "Suricato",
            "A05" => "Capibara",
        ];
        //print_r($animales);
        echo "<p>" . $animales["A01"] . "</p>";
        
    ?>
</body>
</html>