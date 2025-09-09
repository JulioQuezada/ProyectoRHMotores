<!--codigo php para el control de sesiones y llamar al funciones.php -->
<?php
include("funciones_taller_autos.php");
error_reporting();
session_start();

if ($_SESSION["ESTADO"] == "LOGEADO" && ($_SESSION["rol"] == 2)) {
  // Acciones o áreas a las que pueden acceder los usuarios con rol 1 o 2 que hayan iniciado sesión


?>
<!--Entrada de HTML5 (Head) -->
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
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav"
      aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="menu.php">Orden de Trabajo</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="menu_autos.php">Autos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="menu_clientes.php">Clientes</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle bg-secondary" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
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
  <!-- Formulario para agregar un nuevo auto a la base de datos -->
  <div class="container">
  <form action="agregar_auto.php" method="POST">

    <!-- Encabezado del formulario -->
    <div class="list-group-item">
      <div class="input-group flex-nowrap">
        <span class="input-group-text" id="addon-wrapping">
          <h1><b>Agregar Nuevo Auto</b></h1>
        </span>
      </div>
    </div>

    <!-- Campo para ingresar la patente del auto -->
    <div class="list-group-item">
      <div class="input-group flex-nowrap">
        <span class="input-group-text" id="addon-wrapping">Patente</span>
        <input type="text" class="form-control" name="newpatente" id="newpatente" placeholder="Patente" aria-label="Patente" aria-describedby="addon-wrapping" maxlength="6">
      </div>
    </div>

    <!-- Campo para ingresar el modelo del auto -->
    <div class="list-group-item">
      <div class="input-group flex-nowrap">
        <span class="input-group-text" id="addon-wrapping">Modelo</span>
        <input type="text" class="form-control" name="newmodelo" id="newmodelo" placeholder="Modelo" aria-label="Modelo" aria-describedby="addon-wrapping">
      </div>
    </div>

    <!-- Menú desplegable para seleccionar al dueño del auto -->
    <div class="list-group-item">
      <select class="form-select" aria-label="Dueño del auto" name="select" id="select">
        <option value="0" selected>Seleccione al dueño del auto</option>

        <!-- Código PHP para obtener la lista de dueños desde la base de datos -->
        <?php
          $rs3 = mysqli_query($cnn, "SELECT * FROM dueño");
          while($row3 = mysqli_fetch_array($rs3))
          { ?>
              <option value="<?php echo $row3['codigo']?>"><?php echo $row3['nombre']?></option>
          <?php }
        ?>

      </select>
    </div>

    <!-- Botón para enviar el formulario -->
    <div class="list-group-item">
      <button type="submit" name="accion" value="agregar" class="btn btn-primary">Agregar</button>
    </div>

  </form>
</div>

<form action="" method="post">
  <br>

  <div class="container">
    <ul class="list-group">
        <!-- Título de la sección de búsqueda -->
        <li class="list-group-item">
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="addon-wrapping">
                    <h1><b>Buscar auto por cliente</b></h1>
                </span>
            </div>
        </li>

        <!-- Campo de entrada para el nombre del propietario -->
        <li class="list-group-item">
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="addon-wrapping">Nombre Dueño</span>
                <input type="text" class="form-control" name="nom_dueño" id="nom_dueño" placeholder="Nombre Dueño" aria-label="Patente" aria-describedby="addon-wrapping" maxlength="50">
            </div>
        </li>

        <!-- Botón de búsqueda -->
        <li class="list-group-item">
            <button type="submit" name="accion" value="bu_patente" class="btn btn-success btn-block">Buscar</button>
        </li>

        <!-- Tabla para mostrar los resultados -->
        <div class="table-responsive">
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                        <th>Patente</th>
                        <th>Modelo</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $patente3?></td>
                        <td><?php echo $modelo3?></td>
                    </tr> 
                </tbody>
            </table>
        </div>

    </ul>
</div>

    
</form>
      
<br>

<form action="" method="post">

  <div class="container">
    <ul class="list-group">
      <li class="list-group-item">

    <table class="table table-dark table-striped">
    <tr>
    <td><?php echo "Patente" ?></td>
    <td><?php echo "Modelo" ?></td>
    <td><?php echo "Nombre" ?></td>
    </tr> 
    <?php
      $rs2 = mysqli_query($cnn, "SELECT * FROM dueño, autos WHERE (dueño.codigo = autos.codigo_dueño)");
      while($row2 = mysqli_fetch_array($rs2))
      { ?>
      <tr>
      <td><?php echo $row2['patente'] ?></td>
      <td><?php echo $row2['modelo'] ?></td>
      <td><?php echo $row2['nombre'] ?></td>
      </tr> 
      <?php }
      
  ?>
  </table>
   </li>
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
