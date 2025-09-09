<?php
include("funciones_cuentas.php");
error_reporting();
session_start();

if ($_SESSION["ESTADO"] == "LOGEADO" && $_SESSION["rol"] == 1) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>RH Motores</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="style1.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <!-- Resto del código del navbar... -->
  </nav>

  <form id="formAgregarCuenta" action="" method="post">
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

  <footer style="background-color: #333; color: #fff; text-align: center; padding: 10px 0; margin-top: 20px;">
    <p style="margin: 0;">&copy; RH Motores <?php echo date("Y"); ?>. Todos los derechos reservados.</p>
  </footer>

  <script>
  $(document).ready(function() {
    // Manejador del evento submit del formulario de agregar cuenta
    $('#formAgregarCuenta').submit(function(event) {
      event.preventDefault(); // Evitar el envío del formulario por defecto

      // Obtener los valores del formulario
      var usuario = $('#NEWuser').val();
      var contrasena = $('#NEWpass').val();
      var contrasena2 = $('#NEWpass2').val();
      var select = $('#select').val();

      // Validar los campos del formulario
      if (usuario === '' || contrasena === '' || contrasena2 === '' || select === '0') {
        Swal.fire('Error', 'Por favor, complete todos los campos.', 'error');
        return;
      }

      // Validar que las contraseñas coincidan
      if (contrasena !== contrasena2) {
        Swal.fire('Error', 'Las contraseñas no coinciden.', 'error');
        return;
      }

      // Enviar la solicitud AJAX al archivo funciones_cuentas.php
      $.ajax({
        type: 'POST',
        url: 'funciones_cuentas.php',
        data: {
          accion: 'agregar',
          NEWuser: usuario,
          NEWpass: contrasena,
          NEWpass2: contrasena2,
          select: select
        },
        success: function(response) {
          // Mostrar mensaje de éxito o error
          if (response === 'success') {
            Swal.fire('Éxito', 'La cuenta se agregó correctamente.', 'success').then(function() {
              // Actualizar la página para mostrar la cuenta agregada
              location.reload();
            });
          } else {
            Swal.fire('Error', 'Ocurrió un error al agregar la cuenta.', 'error');
          }
        },
        error: function() {
          Swal.fire('Error', 'Ocurrió un error al procesar la solicitud.', 'error');
        }
      });
    });

    // Manejador del evento click del botón de modificar cuenta
    $('.btn-modificar').click(function() {
      var fila = $(this).closest('tr');
      var idCuenta = fila.find('.id-cuenta').val();
      var usuario = fila.find('.txtusu').val();
      var select = fila.find('.txtsel').val();

      // Validar los campos obtenidos
      if (idCuenta === '' || usuario === '' || select === '0') {
        Swal.fire('Error', 'Por favor, complete todos los campos.', 'error');
        return;
      }

      // Enviar la solicitud AJAX al archivo funciones_cuentas.php
      $.ajax({
        type: 'POST',
        url: 'funciones_cuentas.php',
        data: {
          accion: 'modificar',
          idss: idCuenta,
          txtusu: usuario,
          txtsel: select
        },
        success: function(response) {
          // Mostrar mensaje de éxito o error
          if (response === 'success') {
            Swal.fire('Éxito', 'La cuenta se modificó correctamente.', 'success').then(function() {
              // Actualizar la página para mostrar los cambios
              location.reload();
            });
          } else {
            Swal.fire('Error', 'Ocurrió un error al modificar la cuenta.', 'error');
          }
        },
        error: function() {
          Swal.fire('Error', 'Ocurrió un error al procesar la solicitud.', 'error');
        }
      });
    });

    // Manejador del evento click del botón de eliminar cuenta
    $('.btn-eliminar').click(function() {
      var fila = $(this).closest('tr');
      var idCuenta = fila.find('.id-cuenta').val();

      // Validar el campo obtenido
      if (idCuenta === '') {
        Swal.fire('Error', 'No se pudo obtener el ID de la cuenta.', 'error');
        return;
      }

      // Confirmar la eliminación de la cuenta
      Swal.fire({
        title: 'Confirmación',
        text: '¿Está seguro de que desea eliminar esta cuenta?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Eliminar',
        cancelButtonText: 'Cancelar'
      }).then(function(result) {
        if (result.isConfirmed) {
          // Enviar la solicitud AJAX al archivo funciones_cuentas.php
          $.ajax({
            type: 'POST',
            url: 'funciones_cuentas.php',
            data: {
              accion: 'eliminar',
              idss: idCuenta
            },
            success: function(response) {
              // Mostrar mensaje de éxito o error
              if (response === 'success') {
                Swal.fire('Éxito', 'La cuenta se eliminó correctamente.', 'success').then(function() {
                  // Actualizar la página para reflejar los cambios
                  location.reload();
                });
              } else {
                Swal.fire('Error', 'Ocurrió un error al eliminar la cuenta.', 'error');
              }
            },
            error: function() {
              Swal.fire('Error', 'Ocurrió un error al procesar la solicitud.', 'error');
            }
          });
        }
      });
    });
  });
  </script>
</body>
</html>

<?php
} else {
  header("Location: index.php");
}
?>
