<?php
header("Content-Type: application/json");
header('Access-Control-Allow-Origin: *');

//========================= Importamos la conexion
require '../includes/conexion.php';

try {

    //========================= Realizamos la consulta
    $consultaPlatillos = "SELECT * FROM platillos";
    $resultadoPlatillos = mysqli_query($db, $consultaPlatillos);
    $countPlatillos = mysqli_num_rows($resultadoPlatillos);

    if ($countPlatillos > 0 && $resultadoPlatillos) {
        while ($rowPlatillos = mysqli_fetch_assoc($resultadoPlatillos)) {

            $id = $rowPlatillos['idPlatillos'];
            $nombre = $rowPlatillos['nombre'];
            $precio = $rowPlatillos['precio'];

            $data[] = [
                "id" => utf8_encode($id),
                "nombre" => utf8_encode($nombre),
                "precio" => utf8_encode($precio),
            ];
        }

        //========================= Formamos el JSON
        $platillos = [
            "ok" => true,
            "data" => $data,
        ];

        //========================= Si la tabla esta vacia
    } else if ($countPlatillos == 0 && $resultadoPlatillos) {
        $platillos = [
            "ok" => true,
            "msg" => "Sin datos en la DB"
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
