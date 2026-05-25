<?php
include("conexion.php");

if(!isset($_GET['id'])){
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];
$query = "SELECT * FROM registros WHERE id = $id";
$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) == 0){
    header("Location: index.php");
    exit();
}

$data = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu Registro </title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <div class="header">
        <div class="logo-area">
            <h1>Registro del <?php echo $data['fecha']; ?> 🌸</h1>
        </div>
    </div>

    <div class="view-box">
        <div class="detail-item">
            <h3>Flujo Menstrual</h3>
            <p><?php echo !empty($data['tipo_flujo']) ? $data['tipo_flujo'] : 'No registrado'; ?></p>
        </div>

        <div class="detail-item">
            <h3>Color de la Sangre</h3>
            <p><?php echo !empty($data['color_sangre']) ? $data['color_sangre'] : 'No registrado'; ?></p>
        </div>

        <div class="detail-item">
            <h3>Síntomas y Dolores</h3>
            <div class="tags">
                <?php 
                if(!empty($data['dolor'])){
                    $items = explode(", ", $data['dolor']);
                    foreach($items as $it) echo "<span class='tag'>$it</span>";
                } else { echo "<p>Ninguno registrado</p>"; }
                ?>
            </div>
        </div>

        <div class="detail-item">
            <h3>Estado de Ánimo / Sentimientos</h3>
            <div class="tags">
                <?php 
                if(!empty($data['sentimientos'])){
                    $items = explode(", ", $data['sentimientos']);
                    foreach($items as $it) echo "<span class='tag'>$it</span>";
                } else { echo "<p>Ninguno registrado</p>"; }
                ?>
            </div>
        </div>

        <div class="detail-item">
            <h3>Medicamentos tomados</h3>
            <div class="tags">
                <?php 
                if(!empty($data['medicamento'])){
                    $items = explode(", ", $data['medicamento']);
                    foreach($items as $it) echo "<span class='tag'>$it</span>";
                } else { echo "<p>Ninguno</p>"; }
                ?>
            </div>
        </div>

        <div class="detail-item">
            <h3>Antojos</h3>
            <div class="tags">
                <?php 
                if(!empty($data['antojos'])){
                    $items = explode(", ", $data['antojos']);
                    foreach($items as $it) echo "<span class='tag'>$it</span>";
                } else { echo "<p>Ninguno</p>"; }
                ?>
            </div>
        </div>

        <div class="detail-item">
            <h3>Mis Notas Diario</h3>
            <p><?php echo !empty($data['notas']) ? nl2br($data['notas']) : 'Sin notas para este día.'; ?></p>
        </div>

        <div class="btn-group">
            <a href="editar.php?id=<?php echo $data['id']; ?>" class="btn btn-primary">Editar Registro ✏️</a>
            <a href="eliminar.php?id=<?php echo $data['id']; ?>" class="btn btn-danger" onclick="return confirm('¿Segura que quieres borrar los datos de este día? 🥺')">Eliminar</a>
            <a href="index.php" class="btn btn-secondary">Volver al Calendario</a>
        </div>
    </div>
</div>
</body>
</html>