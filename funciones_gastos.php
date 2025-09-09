<?php
include("funciones.php");
?>


<?php
$cnn = Conectar();

$codigo = isset($_POST['txtgastos'])?$_POST['txtgastos']:'';
$codigox = isset($_POST['codigox'])?$_POST['codigox']:'';
$repuestos1= isset($_POST['txtrepuestos'])?$_POST['txtrepuestos']:'';
$valor1 = isset($_POST['txtvalor'])?$_POST['txtvalor']:'';
$obra1 = isset($_POST['txtobra'])?$_POST['txtobra']:'';
$select1 = isset($_POST['txtselect'])?$_POST['txtselect']:'';

$fecha_ini = isset($_POST['fecha_ini'])?$_POST['fecha_ini']:'';
$fecha_fin = isset($_POST['fecha_fin'])?$_POST['fecha_fin']:'';

$select = isset($_POST['select'])?$_POST['select']:'';
$repuestos = isset($_POST['newrepuestos'])?$_POST['newrepuestos']:'';
$valor = isset($_POST['newvalor'])?$_POST['newvalor']:'';
$obra = isset($_POST['newobra'])?$_POST['newobra']:'';

$accion = isset($_POST['accion'])?$_POST['accion']:'';

if ($accion!='') {
    switch ($accion) {
        case 'agregar':
            if ($repuestos!=''and $valor!='' and $obra!=''and $select!= 0) {
                $sql="INSERT INTO gastos (cod_gastos,repuestos,valor_repuesto,mano_obra,cod_orden,estado_gastos) VALUES (NULL,'$repuestos','$valor','$obra','$select','abierto')";
                mysqli_query($cnn, $sql);
                
                
            }else {
                echo"<script>alert('Error al agregar los gastos')</script>";
            
            }
            break;
        
        case 'buscar':
                if ($codigo!='') {
                    $rs = mysqli_query($cnn, "SELECT * FROM gastos WHERE (cod_gastos = '$codigo')");
                    while($row = mysqli_fetch_array($rs))
                        {
                        $repuestos1 = $row["repuestos"];
                        $valor1 = $row["valor_repuesto"];
                        $obra1 = $row["mano_obra"];
                        $select1 = $row["cod_orden"];
                                            
                        }
                }

            break;    
        case 'eliminar':
            if ($codigox!='') {
                $sql = "DELETE FROM gastos WHERE (cod_gastos = '$codigox')";
                mysqli_query($cnn, $sql);
            }
            break;
        case 'modificar':
            if ($codigox!='') {
                $sql2 = "UPDATE gastos SET  repuestos='$repuestos1', valor_repuesto='$valor1', mano_obra='$obra1', cod_orden='$select1' WHERE (cod_gastos = '$codigox');";                    
                mysqli_query($cnn, $sql2);
            }else {
                echo"<script>alert('Error al modificar') </script>";
            }
            
            break;

        }
}


?>