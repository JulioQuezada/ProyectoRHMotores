<?php
include("funciones.php")
?>


<?php
$cnn = Conectar();

$modelo3 = isset($_POST[''])?$_POST['']:'';
$patente3 = isset($_POST[''])?$_POST['']:'';
$nombre = isset($_POST['nom_dueño'])?$_POST['nom_dueño']:'';

$patente = isset($_POST['newpatente'])?$_POST['newpatente']:'';
$modelo = isset($_POST['newmodelo'])?$_POST['newmodelo']:'';
$select = isset($_POST['select'])?$_POST['select']:'';

$accion = isset($_POST['accion'])?$_POST['accion']:'';


if ($accion!='') {
    switch ($accion) {
        case 'agregar':
            if ($patente!='' and $select!='') {

                $rs4 = mysqli_query($cnn, "SELECT * FROM autos WHERE (patente = '$patente')");
                while($row4 = mysqli_fetch_array($rs4))
                {
                $patente4 = $row4["patente"];
                                    
                }if ($patente != $patente4 ) {
                    $sql="INSERT INTO autos (patente,modelo,codigo_dueño) VALUES ('$patente','$modelo',$select)";
                    mysqli_query($cnn, $sql);
                }else {
                    echo"<script>alert('Error el auto ya existe')</script>";
                }
            }else {
                echo"<script>alert('Error al agregar el auto')</script>";
            
            }
            break;
        
        case 'bu_patente':
            if ($nombre != '') 
                {
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

