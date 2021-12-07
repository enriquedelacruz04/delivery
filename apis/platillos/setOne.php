<?php
header("Content-Type: application/json");
header('Access-Control-Allow-Origin: *');

//========================= Importamos la conexion
require '../includes/conexion.php';

//========================= Parametros que nos llegan por POST
$nombre = utf8_decode($_POST['nombre']);
$precio = utf8_decode($_POST['precio']);
$edit = utf8_decode($_POST['edit']);

try {
    if ($edit == '0') {

        //========================= Realizamos la consulta
        $consultaPlatillos = "INSERT INTO platillos
        (
        nombre,
        precio
        )
        VALUES 
        (
        '$nombre',
        '$precio'
        )";

        $resultadoPlatillos = mysqli_query($db, $consultaPlatillos);
    } else {

        //========================= Realizamos la consulta
        $consultaPlatillos = "UPDATE platillos SET 
        nombre = '$nombre',
        precio = '$precio'

        WHERE idPlatillos = '$edit'";

        $resultadoPlatillos = mysqli_query($db, $consultaPlatillos);
    }

    //========================= Formamos el JSON
    if ($resultadoPlatillos) {
        $platillos = [
            "ok" => true,
        ];

        //========================= Si hubo errores en la DB
    } else {
        $platillos = [
            "ok" => false,
            "msg" => "Error en la DB"
        ];
    }
} catch (\Throwable $th) {
    throw $th;
    var_dump($th);

    $platillos = [
        "ok" => false,
        "msg" => "Error en la DB"
    ];
}

//========================= Imprimimos el JSON
echo json_encode($platillos);
