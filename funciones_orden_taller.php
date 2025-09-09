<?php
include("funciones.php");
?>


<?php
$cnn = Conectar();

$fechaActual = date('d-m-Y');


$des = isset($_POST['newdes'])?$_POST['newdes']:'';
$fecha = isset($_POST['newfecha'])?$_POST['newfecha']:'';
$select = isset($_POST['select'])?$_POST['select']:'';

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
    }


}







?>

