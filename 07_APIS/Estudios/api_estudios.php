<?php
    error_reporting( E_ALL );
    ini_set( "display_errors", 1 );

    header("Content-Type: application/json");
    include("conexion_pdo.php");

    $metodo = $_SERVER["REQUEST_METHOD"];
    $entrada = json_decode(file_get_contents('php://input'), true);
    /* 
    $entrada["numero"] -> <input name="numero">
    */

    switch($metodo){
        case "GET":
            //echo json_encode(["metodo" => "get"]);
            manejarGet($_conexion);
            break;
        case "POST":
            //echo json_encode(["metodo" => "post"]);
            manejarPost($_conexion, $entrada);
            break;
        case "PUT":
            //echo json_encode(["metodo" => "put"]);
            manejarPut($_conexion, $entrada);
            break;
        case "DELETE":
            //echo json_encode(["metodo" => "delete"]);
            manejarDelete($_conexion, $entrada);
            break;
        default:
            echo json_encode(["metodo" => "otro"]);
            break;
    }

    /* modificar el codigo paraque se pueda poner el parametro anno_fundacion = 2012
    y funcione conjuntamente con la ciudad 
    Es decir, podemos poner estas URL de ejemplo:
    -api_estudios?ciudad=Malaga
    -api_estudios=anno_fundacion=2010
    -api_estudios?ciudad=Tokio&anno_fundacion=2010*/
    function manejarGet($_conexion){
        if(isset($_GET["ciudad"]) && isset($_GET["anno_fundacion"])){
            $sql="SELECT * FROM estudios WHERE ciudad = :ciudad AND anno_fundacion = :anno_fundacion";
            $stmt = $_conexion -> prepare($sql);
            $stmt -> execute([
                "ciudad" => $_GET["ciudad"], 
                "anno_fundacion" => $_GET["anno_fundacion"]
            ]);
        }
        elseif(isset($_GET["anno_fundacion"])){
            $sql="SELECT * FROM estudios WHERE anno_fundacion = :anno_fundacion";
            $stmt = $_conexion -> prepare($sql);
            $stmt -> execute(["anno_fundacion" => $_GET["anno_fundacion"]]);
        }
        elseif(isset($_GET["ciudad"])){
            $sql="SELECT * FROM estudios WHERE ciudad = :ciudad";
            $stmt = $_conexion -> prepare($sql);
            $stmt -> execute(["ciudad" => $_GET["ciudad"]]);
        }else{
            $sql="SELECT * FROM estudios";
            $stmt = $_conexion -> prepare($sql);
            $stmt -> execute();
        }

        $resultado = $stmt -> fetchALL(PDO::FETCH_ASSOC);//equivalente al getResult de mysqli
        echo json_encode($resultado);
    }

    function manejarPost($_conexion, $entrada){
        $sql = "INSERT INTO estudios (nombre_estudio, ciudad, anno_fundacion)
            VALUES (:nombre_estudio, :ciudad, :anno_fundacion)";

        $stmt = $_conexion -> prepare($sql);
        $stmt -> execute([
            "nombre_estudio" => $entrada["nombre_estudio"],
            "ciudad" => $entrada["ciudad"],
            "anno_fundacion" => $entrada["anno_fundacion"]
        ]);
        if($stmt){
            echo json_encode(["mensaje" => "El estudio se ha insertado correctamente"]);
        }else{
            echo json_encode(["mensaje" => "Error al insertar el estudio"]);
        }
    }

    function manejarDelete($_conexion, $entrada){
        $sql = "DELETE FROM estudios WHERE nombre_estudio = :nombre_estudio";
        $stmt = $_conexion -> prepare($sql);
        $stmt -> execute([
            "nombre_estudio" => $entrada["nombre_estudio"]
        ]);
        if($stmt){
            echo json_encode(["mensaje" => "El estudio se ha borrado correctamente"]);
        }else{
            echo json_encode(["mensaje" => "Error al borrar el estudio"]);
        }
    }

    function manejarPut($_conexion, $entrada){
        $sql = "UPDATE estudios SET ciudad = :ciudad, anno_fundacion = :anno_fundacion
            WHERE nombre_estudio = :nombre_estudio";
        
        $stmt = $_conexion -> prepare($sql);
        $stmt -> execute([
            "nombre_estudio" => $entrada["nombre_estudio"],
            "ciudad" => $entrada["ciudad"],
            "anno_fundacion" => $entrada["anno_fundacion"]
        ]);
        if($stmt){
            echo json_encode(["mensaje" => "El estudio se ha actulizado correctamente"]);
        }else{
            echo json_encode(["mensaje" => "Error al actualizar el estudio"]);

        }
    }
?>