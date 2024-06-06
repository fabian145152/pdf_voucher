<?php
$servername = "localhost";
$username = "root";
$password = "belgrado";
$dbname = "pdf_voucher";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT viaje_no, origen, destino FROM voucher_nuevos";
$result = $conn->query($sql);
$row = $result->fetch_assoc();




require "./funciones/pdf/fpdf.php";


class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Logo
        $this->Image('./imagenes/logo_pampa.png', 10, 8, 33);
        // Arial bold 15
        $this->SetFont('Arial', 'B', 15);
        // Movernos a la derecha
        $this->Cell(80);
        // Título
        $this->Cell(70, 10, 'DELOITTE & CO S.A.', 1, 0, 'C');
        // Salto de línea
        $this->Ln(20);
    }

    // Pie de página
    function Footer()
    {
        // Posición a 1.5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, 'Página ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

    // Tabla simple
    function BasicTable($header, $data)
    {
        // Cabecera
        foreach ($header as $col)
            $this->Cell(40, 7, $col, 1);
        $this->Ln();
        // Datos
        while ($row = $data->fetch_assoc()) {
            foreach ($row as $col)
                $this->Cell(40, 6, $col, 1);
            $this->Ln();
        }
    }
}

// Crear instancia de PDF
$pdf = new PDF();
// Alias para el número de páginas
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 10);

// Cabecera de la tabla
$header = array('viaje_no', 'origen', 'destino');

// Datos de la tabla
$pdf->BasicTable($header, $result);

// Salida del PDF
$pdf->Output();
