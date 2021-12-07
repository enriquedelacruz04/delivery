<?php
header("Content-Type: application/json");
header('Access-Control-Allow-Origin: *');

//========================= Importamos la conexion
require '../includes/conexion.php';

//========================= Parametros que nos llegan por POST
$nombre = utf8_decode($_POST['nombre']);
$codigoPostal = utf8_decode($_POST['codigoPostal']);
$idRutas = utf8_decode($_POST['idRutas']);
$edit = utf8_decode($_POST['edit']);

try {
    if ($edit == '0') {

        //========================= Realizamos la consulta
        $consultaColonias = "INSERT INTO colonias
        (
        nombre,
        codigoPostal,
        idRutas
        )
        VALUES 
        (
        '$nombre',
        '$codigoPostal',
        '$idRutas'
        )";

        $resultadoColonias = mysqli_query($db, $consultaColonias);
    } else {

        //========================= Realizamos la consulta
        $consultaColonias = "UPDATE colonias SET 
        nombre = '$nombre',
        codigoPostal = '$codigoPostal',
        idRutas = '$idRutas'

        WHERE idColonias = '$edit'";

        $resultadoColonias = mysqli_query($db, $consultaColonias);
    }

    //========================= Formamos el JSON
    if ($resultadoColonias) {
        $colonias = [
            "ok" => true,
        ];

        //========================= Si hubo errores en la DB
    } else {
        $colonias = [
            "ok" => false,
            "msg" => "Error en la DB"
        ];
    }
} catch (\Throwable $th) {
    throw $th;
    var_dump($th);

    $colonias = [
        "ok" => false,
        "msg" => "Error en la DB"
    ];
}

//========================= Imprimimos el JSON
echo json_encode($colonias);
