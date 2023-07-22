<?php
require_once("../includes/db.php");


$searchTerm = $_GET['term'];

$query = "SELECT c.id, c.folio, c.nombre, c.apellido, c.domicilio, c.fecha, c.monto, c.id_servicio, s.servicio  
          FROM clientes c INNER JOIN servicios s ON c.id_servicio = s.id
          WHERE c.folio LIKE '%$searchTerm%' OR c.nombre LIKE '%$searchTerm%' OR c.apellido LIKE '%$searchTerm%' LIMIT 1";

$result = mysqli_query($conexion, $query);

$data = array();
while ($fila = mysqli_fetch_assoc($result)) {
    $data[] = array(
        'folio' => $fila['folio'],
        'nombre' => $fila['nombre'],
        'apellido' => $fila['apellido'],
        'domicilio' => $fila['domicilio'],
        'monto' => '$' . $fila['monto'],
        'servicio' => $fila['servicio']
    );
}


echo json_encode($data);
