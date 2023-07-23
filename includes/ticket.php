<?php



require('../fpdf/fpdf.php');
date_default_timezone_set('America/Mexico_City');
$fecha = date("Y-m-d ");

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {

        //$this->image('', 150, 1, 40); // X, Y, Tamaño
        $this->Ln();
        // Arial bold 15
        $this->SetFont('Arial', 'B', 10);

        // Movernos a la derecha
        $this->Cell(100);

        // Título
        $this->setY(10);
        $this->setX(45);



        $this->SetFont('Arial', 'B', 17);
        $this->setY(15);
        $this->SetX(70);

        $this->image('../img/logo-transparente.png', 5, 4, 35);  // X, Y, Tamaño

        $this->Cell(70, 10, 'COMPROBANTE DE PAGO ', 0, 1, 'C');

        $this->SetFont('Arial', '', 12);

        $this->setY(30);
        $this->setX(75);
        $this->Cell(60, 4, 'CIBERNETIC INTERNET', 0, 1, 'C');
        include "db.php";
        extract($_GET);
        $consulta = "SELECT h.id, h.id_cliente, h.id_servicio, h.pago, h.fecha, c.folio, c.nombre, c.apellido, c.domicilio, s.servicio FROM historial h 
        INNER JOIN clientes c ON h.id_cliente = c.id INNER JOIN servicios s ON h.id_servicio = s.id WHERE h.id = $id;";

        $sql = mysqli_query($conexion, $consulta);
        if ($sql->num_rows > 0) {
            foreach ($sql as $key => $filas) {
            }
        }
        $this->SetFont('Arial', '', 10);
        $this->SetY(55);
        $this->SetX(-211);
        $this->Cell(60, 4, 'FOLIO: ' . utf8_decode($filas['folio']), 0, 1, 'C');

        $this->SetFont('Arial', '', 10);
        $this->setY(65);
        $this->setX(-197);
        $this->Cell(60, 4, 'FECHA DE IMPRESION: ' . utf8_decode($fecha = date("Y-m-d ")), 0, 1, 'C');



        // Salto de línea
        $this->SetFont('Arial', 'B', 10);
        $this->Ln(15);
        $this->SetX(20);


        $this->Ln(3);
        $this->SetFont('Arial', 'B', 10);
        $this->SetX(12);

        $this->Cell(55, 10, 'CLIENTE', 1, 0, 'C', 0);
        $this->Cell(72, 10, 'DIRECCION', 1, 0, 'C', 0);
        $this->Cell(35, 10, 'SERVICIO', 1, 0, 'C', 0,);
        $this->Cell(20, 10, 'IMPORTE', 1, 1, 'C', 0);
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);

        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página

        $this->Cell(0, 10, utf8_decode('Página') . $this->PageNo() . '/{nb}', 0, 0, 'C');
        //$this->SetFillColor(223, 229,235);
        //$this->SetDrawColor(181, 14,246);
        //$this->Ln(0.5);
    }
}
include "db.php";
$id = $_GET['id'];

$consulta = "SELECT h.id, h.id_cliente, h.id_servicio, h.pago, h.fecha, c.folio, c.nombre, c.apellido, c.domicilio, s.servicio FROM historial h 
INNER JOIN clientes c ON h.id_cliente = c.id INNER JOIN servicios s ON h.id_servicio = s.id WHERE h.id = $id";
$resultado = mysqli_query($conexion, $consulta);

$pdf = new PDF();

$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 0);
//$pdf->SetWidths(array(10, 30, 27, 27, 20, 20, 20, 20, 22));
while ($row = $resultado->fetch_assoc()) {

    $pdf->SetX(12);

    $pdf->Cell(55, 10,  $row['nombre'] . ' ' . $row['apellido'], 1, 0, 'L', 0);
    $pdf->Cell(72, 10, $row['domicilio'], 1, 0, 'L', 0);
    $pdf->Cell(35, 10, $row['servicio'], 1, 0, 'L', 0);
    $pdf->Cell(20, 10, '$' . $row['pago'], 1, 1, 'L', 0);

    $pdf->SetFont('Arial', 'B', 15);

    $pdf->setY(125);
    $pdf->setX(140);
    $pdf->Cell(60, 4, 'TOTAL: $' . $row['pago'] . ' MXN', 0, 1, 'C');
}
/////////////////////////////

$pdf->SetFont('Arial', 'B', 10);
$pdf->setY(200);
$pdf->setX(-190);
$pdf->Cell(60, 4, "CONDICIONES Y FORMA DE PAGO");

$pdf->SetFont('Arial', 'B', 9);
$pdf->setY(215);
$pdf->setX(-190);
$pdf->Cell(60, 4, "El pago se realizara en un plazo de 30 dias.");

$pdf->SetFont('Arial', 'B', 9);
$pdf->setY(225);
$pdf->setX(-190);
$pdf->Cell(60, 4, "Metodo de pago: En efectivo.");




$pdf->Output();
