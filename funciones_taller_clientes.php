<?php
include("funciones.php");
?>


<?php
$cnn = Conectar();

$nombre = isset($_POST['newcliente'])?$_POST['newcliente']:'';
$fono = isset($_POST['newfono'])?$_POST['newfono']:'';
$correo = isset($_POST['newcorreo'])?$_POST['newcorreo']:'';

$accion = isset($_POST['accion'])?$_POST['accion']:'';

if ($accion!='') {
    switch ($accion) {
        case 'agregar':
            if ($nombre != '' and $fono != '') {
                $sql="INSERT INTO dueño VALUES (NULL,'$nombre','$fono','$correo')";
                mysqli_query($cnn, $sql);
                
                
                
            }else {
                echo"<script>alert('Error al agregar la nueva cuenta')</script>";
            
            }
            break;
        
        
    }


}


?>

