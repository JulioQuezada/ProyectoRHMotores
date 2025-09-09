<?php
include("funciones.php");
?>


<?php
$cnn = Conectar();

$fechaActual = date('Y-m-d');
$fechaMostrar = date('d-m-Y');

$valor_man = 0;
$valor_re = 0;
$total_pagado = 0;

$valor_total = isset($_POST['valor9'])?$_POST['valor9']:'';
$codigo9 = isset($_POST['close_cod'])?$_POST['close_cod']:'';
$fecha9 = isset($_POST['close_fecha'])?$_POST['pclose_fecha']:'';
$estado9 = isset($_POST['close_estado'])?$_POST['close_estado']:'';
$metodo9 = isset($_POST['select5'])?$_POST['select5']:'';


$fecha5= isset($_POST['fecha_orden'])?$_POST['fecha_orden']:'';
$patente5 = isset($_POST['pat_oreden'])?$_POST['pat_oreden']:'';


$des2= isset($_POST['txtdes'])?$_POST['txtdes']:'';
$patente2 = isset($_POST['txtpat'])?$_POST['txtpat']:'';

$patente1 = isset($_POST['txtpat'])?$_POST['txtpat']:'';
$codigo = isset($_POST['txtcod'])?$_POST['txtcod']:'';
$codigox = isset($_POST['codigox'])?$_POST['codigox']:'';
$codigoxx = isset($_POST['codigoxx'])?$_POST['codigoxx']:'';
$des1= isset($_POST['txtdes'])?$_POST['txtdes']:'';
$select1 = isset($_POST['select1'])?$_POST['select1']:'';

$des = isset($_POST['newdes'])?$_POST['newdes']:'';
$fecha = isset($_POST['newfecha'])?$_POST['newfecha']:'';
$select = isset($_POST['select'])?$_POST['select']:'';

$metodo_pago = isset($_POST['search_metodo_pago']) ? $_POST['search_metodo_pago'] : '';


$accion = isset($_POST['accion'])?$_POST['accion']:'';

