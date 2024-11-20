<?php
    function  comprobarEdades(string $nombre,int $edad) : int{
        
        if($edad < 18){
            echo "<p>$nombre</p>";
        }
        elseif($edad >= 18 && $edad <= 65){
            echo "<p>$nombre es mayor de edad</p>";
        }
        elseif($edad > 65){
            echo "<p>$nombre está jubilado</p>";
        }
    }
?>