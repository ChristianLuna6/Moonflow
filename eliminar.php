<?php
include("conexion.php");

if(isset($_GET['id'])){
    $id = $_GET['id'];
    
    $delete = "DELETE FROM registros WHERE id = $id";
    
    if(mysqli_query($conn, $delete)){
        header("Location: index.php");
        exit();
    } else {
        echo "Error al eliminar el registro: " . mysqli_error($conn);
    }
} else {
    header("Location: index.php");
    exit();
}
?>