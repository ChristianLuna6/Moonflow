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

$doloresGuardados = explode(", ", $data['dolor']);
$sentimientosGuardados = explode(", ", $data['sentimientos']);
$medsGuardados = explode(", ", $data['medicamento']);
$antojosGuardados = explode(", ", $data['antojos']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Registro </title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <div class="header">
        <div class="logo-area">
            <h1>Editar Registro: <?php echo $data['fecha']; ?></h1>
        </div>
    </div>

    <form action="actualizar.php" method="POST" class="form-box">
        <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
        
        <div class="form-group">
            <label>Tipo de Flujo</label>
            <div class="options-grid">
                <input type="radio" name="tipo_flujo" id="f1" value="Poco" <?php echo ($data['tipo_flujo'] == 'Poco') ? 'checked' : ''; ?>><label for="f1">💧 Poco</label>
                <input type="radio" name="tipo_flujo" id="f2" value="Medio" <?php echo ($data['tipo_flujo'] == 'Medio') ? 'checked' : ''; ?>><label for="f2">💧💧 Medio</label>
                <input type="radio" name="tipo_flujo" id="f3" value="Mucho" <?php echo ($data['tipo_flujo'] == 'Mucho') ? 'checked' : ''; ?>><label for="f3">🩸 Mucho</label>
                <input type="radio" name="tipo_flujo" id="f4" value="Super mucho" <?php echo ($data['tipo_flujo'] == 'Super mucho') ? 'checked' : ''; ?>><label for="f4">❌ Super mucho</label>
            </div>
        </div>

        <div class="form-group">
            <label>Color de la Sangre</label>
            <div class="options-grid">
                <input type="radio" name="color_sangre" id="c1" value="Rojo" <?php echo ($data['color_sangre'] == 'Rojo') ? 'checked' : ''; ?>><label for="c1">🔴 Rojo</label>
                <input type="radio" name="color_sangre" id="c2" value="Rosa" <?php echo ($data['color_sangre'] == 'Rosa') ? 'checked' : ''; ?>><label for="c2">🌸 Rosa</label>
                <input type="radio" name="color_sangre" id="c3" value="Marrón" <?php echo ($data['color_sangre'] == 'Marrón') ? 'checked' : ''; ?>><label for="c3">🟤 Marrón</label>
            </div>
        </div>

        <div class="form-group">
            <label>¿Sientes algún dolor?</label>
            <div class="options-grid">
                <?php 
                $dolores = ["Libre de dolor", "Cólicos", "Dolor de pechos", "Dolor de cabeza", "Migraña", "Dolor de espalda", "Dolor de rodillas", "Dolor vulvar", "Dolor de articulaciones"];
                foreach($dolores as $k => $d): 
                    $checked = in_array($d, $doloresGuardados) ? 'checked' : '';
                ?>
                    <input type="checkbox" name="dolor[]" id="d<?php echo $k;?>" value="<?php echo $d; ?>" <?php echo $checked; ?>>
                    <label for="d<?php echo $k;?>"><?php echo $d; ?></label>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="form-group">
            <label>¿Cómo te sientes hoy?</label>
            <div class="options-grid">
                <?php 
                $estados = ["Cambio de emociones", "Sin control", "Bien", "Feliz", "Triste", "Sensible", "Enojada", "Confiada", "Emocionada", "Irritable", "Ansiosa", "Insegura", "Indiferente", "Agradecida"];
                foreach($estados as $k => $e): 
                    $checked = in_array($e, $sentimientosGuardados) ? 'checked' : '';
                ?>
                    <input type="checkbox" name="sentimientos[]" id="e<?php echo $k;?>" value="<?php echo $e; ?>" <?php echo $checked; ?>>
                    <label for="e<?php echo $k;?>"><?php echo $e; ?></label>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="form-group">
            <label>¿Tomaste algún medicamento?</label>
            <div class="options-grid">
                <?php 
                $meds = ["Terapia hormonal", "Analgésicos", "Antibióticos", "Pastilla de emergencia"];
                foreach($meds as $k => $m): 
                    $checked = in_array($m, $medsGuardados) ? 'checked' : '';
                ?>
                    <input type="checkbox" name="medicamento[]" id="m<?php echo $k;?>" value="<?php echo $m; ?>" <?php echo $checked; ?>>
                    <label for="m<?php echo $k;?>"><?php echo $m; ?></label>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="form-group">
            <label>Antojos actuales</label>
            <div class="options-grid">
                <?php 
                $antojos = ["Dulce", "Salado", "Grasoso", "Picante", "Carbohidratos"];
                foreach($antojos as $k => $a): 
                    $checked = in_array($a, $antojosGuardados) ? 'checked' : '';
                ?>
                    <input type="checkbox" name="antojos[]" id="a<?php echo $k;?>" value="<?php echo $a; ?>" <?php echo $checked; ?>>
                    <label for="a<?php echo $k;?>"><?php echo $a; ?></label>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="form-group">
            <label>Notas de hoy </label>
            <textarea name="notes" class="form-control"><?php echo $data['notas']; ?></textarea>
        </div>

        <div class="btn-group">
            <button type="submit" class="btn btn-primary">Actualizar Cambios </button>
            <a href="ver.php?id=<?php echo $data['id']; ?>" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
</body>
</html>