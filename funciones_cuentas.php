<?php
include("funciones.php");
?>


<?php
$cnn = Conectar();

$nom1 = isset($_POST['nombus'])?$_POST['nombus']:'';
$id_cuent= isset($_POST['idss'])?$_POST['idss']:'';
$usuario2 = isset($_POST['txtusu'])?$_POST['txtusu']:'';
$contrasena2= isset($_POST['txtcon'])?$_POST['txtcon']:'';
$id_rol2= isset($_POST['txtsel'])?$_POST['txtsel']:'';

$usuario = isset($_POST['NEWuser'])?$_POST['NEWuser']:'';
$pass = isset($_POST['NEWpass'])?$_POST['NEWpass']:'';
$pass2 = isset($_POST['NEWpass2'])?$_POST['NEWpass2']:'';
$select = isset($_POST['select'])?$_POST['select']:'';
$accion = isset($_POST['accion'])?$_POST['accion']:'';

if ($accion!='') {
    switch ($accion) {
        case 'agregar':
            if ($pass === $pass2 && $select !== 0 && $usuario !== '') {
                // Encriptar la contraseña antes de almacenarla en la base de datos
                $pass_hash = password_hash($pass, PASSWORD_DEFAULT);
        
                // Usar una sentencia preparada para evitar inyección SQL
                $stmt = mysqli_prepare($cnn, "INSERT INTO cuentas (usuario, contrasena, id_rol) VALUES (?, ?, ?)");
                mysqli_stmt_bind_param($stmt, "ssi", $usuario, $pass_hash, $select);
        
                if (mysqli_stmt_execute($stmt)) {
                    echo "<script>alert('La nueva cuenta ha sido agregada exitosamente.')</script>";
                } else {
                    echo "<script>alert('Error al agregar la nueva cuenta.')</script>";
                }
            } else {
                echo "<script>alert('Error al agregar la nueva cuenta.')</script>";
            }
            break;
                
        case 'eliminar':
            if ($id_cuent!='') {
                $sql = "DELETE FROM cuentas WHERE (id_cuentas = '$id_cuent')";
                mysqli_query($cnn, $sql);
                header("Location: menuadmin.php"); // Redireccionar a menuadmin.php
                exit();
            }
            break;
            
        case 'modificar':
            if (!empty($id_cuent) && $id_rol2 != 0) {
                $stmt = mysqli_prepare($cnn, "UPDATE cuentas SET usuario=?, contrasena=?, id_rol=? WHERE id_cuentas=?");
                $encrypted_pass = password_hash($contrasena2, PASSWORD_DEFAULT);
                mysqli_stmt_bind_param($stmt, "ssii", $usuario2, $encrypted_pass, $id_rol2, $id_cuent);
                if (mysqli_stmt_execute($stmt)) {
                    echo "<script>alert('La cuenta se ha modificado correctamente')</script>";
                    header("Location: menuadmin.php"); // Redireccionar a menuadmin.php
                    exit();
                } else {
                    echo "<script>alert('Error al modificar la cuenta. Por favor, inténtalo de nuevo más tarde.')</script>";
                }
            } else {
                echo "<script>alert('Error al modificar la cuenta. Por favor, asegúrate de que hayas ingresado un ID de cuenta válido y seleccionado un rol válido.')</script>";
            }
            break;
    }
}
?>
