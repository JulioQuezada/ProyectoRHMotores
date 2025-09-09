<?php
include("funciones_orden_taller.php");
error_reporting();
session_start();

// Verificar si el usuario está logeado y tiene el rol correspondiente
if ($_SESSION["ESTADO"] == "LOGEADO" && $_SESSION["rol"] == 2) {
?>

<!-- Encabezado HTML -->
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
  <!-- Barra de navegación -->
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
        <li class="nav-item active">
          <a class="nav-link" href="menu.php">Orden de Trabajo</a>
        </li>
        <li class="nav-item">
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

  <div class="container">
    <!-- Formulario para crear una Orden de Trabajo -->
    <form action="crear_orden.php" method="POST">
      <div class="list-group-item">
        <div class="input-group flex-nowrap">
          <span class="input-group-text" id="addon-wrapping">
            <h1><b>Crear Orden de Trabajo</b></h1>
          </span>
        </div>
      </div>
      <div class="list-group-item">
        <div class="input-group">
          <!-- Etiqueta y campo para la descripción del trabajo -->
          <label for="newdes" class="form-label">Descripción del trabajo</label>
        </div>
        <div class="input-group">
          <textarea class="form-control" name="newdes" id="newdes" cols="30" rows="10" placeholder="Ingrese Descripción del trabajo" maxlength="200" required=""></textarea>
        </div>
      </div>
      <div class="list-group-item">
        <div class="input-group">
          <!-- Etiqueta y campo para la fecha -->
          <label for="newfecha" class="form-label">Fecha</label>
        </div>
        <div class="input-group">
          <input type="text" class="form-control" name="newfecha" id="newfecha" value="<?php echo $fechaActual; ?>" placeholder="Fecha" disabled>
        </div>
      </div>
      <div class="list-group-item">
        <!-- Select para seleccionar la patente del auto -->
        <select class="form-select" aria-label="Seleccione patente del auto" name="select" id="select">
          <option value="0" selected>Seleccione patente del auto</option>
          <?php
          $rs3 = mysqli_query($cnn, "SELECT * FROM autos");
          while ($row3 = mysqli_fetch_array($rs3)) {
            echo '<option value="' . $row3['patente'] . '">' . $row3['patente'] . '</option>';
          }
          ?>
        </select>
      </div>
      <div class="list-group-item">
        <!-- Botón para agregar la Orden de Trabajo -->
        <button type="submit" name="accion" value="agregar" class="btn btn-primary">Agregar</button>
      </div>
    </form>
  </div>

  <br>

  <form action="" method="post">
    <div class="container">
      <ul class="list-group">
        <li class="list-group-item">
          <!-- Tabla para mostrar la lista de órdenes de trabajo abiertas -->
          <table class="table table-dark table-striped">
            <tr>
              <td><?php echo "Codigo" ?></td>
              <td><?php echo "Fecha ingreso" ?></td>
              <td><?php echo "Descripcion trabajo" ?></td>
              <td><?php echo "Patente auto" ?></td>
              <td><?php echo "Estado" ?></td>
            </tr>
            <?php
            $rs2 = mysqli_query($cnn, "SELECT * FROM orden_trabajo WHERE (estado = 'abierto')");
            while ($row2 = mysqli_fetch_array($rs2)) {
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
} else {
  // Si el usuario no está logeado o no tiene el rol correspondiente, redirigir al inicio de sesión
  header("location:index.php");
}
?>
