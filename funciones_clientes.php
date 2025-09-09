<?php
include("funciones.php");

$cnn = Conectar();

$nombre1 = isset($_POST['nombus']) ? $_POST['nombus'] : '';
$codigox = isset($_POST['codigox']) ? $_POST['codigox'] : '';
$nombre2 = isset($_POST['txtnom']) ? $_POST['txtnom'] : '';
$correo2 = isset($_POST['txtcor']) ? $_POST['txtcor'] : '';
$telefono2 = isset($_POST['txtsel']) ? $_POST['txtsel'] : '';
$nombre = isset($_POST['newcliente']) ? $_POST['newcliente'] : '';
$fono = isset($_POST['newfono']) ? $_POST['newfono'] : '';
$correo = isset($_POST['newcorreo']) ? $_POST['newcorreo'] : '';
$accion = isset($_POST['accion']) ? $_POST['accion'] : '';

if ($accion != '') {
    switch ($accion) {
        case 'agregar':
            if ($nombre != '' && $fono != '') {
                $sql = "INSERT INTO dueño (nombre, telefono, correo) VALUES (?, ?, ?)";
                $stmt = mysqli_prepare($cnn, $sql);
                mysqli_stmt_bind_param($stmt, 'sss', $nombre, $fono, $correo);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            }
            break;
        
        case 'buscar':
            $sql = "SELECT * FROM dueño WHERE nombre = ?";
            $stmt = mysqli_prepare($cnn, $sql);
            mysqli_stmt_bind_param($stmt, 's', $nombre1);
            mysqli_stmt_execute($stmt);
            $rs = mysqli_stmt_get_result($stmt);
            while ($row = mysqli_fetch_array($rs)) {
                $codigo = $row["codigo"];
                $nombre2 = $row["nombre"];
                $telefono2 = $row["telefono"];
                $correo2 = $row["correo"];
            }
            mysqli_stmt_close($stmt);
            break;    
        
            case 'eliminar':
                if ($codigox != '') {
                    // Consultar si existen autos asociados al dueño
                    $sql_count = "SELECT COUNT(*) FROM autos WHERE codigo_dueño = ?";
                    $stmt_count = mysqli_prepare($cnn, $sql_count);
                    mysqli_stmt_bind_param($stmt_count, "i", $codigox);
                    mysqli_stmt_execute($stmt_count);
                    mysqli_stmt_bind_result($stmt_count, $count);
                    mysqli_stmt_fetch($stmt_count);
                    
                    if ($count > 0) {
                        echo "<script>alert('No se puede eliminar el dueño porque tiene autos asociados')</script>";
                        header("Refresh:0");
                    } else {
                        // Eliminar el dueño si no hay autos asociados
                        $sql1 = "DELETE FROM dueño WHERE (codigo = ?)";
                        $stmt1 = mysqli_prepare($cnn, $sql1);
                        mysqli_stmt_bind_param($stmt1, "i", $codigox);
                        mysqli_stmt_execute($stmt1);
                        
                        // Comprobar si se eliminó correctamente
                        $rows_affected = mysqli_stmt_affected_rows($stmt1);
                        if ($rows_affected > 0) {
                            echo "<script>alert('El dueño ha sido eliminado')</script>";
                        } else {
                            echo "<script>alert('No se pudo eliminar el dueño')</script>";
                        }
                    }
                }
                break;
            
        
        case 'modificar':
            if ($codigox != '') {
                $sql = "UPDATE dueño SET nombre = ?, telefono = ?, correo = ? WHERE codigo = ?";
                $stmt = mysqli_prepare($cnn, $sql);
                mysqli_stmt_bind_param($stmt, 'sssi', $nombre2, $telefono2, $correo2, $codigox);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            } else {
                echo "<script>alert('Error al modificar')</script>";
            }
            break;
    }
}
?>