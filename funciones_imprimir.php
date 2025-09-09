<?php
include("conexion.php");

$cnn = Conectar();

// Variables para almacenar los datos del formulario
$ID = isset($_POST['ID']) ? $_POST['ID'] : '';
$fecha_ingreso = isset($_POST['fecha_ingreso']) ? $_POST['fecha_ingreso'] : '';
$fecha_salida = isset($_POST['fecha_salida']) ? $_POST['fecha_salida'] : '';
$descripcion_trabajo = isset($_POST['descripcion_trabajo']) ? $_POST['descripcion_trabajo'] : '';
$patente_auto = isset($_POST['patente_auto']) ? $_POST['patente_auto'] : '';
$estado = isset($_POST['estado']) ? $_POST['estado'] : '';
$metodo_pago = isset($_POST['metodo_pago']) ? $_POST['metodo_pago'] : '';
$total = isset($_POST['total']) ? $_POST['total'] : '';
$nombre_dueno = isset($_POST['nombre_dueno']) ? $_POST['nombre_dueno'] : '';
$modelo_auto = isset($_POST['modelo_auto']) ? $_POST['modelo_auto'] : '';

if(isset($_POST["ID"])){
    $ID = $_POST["ID"];
    $query = "SELECT ordentrabajo.*, vehiculo.modelo, cliente.nombre FROM 
    INNER JOIN vehiculo ON .patente_auto = vehiculo.patente
    INNER JOIN cliente ON vehiculo.ID_cliente = cliente.ID|
    WHERE .ID = '$ID'";
    $resultado = mysqli_query($cnn, $query);

    if(mysqli_num_rows($resultado) > 0){
        $row = mysqli_fetch_assoc($resultado);
        $fecha_ingreso = $row["fecha_ingreso"];
        $fecha_salida = $row["fecha_salida"];
        $descripcion_trabajo = $row["descripcion_trabajo"];
        $patente_auto = $row["patente_auto"];
        $estado = $row["estado"];
        $metodo_pago = $row["metodo_pago"];
        $total = $row["total"];
        $nombre_dueno = $row["nombre"];
        $modelo_auto = $row["modelo"];
    }
}

?>
