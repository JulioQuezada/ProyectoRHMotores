<!--codigo php para el control de sesiones y llamar al funciones.php -->
<?php
include("funciones_orden_trabajo.php");
error_reporting();
session_start();

if($_SESSION["ESTADO"]=="LOGEADO" && $_SESSION["rol"] == 1  ){

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>RH Motores</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="style1.css">
  <!-- CSS del calendario -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

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
        <a class="nav-link" href="https://zeusr.sii.cl//AUT2000/InicioAutenticacion/IngresoRutClave.html?https://misiir.sii.cl/cgi_misii/siihome.cgi">SII</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="menuadmin.php">Cuentas de Usuario </a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="orden_trabajo.php">Orden de Trabajo <span class="sr-only">(current)</span></a>
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

  <form action="" method="post">
  <div class="container">
    <ul class="list-group">
      <li class="list-group-item">
        <div class="input-group flex-nowrap">
          <span class="input-group-text" id="addon-wrapping"><h1><b>Crear Orden</b></h1></span>
        </div>
      </li>

      <li class="list-group-item">
        <div class="input-group flex-nowrap">
          <span class="input-group-text" id="addon-wrapping">Descripcion del trabajo</span>
        </div>
        <textarea class="form-control" name="newdes" id="newdes" cols="30" rows="10" placeholder="Ingrese Descripcion del trabajo" maxlength="200" required=""></textarea>
      </li>

      <li class="list-group-item">
        <div class="input-group flex-nowrap">
          <span class="input-group-text" id="addon-wrapping">Fecha</span>
          <input type="text" class="form-control" name="newfecha" id="newfecha" value="<?php  echo $fechaMostrar;?>" placeholder="Contraseña" aria-label="Username" aria-describedby="addon-wrapping" disabled>
        </div>
      </li>

      <li class="list-group-item">
        <div class="input-group flex-nowrap">
          <span class="input-group-text" id="addon-wrapping">Seleccione patente del auto</span>
        </div>
        <select class="form-select" aria-label="Default select example" name="select" id="select">
          <option value="0" selected >Seleccione patente del auto</option>
          <?php
            $rs3 = mysqli_query($cnn, "SELECT * FROM autos");
            while($row3 = mysqli_fetch_array($rs3)) {
          ?>
            <option value="<?php echo $row3['patente']?>"><?php echo $row3['patente']?></option>
          <?php } ?>
        </select>
      </li>

      <li class="list-group-item">
        <button type="submit" name="accion" value="agregar" class="btn btn-primary btn-block">Agregar</button>
      </li>
    </ul>
  </div>
</form>



<br>

<form action="" method="post">
<div class="container">
  <ul class="list-group">
    <li class="list-group-item">
      <div class="input-group flex-nowrap">
        <span class="input-group-text" id="addon-wrapping"><h1><b>Mod Orden</b></h1></span>
      </div>
    </li>
    <li class="list-group-item">
      <div class="input-group flex-nowrap">
        <span class="input-group-text" id="addon-wrapping">Buscar por Codigo</span>
        <input type="text" class="form-control" name="txtcod" id="txtcod" placeholder="Ingrese Codigo" aria-label="Username" aria-describedby="addon-wrapping">
      </div>
    </li>
    <li class="list-group-item">
      <div class="input-group flex-nowrap">
        <span class="input-group-text" id="addon-wrapping">Patente</span>
        <input type="text" class="form-control" name="txtpat" id="txtpat" value="<?php echo $patente2?>" placeholder="Patente" aria-label="Username" aria-describedby="addon-wrapping" disabled>
      </div>
    </li>
    <li class="list-group-item">
      <div class="input-group flex-nowrap">
        <span class="input-group-text" id="addon-wrapping">Descripcion</span>
      </div>
      <textarea class="form-control" name="txtdes" id="txtdes" cols="30" rows="5" placeholder="Descripcion" aria-label="Username" aria-describedby="addon-wrapping"><?php echo $des2?></textarea>
    </li>
    <li class="list-group-item">
      <select class="form-select mb-3" aria-label="Default select example" name="select1" id="select1">
        <?php
        $rs3 = mysqli_query($cnn, "SELECT * FROM orden_trabajo WHERE (codigo = '$codigo')");
        while($row3 = mysqli_fetch_array($rs3))
        { ?>
          <option selected value="<?php echo $row3['patente_auto']?>"><?php echo $row3['patente_auto']?></option>
        <?php }
        ?>
      </select>
    </li>
    <li class="list-group-item">
      <input type="hidden" name="codigox" id="codigox" value="<?php echo $codigo ?>">
    </li>
    <li class="list-group-item d-flex justify-content-between">
      <button type="submit" name="accion" value="buscar" class="btn btn-info">Buscar</button>  
      <button type="submit" name="accion" value="modificar" class="btn btn-warning">Modificar</button> 
      <button type="submit" name="accion" value="eliminar" class="btn btn-danger">Eliminar</button>
    </li>
  </ul>
</div>

</form>


<br>


<div class="container">
  <form action="" method="post">
    <ul class="list-group">
      <li class="list-group-item">
        <div class="table-responsive">
          <table class="table table-dark table-striped">
            <thead>
              <tr>
                <th>Codigo</th>
                <th>Fecha ingreso</th>
                <th>Descripcion trabajo</th>
                <th>Patente auto</th>
                <th>Estado</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $rs2 = mysqli_query($cnn, "SELECT * FROM orden_trabajo WHERE (estado = 'abierto')");
              while($row2 = mysqli_fetch_array($rs2)) { ?>
                <tr>
                  <td><?php echo $row2['codigo'] ?></td>
                  <td><?php echo $row2['fecha_ingreso'] ?></td>
                  <td><?php echo $row2['descripcion_trabajo'] ?></td>
                  <td><?php echo $row2['patente_auto'] ?></td>
                  <td><?php echo $row2['estado'] ?></td>
                </tr> 
              <?php } ?>
            </tbody>
          </table>
        </div>
      </li>
    </ul>
  </form>
</div>


<br>

<form action="" method="post">
  <div class="container">
    <ul class="list-group">
      <li class="list-group-item">
        <div class="input-group flex-nowrap">
          <span class="input-group-text"><h1><b>Cerrar Orden</b></h1></span>
        </div>
      </li>

      <li class="list-group-item">
        <div class="input-group">
          <span class="input-group-text">Buscar por Codigo</span>
          <input type="text" class="form-control" name="close_cod" id="close_cod" placeholder="Ingrese Codigo" aria-label="Username" aria-describedby="addon-wrapping">
          <button type="submit" name="accion" value="clo_orden_search" class="btn btn-danger">buscar datos</button>
        </div>
      </li>

      <li class="list-group-item">
        <input type="hidden" name="codigoxx" id="codigoxx" value="<?php echo $codigo9 ?>">
      </li>

      <li class="list-group-item">
        <div class="input-group">
          <span class="input-group-text">fecha</span>
          <input type="text" class="form-control" name="close_fecha" id="close_fecha" value="<?php echo $fechaMostrar; ?>" placeholder="Patente" aria-label="Username" aria-describedby="addon-wrapping" disabled>
        </div>
      </li>

      <li class="list-group-item">
        <div class="input-group">
          <span class="input-group-text">Estado</span>
          <input type="text" class="form-control" name="close_estado" id="close_estado" value="<?php echo $estado9; ?>" placeholder="Cerrado" aria-label="Username" aria-describedby="addon-wrapping" disabled>
        </div>
      </li>

      <li class="list-group-item">
        <div class="input-group">
          <span class="input-group-text">Total</span>
          <input type="text" class="form-control" name="valor9" id="valor9" value="<?php echo $valor_total; ?>" placeholder="Total" aria-label="Username" aria-describedby="addon-wrapping" disabled>
        </div>
      </li>

      <li class="list-group-item">
        <div class="input-group">
          <span class="input-group-text">Método de Pago 1:</span>
          <select class="form-select" aria-label="Default select example" name="metodo_pago1" id="metodo_pago1">
            <option value="0" selected>Seleccione método de pago</option>
            <?php
              $rs7 = mysqli_query($cnn, "SELECT * FROM metodo_pago");
              while ($row7 = mysqli_fetch_array($rs7)) {
                echo '<option value="' . $row7['metodo'] . '">' . $row7['metodo'] . '</option>';
              }
            ?>
          </select>
        </div>
      </li>

      <li class="list-group-item">
        <div class="input-group">
          <span class="input-group-text">Cantidad Pagada 1:</span>
          <input type="number" class="form-control" name="cantidad_pago1" id="cantidad_pago1" step="0.01" placeholder="Ingrese la cantidad pagada">
        </div>
      </li>

      <li class="list-group-item">
        <div class="input-group">
          <span class="input-group-text">Método de Pago 2:</span>
          <select class="form-select" aria-label="Default select example" name="metodo_pago2" id="metodo_pago2">
            <option value="0" selected>Seleccione método de pago</option>
            <?php
              $rs8 = mysqli_query($cnn, "SELECT * FROM metodo_pago");
              while ($row8 = mysqli_fetch_array($rs8)) {
                echo '<option value="' . $row8['metodo'] . '">' . $row8['metodo'] . '</option>';
              }
            ?>
          </select>
        </div>
      </li>

      <li class="list-group-item">
        <div class="input-group">
          <span class="input-group-text">Cantidad Pagada 2:</span>
          <input type="number" class="form-control" name="cantidad_pago2" id="cantidad_pago2" step="0.01" placeholder="Ingrese la cantidad pagada" >
        </div>
      </li>

      <li class="list-group-item">
        <button type="submit" name="accion" value="clo_orden" class="btn btn-danger" onclick="return confirm('¿Está seguro de que desea cerrar la orden?')">Cerrar Orden</button>
      </li>

    </ul>
  </div>
</form>

<form action="" method="post">
  <div class="container">
    <ul class="list-group">
      
      <li class="list-group-item">
        <div class="input-group">
          <span class="input-group-text">Buscar por Método de Pago</span>
          <select class="form-select" aria-label="Default select example" name="search_metodo_pago" id="search_metodo_pago">
            <option value="0" selected>Seleccione método de pago</option>
            <?php
            $rs9 = mysqli_query($cnn, "SELECT DISTINCT metodo FROM metodo_pago");
            while ($row9 = mysqli_fetch_array($rs9)) {
              echo '<option value="' . $row9['metodo'] . '">' . $row9['metodo'] . '</option>';
            }
            ?>
          </select>
          <button type="submit" name="accion" value="buscar_por_metodo_pago" class="btn btn-danger">Buscar</button>
        </div>
      </li>

      <li class="list-group-item">
        <div class="input-group">
          <span class="input-group-text">Total Pagado</span>
          <input type="text" class="form-control" name="total_pagado" id="total_pagado" value="<?php echo $total_pagado; ?>" placeholder="Total Pagado" aria-label="Total Pagado" aria-describedby="addon-wrapping" disabled>
        </div>
      </li>
      
    </ul>
  </div>
</form>










<footer style="background-color: #333; color: #fff; text-align: center; padding: 10px 0; margin-top: 20px;">
   <p style="margin: 0;">&copy; RH Motores <?php echo date("Y"); ?>. Todos los derechos reservados.</p>
</footer>



  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <!-- Scripts del calendario -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.es.min.js"></script>

</body>
</html>

<?php

}else{
header("location:index.php");    
}
?>
