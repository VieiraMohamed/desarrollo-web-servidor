<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nueva marca</title>
</head>
<body>
    <form action="{{route('marcas.store')}}" method="post">
        @csrf
        <label for="">Marca: </label>
        <input type="text" name="marca"><br><br>
        <label for="">Año: </label>
        <input type="number" name="ano_fundacion"><br><br>
        <label for="">País: </label>
        <input type="text" name="pais"><br><br>
        <input type="submit" value="Crear">
    </form>
</body>
</html>