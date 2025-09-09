<?php
require_once('tcpdf/tcpdf.php');

$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('RHMotores');
$pdf->SetTitle('Formulario de trabajo');

$pdf->SetMargins(15, 15, 15);
$pdf->SetHeaderMargin(0);
$pdf->SetFooterMargin(0);

$pdf->AddPage();

$html = '
<h1>Formulario de trabajo</h1>
<div class="row mb-3">
  <label for="inputCodigo" class="col-sm-2 col-form-label">Código</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" id="inputCodigo" name="codigo" value="' . $codigo . '" readonly>
  </div>
</div>
<div class="row mb-3">
  <label for="inputFechaIngreso" class="col-sm-2 col-form-label">Fecha de ingreso</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" id="inputFechaIngreso" name="fecha_ingreso" value="' . $fecha_ingreso . '" readonly>
  </div>
</div>
<div class="row mb-3">
  <label for="inputFechaSalida" class="col-sm-2 col-form-label">Fecha de salida</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" id="inputFechaSalida" name="fecha_salida" value="' . $fecha_salida . '" readonly>
  </div>
</div>
<div class="row mb-3">
  <label for="inputDescripcionTrabajo" class="col-sm-2 col-form-label">Descripción</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" id="inputDescripcionTrabajo" name="descripcion_trabajo" value="' . $descripcion_trabajo . '" readonly>
  </div>
</div>
<div class="row mb-3">
  <label for="inputPatenteAuto" class="col-sm-2 col-form-label">Patente del auto</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" id="inputPatenteAuto" name="patente_auto" value="' . $patente_auto . '" readonly>
  </div>
</div>
<div class="row mb-3">
  <label for="inputEstado" class="col-sm-2 col-form-label">Estado</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" id="inputEstado" name="estado" value="' . $estado .
    '" readonly>

    </div>
  </div>';
  $pdf->writeHTML($html, true, false, true, false, '');
  
  $pdf->Output('formulario_trabajo.pdf', 'D');
  ?>