<?php
header("Content-Type: application/json");
header('Access-Control-Allow-Origin: *');

//========================= Importamos la conexion
require '../includes/conexion.php';

try {

    //========================= Realizamos la consulta
    $consultaPedidosPlatillos = "SELECT * FROM pedidosPlatillos";
    $resultadoPedidosPlatillos = mysqli_query($db, $consultaPedidosPlatillos);
    $countPedidosPlatillos = mysqli_num_rows($resultadoPedidosPlatillos);

    if ($countPedidosPlatillos > 0 && $resultadoPedidosPlatillos) {
        while ($rowPedidosPlatillos = mysqli_fetch_assoc($resultadoPedidosPlatillos)) {

            $id = $rowPedidosPlatillos['idPedidosPlatillos'];
            $idPedidos = $rowPedidosPlatillos['idPedidos'];
            $idPlatillos = $rowPedidosPlatillos['idPlatillos'];

            $data[] = [
                "id" => utf8_encode($id),
                "idPedidos" => utf8_encode($idPedidos),
                "idPlatillos" => utf8_encode($idPlatillos),
            ];
        }

        //========================= Formamos el JSON
        $pedidosPlatillos = [
            "ok" => true,
            "data" => $data,
        ];

        //========================= Si la tabla esta vacia
    } else if ($countPedidosPlatillos == 0 && $resultadoPedidosPlatillos) {
        $pedidosPlatillos = [
            "ok" => true,
            "msg" => "Sin datos en la DB"
        ];

        //========================= Si hubo errores en la DB
    } else {
        $pedidosPlatillos = [
            "ok" => false,
            "msg" => "Error en la DB"
        ];
    }
} catch (\Throwable $th) {
    throw $th;
    var_dump($th);

    $pedidosPlatillos = [
        "ok" => false,
        "msg" => "Error en la DB"
    ];
}

//========================= Imprimimos el JSON
echo json_encode($pedidosPlatillos);
