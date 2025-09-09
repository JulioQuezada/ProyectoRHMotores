<?php
include("funciones.php");
?>


<?php
// Variables de conexión
$cnn = Conectar();

// Variables de agregar auto
$patente = isset($_POST['newpatente']) ? $_POST['newpatente'] : '';
$modelo = isset($_POST['newmodelo']) ? $_POST['newmodelo'] : '';
$select = isset($_POST['select']) ? $_POST['select'] : '';
$accion = isset($_POST['accion']) ? $_POST['accion'] : '';

// Variables de buscar, modificar y eliminar auto
$patente1 = isset($_POST['buscar_patente']) ? $_POST['buscar_patente'] : '';
$patente2 = isset($_POST['mod_patente']) ? $_POST['mod_patente'] : '';
$patentex = isset($_POST['patentex']) ? $_POST['patentex'] : '';
$modelo2 = isset($_POST['mod_modelo']) ? $_POST['mod_modelo'] : '';
$select2 = isset($_POST['select1']) ? $_POST['select1'] : '';

// Variables de buscar auto por dueño
$nombre = isset($_POST['nom_dueño']) ? $_POST['nom_dueño'] : '';
$patente3 = '';
$modelo3 = '';

// Variables auxiliares
$patente4 = '';

// Procesamiento de datos según la acción
if ($accion != '') {
    switch ($accion) {
        case 'agregar':
            if ($patente != '' && $select != '') {
                $stmt = mysqli_prepare($cnn, "SELECT * FROM autos WHERE patente = ?");
                mysqli_stmt_bind_param($stmt, "s", $patente);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $row4 = mysqli_fetch_assoc($result);
                if ($row4 == null) {
                    $stmt = mysqli_prepare($cnn, "INSERT INTO autos (patente, modelo, codigo_dueño) VALUES (?, ?, ?)");
                    mysqli_stmt_bind_param($stmt, "ssi", $patente, $modelo, $select);
                    mysqli_stmt_execute($stmt);
                } else {
                    echo "<script>alert('Error el auto ya existe')</script>";
                }
            } else {
                echo "<script>alert('Error al agregar el auto')</script>";
            }
            break;
        
        
        case 'buscar':
            if ($patente1 != '') {
                $rs = mysqli_query($cnn, "SELECT * FROM autos WHERE (patente = '$patente1')");
                while ($row = mysqli_fetch_array($rs)) {
                    $patente2 = $row["patente"];
                    $modelo2 = $row["modelo"];
                    $cod_dueño2 = $row["codigo_dueño"];
                }
            } else {
                echo "<script>alert('Error al buscar auto')</script>";
            }
            break;
            
            case "eliminar":
                if ($patentex!='') {
                    // Verificar si existen registros relacionados en la tabla "orden_trabajo"
                    $stmt = $cnn->prepare("
                        SELECT COUNT(*) FROM orden_trabajo WHERE patente_auto = ?
                    ");
                    $stmt->bind_param('s', $patentex);
                    $stmt->execute();
                    $count = $stmt->get_result()->fetch_array()[0];
                    $stmt->close();
            
                    if ($count > 0) {
                        // Mostrar una alerta de soft si existen registros relacionados
                        echo "<script>alert('No se puede eliminar el auto porque existen registros relacionados en la tabla \"orden_trabajo\".');</script>";
                    } else {
                        // Eliminar la fila correspondiente al auto
                        $stmt = $cnn->prepare("DELETE FROM autos WHERE patente = ?");
                        $stmt->bind_param('s', $patentex);
                        $stmt->execute();
                        $stmt->close();
            
                        // Mostrar una alerta de soft de éxito
                        echo "<script>alert('El auto ha sido eliminado exitosamente.');</script>";
                    }
                } else {
                    // Mostrar una alerta de soft si no se proporciona una patente válida
                    echo "<script>alert('Debe proporcionar una patente válida para eliminar el auto.');</script>";
                }
                break;
                case 'modificar':
                    if ($patentex != '' && $select2 != '') {
                        $stmt = $cnn->prepare("UPDATE autos SET patente=?, modelo=?, codigo_dueño=? WHERE patente=?");
                        $stmt->bind_param("ssss", $patente2, $modelo2, $select2, $patentex);
                        $stmt->execute();
                        if ($stmt->affected_rows > 0) {
                            echo "<script>alert('Auto modificado con éxito');</script>";
                        } else {
                            echo "<script>alert('Error al modificar el auto');</script>";
                        }
                        $stmt->close();
                    } else {
                        echo "<script>alert('Error al modificar el auto');</script>";
                    }
                    break;
                
        case 'bu_patente':
            if ($nombre != '') {
                
                $rs3 = mysqli_query($cnn, "SELECT * FROM dueño, autos WHERE (dueño.codigo = autos.codigo_dueño)AND(nombre = '$nombre')");
                while($row3 = mysqli_fetch_array($rs3))
                {
                $patente3 = $row3["patente"];
                $modelo3 = $row3["modelo"];
                                    
                }
                }
            break;
    }


}


?>

