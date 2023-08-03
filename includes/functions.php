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

        case 'editar_servicio':
            editar_servicio();
            break;

        case 'editar_cliente':
            editar_cliente();
            break;

        case 'editar_user':
            editar_user();
            break;
        case 'editar_password':
            editar_password();
            break;
        case 'saveReport':
            saveReport();
            break;
    }
}
function saveReport(){
    extract($_POST);
    include "db.php";
    $currentDate = date('Y-m-d');

    if($id_cli != "undefined" || $id_serv != "undefined") {
    $consulta = "INSERT INTO historial (id_cliente, id_servicio, pago, fecha) VALUES ('$id_cli', '$id_serv', '$pago', '$currentDate')";
    $resultado = mysqli_query($conexion, $consulta);
    $id = $conexion->insert_id;
    if ($resultado) {
        $response = array(
            'status' => 'success',
            'reportId' => $id
        );
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Ocurrió un error inesperado'
        );
}
}
else{
    $response = array(
        'status' => 'error',
        'message' => 'Ocurrió un error inesperado'
    );
}
echo json_encode($response);
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

function editar_servicio()
{
    require_once("db.php");

    extract($_POST);


    $consulta = "UPDATE servicios SET servicio = '$servicio' WHERE id = '$id' ";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        echo json_encode("correcto");
    } else {
        echo json_encode("error");
    }
}

function editar_cliente()
{
    require_once("db.php");

    extract($_POST);


    $consulta = "UPDATE clientes SET nombre = '$nombre', apellido = '$apellido',domicilio = '$domicilio',fecha = '$fecha',
     monto = '$monto', id_servicio = '$id_servicio' WHERE id = '$id' ";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        echo json_encode("correcto");
    } else {
        echo json_encode("error");
    }
}

function editar_user()
{
    require_once("db.php");
    extract($_POST);

    $consulta = "UPDATE usuarios SET usuario = '$usuario', correo = '$correo', telefono='$telefono' WHERE id = '$id' ";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        echo json_encode("correcto");
    } else {
        echo json_encode("error");
    }
}

function editar_password()
{
    require_once("db.php");
    extract($_POST);
    $password = trim($_POST['password']);
    $password = password_hash($password, PASSWORD_DEFAULT, ['cost' => 5]);
    $consulta = "UPDATE usuarios SET password = '$password' WHERE id = '$id' ";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        echo json_encode("correcto");
    } else {
        echo json_encode("error");
    }
}
