<?php
header("Content-Type: application/json");
header('Access-Control-Allow-Origin: *');

//========================= Importamos la conexion
require '../includes/conexion.php';

//========================= Parametros que nos llegan por POST
$id = $_POST['id'];

try {

    //========================= Realizamos la consulta
    $consultaPedidosPlatillos = "SELECT * FROM pedidos_platillos WHERE idPedidosPlatillos = '$id'";
    $resultadoPedidosPlatillos = mysqli_query($db, $consultaPedidosPlatillos);
    $countPedidosPlatillos = mysqli_num_rows($resultadoPedidosPlatillos);

    if ($countPedidosPlatillos > 0 && $resultadoPedidosPlatillos) {
        $rowPedidosPlatillos = mysqli_fetch_assoc($resultadoPedidosPlatillos);

        $id = $rowPedidosPlatillos['idPedidosPlatillos'];
        $nombre = $rowPedidosPlatillos['nombre'];
        $precio = $rowPedidosPlatillos['precio'];

        $data = [
            "id" => utf8_encode($id),
            "nombre" => utf8_encode($nombre),
            "precio" => utf8_encode($precio),
        ];

        //========================= Formamos el JSON
        $pedidosPlatillos = [
            "ok" => true,
            "data" => $data,
        ];
    }

    //========================= Si hubo errores en la DB
    else {
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
