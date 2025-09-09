<!--codigo php para el control de sesiones y llamar al funciones.php -->
<?php
include("funciones_gastos.php");
error_reporting();
session_start();

if($_SESSION["ESTADO"]=="LOGEADO" && $_SESSION["rol"] == 1  ){

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
        <a class="nav-link" href="https://zeusr.sii.cl//AUT2000/InicioAutenticacion/IngresoRutClave.html?https://misiir.sii.cl/cgi_misii/siihome.cgi">SII</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="menuadmin.php">Cuentas de Usuario </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="orden_trabajo.php">Orden de Trabajo</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="autos.php">Autos</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="gastos.php">Gastos <span class="sr-only">(current)</span></a>
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
    <!-- Título -->
    <li class="list-group-item">
      <div class="input-group flex-nowrap">
        <span class="input-group-text" id="addon-wrapping">
          <h1><b>Crear Gastos</b></h1>
        </span>
      </div>
    </li>

    <!-- Select de Código de Orden -->
    <li class="list-group-item">
      <select class="form-select" aria-label="Default select example" name="select" id="select">
        <option value="0" selected>Seleccione Codigo de Orden</option>
        <?php
        $rs3 = mysqli_query($cnn, "SELECT codigo FROM orden_trabajo WHERE (estado = 'abierto')");
        while ($row3 = mysqli_fetch_array($rs3)) { ?>
          <option value="<?php echo $row3['codigo'] ?>"><?php echo $row3['codigo'] ?></option>
        <?php } ?>
      </select>
    </li>

    <!-- Repuestos -->
    <li class="list-group-item">
      <div class="input-group flex-nowrap">
        <span class="input-group-text" id="addon-wrapping">Respuestos</span>
        <input type="text" class="form-control" name="newrepuestos" id="newrepuestos" placeholder="Nombre Repuesto" aria-label="Username" aria-describedby="addon-wrapping">
      </div>
    </li>

    <!-- Valor de Repuestos -->
    <li class="list-group-item">
      <div class="input-group flex-nowrap">
        <span class="input-group-text" id="addon-wrapping">Valor Repuestos</span>
        <input type="text" class="form-control" name="newvalor" id="newvalor" placeholder="Valor Repuesto" aria-label="Username" aria-describedby="addon-wrapping">
      </div>
    </li>

    <!-- Mano de Obra -->
    <li class="list-group-item">
      <div class="input-group flex-nowrap">
        <span class="input-group-text" id="addon-wrapping">Mano de Obra</span>
        <input type="text" class="form-control" name="newobra" id="newobra" placeholder="Valor Mano de Obra" aria-label="Username" aria-describedby="addon-wrapping">
      </div>
    </li>

    <!-- Botón para agregar -->
    <li class="list-group-item">
      <button type="submit" name="accion" value="agregar" class="btn btn-primary">Agregar</button>
    </li>
  </ul>
</div>


  
<br>


<div class="container">
  <!-- Esta sección muestra la lista de órdenes de trabajo abiertas -->
  <div class="row justify-content-center">
    <div class="col">
      <h2>Órdenes de trabajo abiertas</h2>
      <table class="table table-striped table-dark">
        <thead>
          <tr>
            <th>Código</th>
            <th>Fecha ingreso</th>
            <th>Descripción trabajo</th>
            <th>Patente auto</th>
            <th>Estado</th>
          </tr>
        </thead>
        <tbody>
          <?php
          // Selecciona las órdenes de trabajo abiertas de la base de datos
          $rs2 = mysqli_query($cnn, "SELECT * FROM orden_trabajo WHERE estado = 'abierto'");
          while($row2 = mysqli_fetch_array($rs2)) {
            ?>
            <tr>
              <td><?php echo $row2['codigo'] ?></td>
              <td><?php echo $row2['fecha_ingreso'] ?></td>
              <td><?php echo $row2['descripcion_trabajo'] ?></td>
              <td><?php echo $row2['patente_auto'] ?></td>
              <td><?php echo $row2['estado'] ?></td>
            </tr> 
            <?php
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</form>

<br>

<form action="" method="post">

<div class="container">
  <div class="row">
    <div class="col-sm-12">
    <h2>Repuestos de trabajo abiertas</h2>
      <div class="table-responsive">
        <table class="table table-dark table-striped">
          <thead>
            <tr>
              <th>Codigo</th>
              <th>Repuestos</th>
              <th>Valor Repuestos</th>
              <th>Mano de Obra</th>
              <th>Codigo Orden</th>
              <th>Estado</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $rs4 = mysqli_query($cnn, "SELECT * FROM gastos WHERE (estado_gastos = 'abierto')");
              while($row4 = mysqli_fetch_array($rs4)) { ?>
                <tr>
                  <td><?php echo $row4['cod_gastos'] ?></td>
                  <td><?php echo $row4['repuestos'] ?></td>
                  <td><?php echo $row4['valor_repuesto'] ?></td>
                  <td><?php echo $row4['mano_obra'] ?></td>
                  <td><?php echo $row4['cod_orden'] ?></td>
                  <td><?php echo $row4['estado_gastos'] ?></td>
                </tr> 
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


</form>

<br>

<form action="" method="post">

<div class="container">
  <ul class="list-group">
    <!-- Título del formulario -->
    <li class="list-group-item">
      <div class="input-group flex-nowrap">
        <span class="input-group-text" id="addon-wrapping">
          <h1><b>Modificar y/o Eliminar Gastos</b></h1>
        </span>
      </div>
    </li>

    <!-- Campo para buscar el código de gastos -->
    <li class="list-group-item">
      <div class="input-group">
        <span class="input-group-text" id="addon-wrapping">Buscar Código de gastos</span>
        <input type="text" class="form-control" name="txtgastos" id="txtgastos" placeholder="Código de Gastos" aria-label="Username" aria-describedby="addon-wrapping">
        <input type="hidden" name="codigox" id="codigox" value="<?php echo $codigo ?>">
      </div>
    </li>

    <!-- Campo para ingresar el nombre del repuesto -->
    <li class="list-group-item">
      <div class="input-group">
        <span class="input-group-text" id="addon-wrapping">Repuestos</span>
        <input type="text" class="form-control" name="txtrepuestos" id="txtrepuestos" value="<?php echo $repuestos1?>" placeholder="Nombre Repuesto" aria-label="Username" aria-describedby="addon-wrapping">
      </div>
    </li>

    <!-- Campo para ingresar el valor del repuesto -->
    <li class="list-group-item">
      <div class="input-group">
        <span class="input-group-text" id="addon-wrapping">Valor Repuestos</span>
        <input type="text" class="form-control" name="txtvalor" id="txtvalor" value="<?php echo $valor1?>" placeholder="Valor Repuesto" aria-label="Username" aria-describedby="addon-wrapping">
      </div>
    </li>

    <!-- Campo para ingresar el valor de la mano de obra -->
    <li class="list-group-item">
      <div class="input-group">
        <span class="input-group-text" id="addon-wrapping">Mano de Obra</span>
        <input type="text" class="form-control" name="txtobra" id="txtobra" value="<?php echo $obra1?>" placeholder="Valor Mano de Obra" aria-label="Username" aria-describedby="addon-wrapping">
      </div>
    </li>
                <br>
    
    <div class="form-group">
    <label for="txtselect"> <h5>Seleccione un código de orden:</h5></label>
    <select class="form-control" aria-label="Default select example" name="txtselect" id="txtselect">
      <?php
        $rs3 = mysqli_query($cnn, "SELECT codigo FROM orden_trabajo, gastos WHERE (orden_trabajo.codigo = gastos.cod_orden)  and (cod_gastos='$codigo')");
        while($row3 = mysqli_fetch_array($rs3)) { ?>
          <option selected value="<?php echo $row3['codigo']?>"><?php echo $row3['codigo']?></option>
        <?php }
      ?>
      <?php
        $rs3 = mysqli_query($cnn, "SELECT codigo FROM orden_trabajo WHERE estado = 'Abierto'");
        while($row3 = mysqli_fetch_array($rs3)) { ?>
          <option value="<?php echo $row3['codigo']?>"><?php echo $row3['codigo']?></option>
        <?php }
      ?>
    </select>
    <li class="list-group-item">
      <button type="submit" name="accion" value="buscar" class="btn btn-info">Buscar</button>  
      <button type="submit" name="accion" value="modificar" class="btn btn-warning" onclick="return confirm('¿Estás seguro de que deseas modificar este elemento?')">Modificar</button> 
      <button type="submit" name="accion" value="eliminar" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este elemento?')">Eliminar</button>
    </li>

  
  </div>
  </ul>
</div>
 
</form>


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
