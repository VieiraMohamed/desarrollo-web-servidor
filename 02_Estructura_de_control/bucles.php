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

    
</body>
</html>