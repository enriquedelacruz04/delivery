<?php
header("Content-Type: application/json");
header('Access-Control-Allow-Origin: *');

//========================= Importamos la conexion
require '../includes/conexion.php';

//========================= Parametros que nos llegan por POST
$fecha = utf8_decode($_POST['fecha']);
$hora = utf8_decode($_POST['hora']);
$importe = utf8_decode($_POST['importe']);
$idClientes = utf8_decode($_POST['idClientes']);
$idRepartidores = utf8_decode($_POST['idRepartidores']);
$edit = utf8_decode($_POST['edit']);

try {
    if ($edit == '0') {

        //========================= Realizamos la consulta
        $consultaPedidos = "INSERT INTO pedidos
        (
        fecha,
        hora,
        importe,
        idClientes,
        idRepartidores
        )
        VALUES 
        (
        '$fecha',
        '$hora',
        '$importe',
        '$idClientes',
        '$idRepartidores'
        )";

        $resultadoPedidos = mysqli_query($db, $consultaPedidos);
    } else {

        //========================= Realizamos la consulta
        $consultaPedidos = "UPDATE pedidos SET 
        fecha = '$fecha',
        hora = '$hora',
        importe = '$importe',
        idClientes = '$idClientes',
        idRepartidores = '$idRepartidores'

        WHERE idPedidos = '$edit'";

        $resultadoPedidos = mysqli_query($db, $consultaPedidos);
    }

    //========================= Formamos el JSON
    if ($resultadoPedidos) {
        $pedidos = [
            "ok" => true,
        ];

        //========================= Si hubo errores en la DB
    } else {
        $pedidos = [
            "ok" => false,
            "msg" => "Error en la DB"
        ];
    }
} catch (\Throwable $th) {
    throw $th;
    var_dump($th);

    $pedidos = [
        "ok" => false,
        "msg" => "Error en la DB"
    ];
}

//========================= Imprimimos el JSON
echo json_encode($pedidos);
