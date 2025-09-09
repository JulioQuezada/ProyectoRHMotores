<?php
require_once('tcpdf/tcpdf.php');

// Asignar valores a las variables
$fecha_ingreso = $_GET['fecha_ingreso'];
$fecha_salida = $_GET['fecha_salida'];
$descripcion_trabajo = $_GET['descripcion_trabajo'];
$patente_auto = $_GET['patente_auto'];
$metodo_pago = $_GET['metodo_pago'];
$total = $_GET['total'];
$nombre_dueno = $_GET['nombre_dueno'];
$modelo_auto = $_GET['modelo_auto'];

// Crear una tabla y agregar las filas con los datos
$html = '<br>
            <table>
            <h4>Orden de trabajo</h4><br>
            <tr>
                <td><b>Nombre del dueño:</b></td>
                <td>'.$nombre_dueno.'</td>
            </tr>
            <tr>
                <td><b>Patente del auto:</b></td>
                <td>'.$patente_auto.'</td>
            </tr>
            <tr>
                <td><b>Modelo del auto:</b></td>
                <td>'.$modelo_auto.'</td>
            </tr>
            <tr>
                <td><b>Fecha de ingreso:</b></td>
                <td>'.$fecha_ingreso.'</td>
            </tr>
            <tr>
                <td><b>Fecha de salida:</b></td>
                <td>'.$fecha_salida.'</td>
            </tr>
            <tr>
                <td><b>Método de pago:</b></td>
                <td>'.$metodo_pago.'</td>
            </tr>
            <tr>
                <td><b>Total:</b></td>
                <td>'.$total.'</td>
            </tr>
            <tr>
                <td><b>Descripción del trabajo:</b></td>
                <td>'.$descripcion_trabajo.'</td>
            </tr>
        </table>';

// Crear el objeto TCPDF y generar el archivo PDF
$pdf = new TCPDF('P', 'mm', 'leter', true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('RHMotores');
$pdf->SetTitle('Orden de trabajo');
$pdf->SetMargins(15, 15, 15);
$pdf->SetHeaderMargin(0);
$pdf->SetFooterMargin(0);

// Agregar logo y título en la esquina superior izquierda
$pdf->setImageScale(2);
$pdf->AddPage();
$pdf->Image('logo.jpg', 5, 5, 30, 30);
$pdf->SetFont('helvetica', 'B', 14);
$pdf->Cell(0, 26, 'RH Motores', 0, 1, 'C');

$pdf->SetY(40);
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output('Orden de trabajo '.$nombre_dueno.'.pdf', 'I');
?>
