<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bucles</title>
</head>
<body>
    <h1>While con bucle</h1>
    <?php
        $i =1;
        echo "<ul>";
        while($i <= 10){
            echo "<li>$i</li>";
            $i++;
        }
        echo "</ul>";
    ?>

    <h1> Lista con While alternative</h1>
    <?php
        $i =1;
        echo "<ul>";
        while($i <= 10):
            echo "<li>$i</li>";
            $i++;
        endwhile;
        echo "</ul>";
    ?>
    <h1>Lista con FOR</h1>
    
    <?php
    echo ("<ul>");
        for($i = 1;$i <= 10;$i++){
            echo ("<li>$i</li>");
        }
        echo ("</ul>")
    ?>
    <h1>Lista con FOR alternativo</h1>
    
    <?php
    echo ("<ul>");
        for($i = 1;$i <= 10;$i++):
            echo ("<li>$i</li>");
        endfor;
        echo ("</ul>")
    ?>

        
   <h1>Lista con FOR con BREAK cursed0</h1>
    
    <?php
    //Código ofuscado
        echo ("<ul>");
        for($i = 1; ;$i++){
            if($i > 10){
                break;
            }
            echo ("<li>$i</li>");
        }
        echo ("</ul>")
    ?>

    
</body>
</html>