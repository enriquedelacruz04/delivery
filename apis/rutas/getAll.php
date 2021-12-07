<?php
header("Content-Type: application/json");
header('Access-Control-Allow-Origin: *');

//========================= Importamos la conexion
require '../includes/conexion.php';

try {

    //========================= Realizamos la consulta
    $consultaRutas = "SELECT * FROM rutas";
    $resultadoRutas = mysqli_query($db, $consultaRutas);
    $countRutas = mysqli_num_rows($resultadoRutas);

    if ($countRutas > 0 && $resultadoRutas) {
        while ($rowRutas = mysqli_fetch_assoc($resultadoRutas)) {

            $id = $rowRutas['idRutas'];
            $nombre = $rowRutas['nombre'];
            $idRepartidores = $rowRutas['idRepartidores'];

            $data[] = [
                "id" => utf8_encode($id),
                "nombre" => utf8_encode($nombre),
                "idRepartidores" => utf8_encode($idRepartidores),
            ];
        }

        //========================= Formamos el JSON
        $rutas = [
            "ok" => true,
            "data" => $data,
        ];

        //========================= Si la tabla esta vacia
    } else if ($countRutas == 0 && $resultadoRutas) {
        $rutas = [
            "ok" => true,
            "msg" => "Sin datos en la DB"
        ];

        //========================= Si hubo errores en la DB
    } else {
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
