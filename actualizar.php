<?php
include("conexion.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = $_POST['id'];
    $tipo_flujo = $_POST['tipo_flujo'] ?? '';
    $color_sangre = $_POST['color_sangre'] ?? '';
    
    $dolor = isset($_POST['dolor']) ? implode(", ", $_POST['dolor']) : '';
    $sentimientos = isset($_POST['sentimientos']) ? implode(", ", $_POST['sentimientos']) : '';
    $medicamento = isset($_POST['medicamento']) ? implode(", ", $_POST['medicamento']) : '';
    $antojos = isset($_POST['antojos']) ? implode(", ", $_POST['antojos']) : '';
    $notas = mysqli_real_escape_string($conn, $_POST['notes'] ?? '');

    $update = "UPDATE registros SET 
               tipo_flujo = '$tipo_flujo', 
               color_sangre = '$color_sangre', 
               dolor = '$dolor', 
               sentimientos = '$sentimientos', 
               medicamento = '$medicamento', 
               antojos = '$antojos', 
               notas = '$notas' 
               WHERE id = $id";

    if(mysqli_query($conn, $update)){
        header("Location: ver.php?id=" . $id);
        exit();
    } else {
        echo "Error al actualizar: " . mysqli_error($conn);
    }
} else {
    header("Location: index.php");
    exit();
}
?>