if ($accion!='') {
    switch ($accion) {
        case 'agregar':
            if ($des!='' and $select!='') {
                $sql="INSERT INTO orden_trabajo (fecha_ingreso,descripcion_trabajo,patente_auto,estado) VALUES ('$fechaActual','$des','$select','Abierto')";
                mysqli_query($cnn, $sql);
                
                
            }else {
                echo"<script>alert('Error al agregar la nueva orden de trabajo')</script>";
            
            }
            break;
        
        case 'buscar':
                $rs = mysqli_query($cnn, "SELECT * FROM orden_trabajo WHERE (codigo = '$codigo')");
            while($row = mysqli_fetch_array($rs))
                {

                    $des2 = $row['descripcion_trabajo']; 
                    $patente2 = $row['patente_auto']; 
                                    
                }
            break;    
            case 'eliminar':
                if ($codigox != '') {
                    // Verificar si existen registros relacionados en las tablas "autos" y "gastos"
                    $stmt = $cnn->prepare("
                        SELECT COUNT(*) FROM orden_trabajo AS o
                        INNER JOIN autos AS a ON o.patente_auto = a.patente
                        INNER JOIN gastos AS g ON o.codigo = g.cod_orden
                        WHERE o.codigo = ?
                    ");
                    $stmt->bind_param('s', $codigox);
                    $stmt->execute();
                    $count = $stmt->get_result()->fetch_array()[0];
                    $stmt->close();
            
                    if ($count > 0) {
                        // Mostrar una alerta de soft si existen registros relacionados
                        echo "<script>alert('No se puede eliminar la orden de trabajo porque existen registros relacionados en las tablas \"autos\" y \"gastos\".');</script>";
                    } else {
                        // Eliminar la fila correspondiente a la orden de trabajo
                        $stmt = $cnn->prepare("DELETE FROM orden_trabajo WHERE codigo = ?");
                        $stmt->bind_param('s', $codigox);
                        $stmt->execute();
                        $stmt->close();
            
                        // Mostrar una alerta de soft de éxito
                        echo "<script>alert('La orden de trabajo ha sido eliminada exitosamente.');</script>";
                    }
                } else {
                    // Mostrar una alerta de soft si no se proporciona un código válido
                    echo "<script>alert('Debe proporcionar un código válido para eliminar la orden de trabajo.');</script>";
                }
                break;                                  
        case 'modificar':
            if ($codigox!='') {
                $sql2 = "UPDATE orden_trabajo SET descripcion_trabajo='$des1' WHERE (codigo = '$codigox');";                    
                mysqli_query($cnn, $sql2);
            }else {
                echo"<script>alert('Error al modificar') </script>";
            }
            
            break;
        case 'clo_orden_search':
            if ($codigo9!='') {
                $rs8 = mysqli_query($cnn, "SELECT * FROM gastos WHERE (cod_orden = $codigo9)");
                $rs9 = mysqli_query($cnn, "SELECT * FROM orden_trabajo WHERE (codigo = $codigo9)");
                while($row8 = mysqli_fetch_array($rs8))
                {
                    $valor_man = $valor_man + $row8['mano_obra'];
                    $valor_re = $valor_re + $row8['valor_repuesto'];


                    $valor_total = ($valor_man + $valor_re) ;
                }
                while($row9 = mysqli_fetch_array($rs9))
                {
                    $estado9 = $row9['estado'];
                }
            }else {
                echo"<script>alert('Error al buscar, Ingrese datos') </script>";
            }

            break;
            case 'clo_orden':
                if ($codigoxx != '') {
                    $rs8 = mysqli_query($cnn, "SELECT valor_repuesto, mano_obra FROM gastos WHERE (cod_orden = $codigoxx)");
                    $valor_total = 0;
                    while ($row8 = mysqli_fetch_array($rs8)) {
                        $valor_man += $row8['mano_obra'];
                        $valor_re += $row8['valor_repuesto'];
                        $valor_total += $row8['mano_obra'] + $row8['valor_repuesto'];
                    }
            
                    // Obtener los valores de los métodos de pago
                    $metodo1 = isset($_POST['metodo_pago1']) ? $_POST['metodo_pago1'] : '';
                    $metodo2 = isset($_POST['metodo_pago2']) ? $_POST['metodo_pago2'] : '';
            
                    // Obtener las cantidades pagadas con cada método de pago
                    $cantidad1 = isset($_POST['cantidad_pago1']) ? $_POST['cantidad_pago1'] : 0;
                    $cantidad2 = isset($_POST['cantidad_pago2']) ? $_POST['cantidad_pago2'] : 0;
            
                    // Actualizar la orden de trabajo con los métodos de pago y las cantidades
                    $sql51 = "UPDATE orden_trabajo SET fecha_salida='$fechaActual', estado='cerrado', metodo_pago='$metodo1', metodo_pago2='$metodo2', cantidad_pago1='$cantidad1', cantidad_pago2='$cantidad2', total='$valor_total' WHERE (codigo = '$codigoxx');";
                    $sql52 = "UPDATE gastos SET estado_gastos='cerrado' WHERE (cod_orden = '$codigoxx');";
                    mysqli_query($cnn, $sql51);
                    mysqli_query($cnn, $sql52);
                } else {
                    echo "<script>alert('Error al cerrar la orden')</script>";
                }
                break;
                case 'buscar_por_metodo_pago':
                
                    // Verificar si se ha seleccionado un método de pago
                    if ($metodo_pago != '0') {
                        $sql = "SELECT SUM(CASE WHEN metodo_pago = '$metodo_pago' THEN cantidad_pago1 ELSE 0 END) AS total_pago1,
                                SUM(CASE WHEN metodo_pago2 = '$metodo_pago' THEN cantidad_pago2 ELSE 0 END) AS total_pago2
                                FROM orden_trabajo
                                WHERE estado = 'cerrado'
                                AND YEAR(fecha_salida) = YEAR(CURRENT_DATE())
                                AND MONTH(fecha_salida) = MONTH(CURRENT_DATE())";
                
                        $result = mysqli_query($cnn, $sql);
                
                        // Verificar si se encontraron resultados
                        if ($result && mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result);
                            $total_pago1 = $row['total_pago1'];
                            $total_pago2 = $row['total_pago2'];
                
                            // Sumar los totales de los dos métodos de pago
                            $total_pagado = $total_pago1 + $total_pago2;
                        } else {
                            // No se encontraron registros para el método de pago seleccionado
                            $total_pagado = 0;
                        }
                    } else {
                        // No se ha seleccionado un método de pago válido
                        $total_pagado = 0;
                    }
                    break;
                
                
                     
    }


}







?>

