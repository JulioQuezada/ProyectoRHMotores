<!--codigo php para el control de sesiones y llamar al funciones.php -->
<?php
include("funciones_autos.php");
error_reporting();
session_start();

if($_SESSION["ESTADO"]=="LOGEADO" && $_SESSION["rol"] == 1  ){

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
        <li class="nav-item active">
          <a class="nav-link" href="autos.php">Autos <span class="sr-only">(current)</span></a>
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
    
  <!-- Contenedor principal -->
<div class="container">
  <!-- Lista de elementos -->
  <ul class="list-group">
    <!-- Encabezado de la sección -->
    <li class="list-group-item">
      <!-- Grupo de elementos -->
      <div class="input-group flex-nowrap">
        <!-- Etiqueta del grupo -->
        <span class="input-group-text" id="addon-wrapping">
          <!-- Título del formulario -->
          <h1><b>Nuevo Auto</b></h1>
        </span>
      </div>
    </li>
    <!-- Campo para ingresar la patente del auto -->
    <li class="list-group-item">
      <div class="input-group flex-nowrap">
        <!-- Etiqueta del campo -->
        <span class="input-group-text" id="addon-wrapping">Patente</span>
        <!-- Campo de entrada de texto -->
        <input type="text" class="form-control" name="newpatente" id="newpatente" placeholder="Patente" aria-label="Patente" aria-describedby="addon-wrapping" maxlength="6" oninput="this.value = this.value.toUpperCase()">
      </div>
    </li>
    <!-- Campo para ingresar el modelo del auto -->
    <li class="list-group-item">
      <div class="input-group flex-nowrap">
        <!-- Etiqueta del campo -->
        <span class="input-group-text" id="addon-wrapping">Modelo</span>
        <!-- Campo de entrada de texto -->
        <input type="text" class="form-control" name="newmodelo" id="newmodelo" placeholder="Modelo" aria-label="Modelo" aria-describedby="addon-wrapping">
      </div>
    </li>
    <!-- Menú desplegable para seleccionar el dueño del auto -->
    <li class="list-group-item">
      <select class="form-select" aria-label="Default select example" name="select" id="select">
        <option value="0" selected>Seleccione al dueño del auto</option>
        <!-- Consulta a la base de datos para obtener los dueños disponibles -->
        <?php
        // Establecer la conexión con la base de datos
        $rs3 = mysqli_query($cnn, "SELECT * FROM dueño");
        // Recorrer los resultados y agregar cada uno como una opción en el menú desplegable
        while ($row3 = mysqli_fetch_array($rs3)) {
        ?>
          <option value="<?php echo $row3['codigo'] ?>"><?php echo $row3['nombre'] ?></option>
        <?php } ?>
      </select>
    </li>
    <!-- Botón para agregar el nuevo auto a la base de datos -->
    <li class="list-group-item">
      <button type="submit" name="accion" value="agregar" class="btn btn-primary">Agregar</button>
    </li>
  </ul>
</div>



  <br>

  <div class="container">
  <ul class="list-group">

    <!-- Título de la sección de búsqueda -->
    <li class="list-group-item">
      <div class="input-group flex-nowrap">
        <span class="input-group-text" id="addon-wrapping">
          <h1><b>Buscar auto</b></h1>
        </span>
      </div>
    </li>

    <!-- Campo de entrada del nombre del dueño -->
    <li class="list-group-item">
      <div class="input-group flex-nowrap">
        <span class="input-group-text" id="addon-wrapping">Nombre Dueño</span>
        <input type="text" class="form-control" name="nom_dueño" id="nom_dueño" placeholder="Nombre Dueño" aria-label="Patente" aria-describedby="addon-wrapping" maxlength="50">
      </div>
    </li>

    <!-- Botón de búsqueda -->
    <li class="list-group-item">
      <button type="submit" name="accion" value="bu_patente" class="btn btn-success">Buscar</button>
    </li>

    <!-- Tabla de resultados de la búsqueda -->
    <table class="table table-dark table-striped">
      <tr>
        <td><?php echo "Patente" ?></td>
        <td><?php echo "Modelo" ?></td>
      </tr> 
      <tr>
        <td><?php echo $patente3?></td>
        <td><?php echo $modelo3?></td>
      </tr> 
    </table>

  </ul>
</div>
</form>

 <br>


<form action="" method="post">

<div class="container">
    <ul class="list-group">
      <li class="list-group-item"><div class="input-group flex-nowrap">
      <span class="input-group-text" id="addon-wrapping"><h1><b>Modificar</b></h1></span>
      </div></li>

      <li class="list-group-item"><div class="input-group flex-nowrap">
      <span class="input-group-text" id="addon-wrapping">Buscar Auto</span>
      <input type="text" class="form-control" name="buscar_patente" id="buscar_patente" placeholder="Patente" aria-label="Username" aria-describedby="addon-wrapping">
      </div></li>

      <li class="list-group-item">
        <div class="input-group flex-nowrap">
          <span class="input-group-text" id="addon-wrapping">Patente</span>
            <input type="text" class="form-control" name="mod_patente" id="mod_patente" value="<?php echo $patente2?>" placeholder="Patente" aria-label="Username" aria-describedby="addon-wrapping" oninput="this.value = this.value.toUpperCase()" readonly>
              <input type="hidden" name="patentex" id="patentex" value="<?php echo $patente1 ?>">
        </div>
      </li>

      <li class="list-group-item"><div class="input-group flex-nowrap">
      <span class="input-group-text" id="addon-wrapping">Modelo</span>
      <input type="text" class="form-control" name="mod_modelo" id="mod_modelo" value="<?php echo $modelo2?>" placeholder="Modelo" aria-label="Username" aria-describedby="addon-wrapping">
      </div></li>

      <li class="list-group-item">
      <label for="select1" class="form-label">Seleccione al dueño del auto</label>
      <select class="form-select" aria-label="Default select example" name="select1" id="select1">
        <?php
        $rs3 = mysqli_query($cnn, "SELECT * FROM autos,dueño WHERE (patente= '$patente1')");
        while($row3 = mysqli_fetch_array($rs3))
      { ?>
      <option value="<?php echo $row3['codigo']?>" selected ><?php echo $row3['nombre']?></option>
      <?php }
      ?>
      </select>
    </li>


      <li class="list-group-item">
      <button type="submit" name="accion" value="buscar" class="btn btn-info">Buscar</button>  
      <button type="submit" name="accion" value="modificar" class="btn btn-warning" onclick="return confirm('¿Estás seguro de que deseas modificar este auto?')">Modificar</button> 
      <button type="submit" name="accion" value="eliminar" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este auto?')">Eliminar</button>
      </li>
    </ul>
  </div>



  <br>
    

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
