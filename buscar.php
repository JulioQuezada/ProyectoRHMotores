<?php
include("funciones_orden_trabajo.php");
error_reporting();
session_start();

if($_SESSION["ESTADO"]=="LOGEADO" && $_SESSION["rol"] == 1  ){


  ?>



<!DOCTYPE html>
<html lang="es">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
      body {
        font-family: arial;
        background-image: url('bg.png');
      }
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <title>Buscador</title>

</head>
<a class="btn btn-danger" href="menuadmin.php" role="button">Home</a>
<body>
<form action="" method="post">

<ul class="list-group">
  <div class="container">
        <li class="list-group-item">
        <span class="input-group-text" id="addon-wrapping"><h1><b>Orden de Trabajo completo</b></h1></span>
      <table class="table table-dark table-striped">
    <tr>
    <td><?php echo "Codigo" ?></td>
    <td><?php echo "Fecha ingreso" ?></td>
    <td><?php echo "Fecha salida" ?></td>
    <td><?php echo "Descripcion trabajo" ?></td>
    <td><?php echo "Patente auto" ?></td>
    <td><?php echo "Estado" ?></td>
    <td><?php echo "Metodo de Pago" ?></td>
    <td><?php echo "Total" ?></td>
    </tr> 
    <?php
      $rs2 = mysqli_query($cnn, "SELECT * FROM orden_trabajo");
      while($row2 = mysqli_fetch_array($rs2))
      { ?>
      <tr>
      <td><?php echo $row2['codigo'] ?></td>
      <td><?php echo $row2['fecha_ingreso'] ?></td>
      <td><?php echo $row2['fecha_salida'] ?></td>
      <td><?php echo $row2['descripcion_trabajo'] ?></td>
      <td><?php echo $row2['patente_auto'] ?></td>
      <td><?php echo $row2['estado'] ?></td>
      <td><?php echo $row2['metodo_pago'] ?></td>
      <td><?php echo $row2['total'] ?></td>
      </tr> 
      <?php }
      
      ?>
      </table>

      </span>
      </li>
    </ul>
  </div>
      </div>

      <div class="container">
    <ul class="list-group">
      <li class="list-group-item">
      <span class="input-group-text" id="addon-wrapping"><h1><b>Cuentas Completas</b></h1></span>
      <table class="table table-dark table-striped">
  <tr>
    <td><?php echo "ID Cuenta" ?></td>
    <td><?php echo "Usuario" ?></td>
    <td><?php echo "Permisos" ?></td>
  </tr> 
    <?php
      $rs2 = mysqli_query($cnn, "SELECT * FROM cuentas, roles WHERE (roles.id = cuentas.id_rol)");
      while($row2 = mysqli_fetch_array($rs2))
      { ?>
      <tr>
      <td><?php echo $row2['id_cuentas'] ?></td>
      <td><?php echo $row2['usuario'] ?></td>
      <td><?php echo $row2['nombre_rol'] ?></td>
      </tr> 
      <?php }
      
  ?>
  </table>
   </li>
    </ul>
  </div>
  


  <div class="container">
    <ul class="list-group">
      <li class="list-group-item">
      <span class="input-group-text" id="addon-wrapping"><h1><b>Autos Completo</b></h1></span>
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


  <div class="container">
    <ul class="list-group">
      <li class="list-group-item">
      <span class="input-group-text" id="addon-wrapping"><h1><b>Gastos Completo</b></h1></span>
      <table class="table table-dark table-striped">
    <tr>
    <td><?php echo "Codigo" ?></td>
    <td><?php echo "Repuestos" ?></td>
    <td><?php echo "Valor Repuestos" ?></td>
    <td><?php echo "Mano de Obra" ?></td>
    <td><?php echo "Codigo Orden" ?></td>
    <td><?php echo "Estado" ?></td>
    </tr> 
    <?php
      $rs4 = mysqli_query($cnn, "SELECT * FROM gastos");
      while($row4 = mysqli_fetch_array($rs4))
      { ?>
      <tr>
      <td><?php echo $row4['cod_gastos'] ?></td>
      <td><?php echo $row4['repuestos'] ?></td>
      <td><?php echo $row4['valor_repuesto'] ?></td>
      <td><?php echo $row4['mano_obra'] ?></td>
      <td><?php echo $row4['cod_orden'] ?></td>
      <td><?php echo $row4['estado_gastos'] ?></td>
      </tr> 
      <?php }
      
      ?>
      </table>
   </li>
    </ul>
  </div>



  <div class="container">
    <ul class="list-group">
      <li class="list-group-item">
      <span class="input-group-text" id="addon-wrapping"><h1><b>Dueños Completo</b></h1></span>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>

<?php

}else{
header("location:index.php");    
}
?>
