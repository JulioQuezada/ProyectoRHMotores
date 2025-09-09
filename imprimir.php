<?php
include("funciones_imprimir.php");
error_reporting();
session_start();

if ($_SESSION["ESTADO"] == "LOGEADO" && ($_SESSION["rol"] == 1 || $_SESSION["rol"] == 2)){

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>RH Motores</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="style1.css">
</head>
<body>
  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a class="navbar-brand" href="#">
      <img src="Logo.png" width="50" height="50" class="d-inline-block align-top" alt="Logo RH Motores">
      RH Motores
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="#">SII </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="menuadmin.php">Cuentas de Usuario <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="orden_trabajo.php">Orden de Trabajo</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="autos.php">Autos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="gastos.php">Gastos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="clientes.php">Clientes</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle bg-secondary" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Más opciones
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="logout.php">Cerrar Sesión</a>
            <a class="dropdown-item" href="imprimir.php">Imprimir</a>
            <a class="dropdown-item" href="buscar.php">Ver Todo</a>
          </div>
        </li>
      </ul>
    </div>
  </nav>
  
  <div class="container mt-5">
		<h1 class="mb-4">Buscar Orden de Trabajo</h1>
		<form method="POST">
			<div class="form-group">
				<label for="codigo">Código de Orden de Trabajo:</label>
				<input type="text" class="form-control" id="codigo" name="codigo" required>
			</div>
			<button type="submit" class="btn btn-primary">Buscar</button>
		</form>
    </div>

  <div class="container mt-5">
  <h2 class="mb-4">Resultados de búsqueda</h2>
  <form>
    <div class="row mb-3">
      <label for="inputCodigo" class="col-sm-2 col-form-label">Código</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="inputCodigo" name="codigo" value="<?php echo $codigo; ?>" readonly>
      </div>
    </div>
    <div class="row mb-3">
      <label for="inputFechaIngreso" class="col-sm-2 col-form-label">Fecha de ingreso</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="inputFechaIngreso" name="fecha_ingreso" value="<?php echo $fecha_ingreso; ?>" readonly>
      </div>
    </div>
    <div class="row mb-3">
      <label for="inputFechaSalida" class="col-sm-2 col-form-label">Fecha de salida</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="inputFechaSalida" name="fecha_salida" value="<?php echo $fecha_salida; ?>" readonly>
      </div>
    </div>
    <div class="row mb-3">
      <label for="inputDescripcionTrabajo" class="col-sm-2 col-form-label">Descripción</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="inputDescripcionTrabajo" name="descripcion_trabajo" value="<?php echo $descripcion_trabajo; ?>" readonly>
      </div>
    </div>
    <div class="row mb-3">
      <label for="inputPatenteAuto" class="col-sm-2 col-form-label">Patente del auto</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="inputPatenteAuto" name="patente_auto" value="<?php echo $patente_auto; ?>" readonly>
      </div>
    </div>
    <div class="row mb-3">
      <label for="inputEstado" class="col-sm-2 col-form-label">Estado</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="inputEstado" name="estado" value="<?php echo $estado; ?>" readonly>
      </div>
    </div>
    <div class="row mb-3">
      <label for="inputMetodoPago" class="col-sm-2 col-form-label">Método de pago</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="inputMetodoPago" name="metodo_pago" value="<?php echo $metodo_pago; ?>" readonly>
      </div>
    </div>
    <div class="row mb-3">
      <label for="inputTotal" class="col-sm-2 col-form-label">Total</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="inputTotal" name="total" value="<?php echo $total; ?>" readonly>
      </div>
    </div>
    <div class="row mb-3">
  <label for="inputNombreDueno" class="col-sm-2 col-form-label">Nombre del dueño</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" id="inputNombreDueno" name="nombre_dueno" value="<?php echo $nombre_dueno; ?>" readonly>
  </div>
</div>
<div class="row mb-3">
  <label for="inputModeloAuto" class="col-sm-2 col-form-label">Modelo del auto</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" id="inputModeloAuto" name="modelo_auto" value="<?php echo $modelo_auto; ?>" readonly>
  </div>
</div>
  </form>

<div class="row mb-3">
  <div class="col-sm-12 text-center">
  <a href="imprimir1.php?
fecha_ingreso=<?php echo $fecha_ingreso; ?>&
fecha_salida=<?php echo $fecha_salida; ?>&
descripcion_trabajo=<?php echo $descripcion_trabajo; ?>&
patente_auto=<?php echo $patente_auto; ?>&
metodo_pago=<?php echo $metodo_pago; ?>&
total=<?php echo $total; ?>&
nombre_dueno=<?php echo $nombre_dueno; ?>&
modelo_auto=<?php echo $modelo_auto; ?>"
class="btn btn-primary" target="_blank">Imprimir formulario en PDF</a>

  </div>
</div>

</div>


  <footer style="background-color: #333; color: #fff; text-align: center; padding: 10px 0; margin-top: 20px;">
   <p style="margin: 0;">&copy; RH Motores <?php echo date("Y"); ?>. Todos los derechos reservados.</p>
   </footer>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>

<?php

}else{
header("location:index.php");    
}
?>