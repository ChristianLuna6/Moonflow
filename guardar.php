<?php
include("conexion.php");

if(!isset($_GET['fecha'])){
    header("Location: index.php");
    exit();
}

$fecha = $_GET['fecha'];

$check = "SELECT id FROM registros WHERE fecha = '$fecha'";
$resCheck = mysqli_query($conn, $check);

if(mysqli_num_rows($resCheck) > 0){
    $row = mysqli_fetch_assoc($resCheck);
    header("Location: ver.php?id=" . $row['id']);
    exit();
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $tipo_flujo = $_POST['tipo_flujo'] ?? '';
    $color_sangre = $_POST['color_sangre'] ?? '';
    
    $dolor = isset($_POST['dolor']) ? implode(", ", $_POST['dolor']) : '';
    $sentimientos = isset($_POST['sentimientos']) ? implode(", ", $_POST['sentimientos']) : '';
    $medicamento = isset($_POST['medicamento']) ? implode(", ", $_POST['medicamento']) : '';
    $antojos = isset($_POST['antojos']) ? implode(", ", $_POST['antojos']) : '';
    $notas = mysqli_real_escape_string($conn, $_POST['notas'] ?? '');

    $insert = "INSERT INTO registros (fecha, tipo_flujo, color_sangre, dolor, sentimientos, medicamento, antojos, notas) 
               VALUES ('$fecha', '$tipo_flujo', '$color_sangre', '$dolor', '$sentimientos', '$medicamento', '$antojos', '$notas')";
    
    if(mysqli_query($conn, $insert)){
        header("Location: index.php");
        exit();
    } else {
        echo "Error al guardar el registro: " . mysqli_error($conn);
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Registro </title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <div class="header">
        <div class="logo-area">
            <h1>Registrar Día: <?php echo $fecha; ?></h1>
        </div>
    </div>

    <form action="" method="POST" class="form-box">
        
        <div class="form-group">
            <label>Tipo de Flujo</label>
            <div class="options-grid">
                <input type="radio" name="tipo_flujo" id="f1" value="Poco"><label for="f1">💧 Poco</label>
                <input type="radio" name="tipo_flujo" id="f2" value="Medio"><label for="f2">💧💧 Medio</label>
                <input type="radio" name="tipo_flujo" id="f3" value="Mucho"><label for="f3">🩸 Mucho</label>
                <input type="radio" name="tipo_flujo" id="f4" value="Super mucho"><label for="f4">❌ Super mucho</label>
            </div>
        </div>

        <div class="form-group">
            <label>Color de la Sangre</label>
            <div class="options-grid">
                <input type="radio" name="color_sangre" id="c1" value="Rojo"><label for="c1">🔴 Rojo</label>
                <input type="radio" name="color_sangre" id="c2" value="Rosa"><label for="c2">🌸 Rosa</label>
                <input type="radio" name="color_sangre" id="c3" value="Marrón"><label for="c3">🟤 Marrón</label>
            </div>
        </div>

        <div class="form-group">
            <label>¿Sientes algún dolor? (Puedes elegir varios)</label>
            <div class="options-grid">
                <?php 
                $dolores = ["Libre de dolor", "Cólicos", "Dolor de pechos", "Dolor de cabeza", "Migraña", "Dolor de espalda", "Dolor de rodillas", "Dolor vulvar", "Dolor de articulaciones"];
                foreach($dolores as $k => $d): ?>
                    <input type="checkbox" name="dolor[]" id="d<?php echo $k;?>" value="<?php echo $d; ?>">
                    <label for="d<?php echo $k;?>"><?php echo $d; ?></label>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="form-group">
            <label>¿Cómo te sientes hoy?</label>
            <div class="options-grid">
                <?php 
                $estados = ["Cambio de emociones", "Sin control", "Bien", "Feliz", "Triste", "Sensible", "Enojada", "Confiada", "Emocionada", "Irritable", "Ansiosa", "Insegura", "Indiferente", "Agradecida"];
                foreach($estados as $k => $e): ?>
                    <input type="checkbox" name="sentimientos[]" id="e<?php echo $k;?>" value="<?php echo $e; ?>">
                    <label for="e<?php echo $k;?>"><?php echo $e; ?></label>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="form-group">
            <label>¿Tomaste algún medicamento?</label>
            <div class="options-grid">
                <?php 
                $meds = ["Terapia hormonal", "Analgésicos", "Antibióticos", "Pastilla de emergencia"];
                foreach($meds as $k => $m): ?>
                    <input type="checkbox" name="medicamento[]" id="m<?php echo $k;?>" value="<?php echo $m; ?>">
                    <label for="m<?php echo $k;?>"><?php echo $m; ?></label>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="form-group">
            <label>Antojos actuales</label>
            <div class="options-grid">
                <?php 
                $antojos = ["Dulce", "Salado", "Grasoso", "Picante", "Carbohidratos"];
                foreach($antojos as $k => $a): ?>
                    <input type="checkbox" name="antojos[]" id="a<?php echo $k;?>" value="<?php echo $a; ?>">
                    <label for="a<?php echo $k;?>"><?php echo $a; ?></label>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="form-group">
            <label>Notas de hoy </label>
            <textarea name="notas" class="form-control" placeholder="Escribe aquí cómo va tu día..."></textarea>
        </div>

        <div class="btn-group">
            <button type="submit" class="btn btn-primary">Guardar Datos </button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
</body>
</html>
                