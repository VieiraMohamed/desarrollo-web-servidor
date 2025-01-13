<?php
    header("Content-Type: application/json");
    include("conexion_pdo.php");

    $metodo = $_SERVER["REQUEST_METHOD"];

    switch($metodo){
        case "GET":
            //echo json_encode(["metodo" => "get"]);
            manejarGet($_conexion);
            break;
        case "POST":
            echo json_encode(["metodo" => "post"]);
            break;
        case "PUT":
            echo json_encode(["metodo" => "put"]);
            break;
        case "DELETE":
            echo json_encode(["metodo" => "delete"]);
            break;
        default:
            echo json_encode(["metodo" => "otro"]);
            break;
    }

    function manejarGet($_conexion){
        $sql = "SELECT * FROM estudios";
        $stmt = $_conexion -> prepare($sql);
        $stmt -> execute();
        $resultado = $stmt -> fetchALL(PDO::FETCH_ASSOC);//equivalente al getResult de mysqli
        echo json_encode($resultado);
    }
?>