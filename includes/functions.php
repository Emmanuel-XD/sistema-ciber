<?php
if (isset($_POST['accion'])) {
    switch ($_POST['accion']) {
            //casos de registros
        case 'insertar_servicio':
            insertar_servicio();
            break;

        case 'insertar_cliente':
            insertar_cliente();
            break;
    }
}
function insertar_servicio()
{
    global $conexion;
    extract($_POST);
    include "db.php";

    $consulta = "INSERT INTO servicios (servicio) VALUES ('$servicio')";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        $response = array(
            'status' => 'success',
            'message' => 'Los datos se guardaron correctamente'
        );
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Ocurrió un error inesperado'
        );
    }

    echo json_encode($response);
}

function insertar_cliente()
{
    global $conexion;
    extract($_POST);
    $folio = mt_rand(100000000, 999999999);
    include "db.php";

    $consulta = "INSERT INTO clientes (folio,nombre,apellido,domicilio,fecha,monto, id_servicio) 
    VALUES ('$folio','$nombre', '$apellido','$domicilio','$fecha','$monto', '$id_servicio')";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        $response = array(
            'status' => 'success',
            'message' => 'Los datos se guardaron correctamente'
        );
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Ocurrió un error inesperado'
        );
    }

    echo json_encode($response);
}
