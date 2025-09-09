<?php
include("funciones_cuentas.php");
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
        <li class="nav-item active">
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

<form action="" method="post">
  <div class="container p-3">
  <!-- Título del formulario -->
  <li class="list-group-item">
      <div class="input-group flex-nowrap">
        <span class="input-group-text" id="addon-wrapping"><h1><b>Agregar Cuenta</b></h1></span>
      </div>
  </li>

  <ul class="list-group mt-4">
    <!-- Campo para ingresar un nuevo nombre de usuario -->
    <li class="list-group-item">
      <div class="input-group">
        <span class="input-group-text">Nuevo Usuario</span>
        <input type="text" class="form-control" name="NEWuser" id="NEWuser" placeholder="Usuario" maxlength="30" required>
      </div>
    </li>

    <!-- Campo para ingresar una nueva contraseña -->
    <li class="list-group-item">
      <div class="input-group">
        <span class="input-group-text">Contraseña</span>
        <input type="password" class="form-control" name="NEWpass" id="NEWpass" placeholder="Contraseña" maxlength="32" required>
      </div>
    </li>

    <!-- Campo para repetir la nueva contraseña -->
    <li class="list-group-item">
      <div class="input-group">
        <span class="input-group-text">Repita la Contraseña</span>
        <input type="password" class="form-control" name="NEWpass2" id="NEWpass2" placeholder="Repita Contraseña" maxlength="32" required>
      </div>
    </li>

    <!-- Selección de privilegios de la cuenta -->
    <li class="list-group-item">
      <div class="form-group">
    <label for="select">Privilegios de la cuenta</label>
    <select class="form-control" id="select" name="select" required>
      <option value="0" selected>Seleccione privilegios de la cuenta</option>
      <?php
        $rs3 = mysqli_query($cnn, "SELECT * FROM roles");
        while($row3 = mysqli_fetch_array($rs3))
        { ?>
          <option value="<?php echo $row3['id']?>"><?php echo $row3['nombre_rol']?></option>
        <?php }
      ?>
    </select>
  </div>
</li>


    <!-- Botón para agregar la nueva cuenta de usuario -->
    <li class="list-group-item text-center">
      <button type="submit" name="accion" value="agregar" class="btn btn-primary">Agregar</button>
    </li>
  </ul>
</div>

</form>
<br>

<div class="container">
    <ul class="list-group">
        <li class="list-group-item">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID Cuenta</th>
                            <th>Usuario</th>
                            <th>Permisos</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $rs2 = mysqli_query($cnn, "SELECT * FROM cuentas, roles WHERE (roles.id = cuentas.id_rol)");
                        while ($row2 = mysqli_fetch_array($rs2)) {
                            ?>
                            <tr>
                                <form action="funciones_cuentas.php" method="post">
                                    <td>
                                        <input type="hidden" name="idss" value="<?php echo $row2['id_cuentas'] ?>">
                                        <?php echo $row2['id_cuentas'] ?>
                                    </td>
                                    <td>
                                        <input type="text" name="txtusu" value="<?php echo $row2['usuario'] ?>">
                                    </td>
                                    <td>
                                        <select name="txtsel">
                                            <?php
                                            $rs3 = mysqli_query($cnn, "SELECT * FROM roles");
                                            while ($row3 = mysqli_fetch_array($rs3)) {
                                                $selected = ($row3['id'] == $row2['id_rol']) ? "selected" : "";
                                                echo "<option value='" . $row3['id'] . "' " . $selected . ">" . $row3['nombre_rol'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td>
                                        <button type="submit" name="accion" value="modificar" class="btn btn-warning" onclick="return confirm('¿Está seguro de que desea modificar esta cuenta?')">Modificar</button>
                                        <button type="submit" name="accion" value="eliminar" class="btn btn-danger" onclick="return confirm('¿Está seguro de que desea eliminar esta cuenta?')">Eliminar</button>
                                    </td>
                                </form>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
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
</body>
</html>

<?php

}else{
header("location:index.php");    
}
?>
