<!--codigo php para el control de sesiones y llamar al funciones.php -->
<?php
include("funciones_taller_clientes.php");
error_reporting();
session_start();

if($_SESSION["ESTADO"]=="LOGEADO" && $_SESSION["rol"] == 2  ){

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
  <style>
    img,
    video {
      max-width: 100%;
      height: auto;
    }
  </style>
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
        <li class="nav-item">
          <a class="nav-link" href="menu.php">Orden de Trabajo</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="menu_autos.php">Autos</a>
        </li>
        <li class="nav-item active">
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
  <div class="container">
    <ul class="list-group">
    <li class="list-group-item"><div class="input-group flex-nowrap">
    <span class="input-group-text" id="addon-wrapping"><h1><b>Agregar Nuevo Cliente</b></h1></span>
    </div></li>

    <li class="list-group-item"><div class="input-group flex-nowrap">
    <span class="input-group-text" id="addon-wrapping">Nuevo Cliente</span>
    <input type="text" class="form-control" name="newcliente" id="newclientes" placeholder="Usuario" aria-label="Username" aria-describedby="addon-wrapping" maxlength="50" required="">
    </div></li>

    <li class="list-group-item"><div class="input-group flex-nowrap">
    <span class="input-group-text" id="addon-wrapping">Telefono</span>
    <input type="text" class="form-control" name="newfono" id="newfono" placeholder="Telefono" aria-label="Telefono" aria-describedby="addon-wrapping" maxlength="9" required="">
    </div></li>

    <li class="list-group-item"><div class="input-group flex-nowrap">
    <span class="input-group-text" id="addon-wrapping">Correo</span>
    <input type="text" class="form-control" name="newcorreo" id="newcorreo" placeholder="Correo" aria-label="Username" aria-describedby="addon-wrapping" maxlength="30">
    </div></li>

    <li class="list-group-item"><button type="submit" name="accion" value="agregar" class="btn btn-primary">Agregar</button></li>

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
    <td><?php echo "Nombre" ?></td>
    <td><?php echo "Telefono" ?></td>
    <td><?php echo "Correo" ?></td>
  </tr> 
    <?php
      $rs2 = mysqli_query($cnn, "SELECT * FROM dueño");
      while($row2 = mysqli_fetch_array($rs2))
      { ?>
      <tr>
      <td><?php echo $row2['nombre'] ?></td>
      <td><?php echo $row2['telefono'] ?></td>
      <td><?php echo $row2['correo'] ?></td>
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
