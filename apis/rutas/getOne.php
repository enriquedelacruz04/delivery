<?php
header("Content-Type: application/json");
header('Access-Control-Allow-Origin: *');

//========================= Importamos la conexion
require '../includes/conexion.php';

//========================= Parametros que nos llegan por POST
$id = $_POST['id'];

try {

    //========================= Realizamos la consulta
    $consultaRutas = "SELECT * FROM rutas WHERE idRutas = '$id'";
    $resultadoRutas = mysqli_query($db, $consultaRutas);
    $countRutas = mysqli_num_rows($resultadoRutas);

    if ($countRutas > 0 && $resultadoRutas) {
        $rowRutas = mysqli_fetch_assoc($resultadoRutas);

        $id = $rowRutas['idRutas'];
        $nombre = $rowRutas['nombre'];
        $idRepartidores = $rowRutas['idRepartidores'];

        $data = [
            "id" => utf8_encode($id),
            "nombre" => utf8_encode($nombre),
            "idRepartidores" => utf8_encode($idRepartidores),
        ];

        //========================= Formamos el JSON
        $rutas = [
            "ok" => true,
            "data" => $data,
        ];
    }

    //========================= Si hubo errores en la DB
    else {
        $rutas = [
            "ok" => false,
            "msg" => "Error en la DB"
        ];
    }
} catch (\Throwable $th) {
    throw $th;
    var_dump($th);

    $rutas = [
        "ok" => false,
        "msg" => "Error en la DB"
    ];
}

//========================= Imprimimos el JSON
echo json_encode($rutas);
