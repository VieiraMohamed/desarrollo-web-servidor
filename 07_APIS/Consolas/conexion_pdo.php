<?php
    $_servidor = "localhost";
    $_usuario = "estudiante";
    $_contrasena = "estudiante";
    $_bd = "consolas_bd";

    try {
        $_conexion = new PDO("mysql:host=$_servidor;dbname=$_bd", $_usuario,$_contrasena);
        $_conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e){
        die("Error de conexión: " . $e -> getMessage());
    }
    /*
    Hacer una api con get y post para:
-animes
-estudios(ya hecho)
-consolas
-fabricantes

Cronograma:
-hoy:vamos a intentar acabar hasta el put y delete
-Viernes: práctica de prepared statements a papel
-lunes: vamos a ver añadir parametros a la url de get
-Miércoles : consumir api

-hacer put y delete para todo lo anterior
-para put ,vamos a modificar todo menos la clave primaria y la imagen
    */ 
?>



