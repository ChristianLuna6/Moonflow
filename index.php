<?php
include("conexion.php");

$mes = date("m");
$anio = date("Y");

$diasMes = cal_days_in_month(CAL_GREGORIAN, $mes, $anio);

$query = "SELECT fecha FROM registros";
$result = mysqli_query($conn, $query);

$registros = [];

while($row = mysqli_fetch_assoc($result)){
    $registros[] = $row['fecha'];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="img/moonlogo.jpg" type="image/jpg">
<title>MoonFlow </title>

<link rel="icon" href="img/moonlogo.png">
<link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container">

    <div class="header">

        <div class="logo-area">
    <img src="img/moonlogo.jpg" alt="MoonFlow Logo" class="logo-img">
    <h1>MoonFlow </h1>
    </div>
    </div>

    <div class="calendar-box">

        <h2 class="month-title">
            <?php echo date("F Y"); ?>
        </h2>

        <div class="weekdays">
            <div>Lun</div>
            <div>Mar</div>
            <div>Mié</div>
            <div>Jue</div>
            <div>Vie</div>
            <div>Sáb</div>
            <div>Dom</div>
        </div>

        <div class="calendar">

        <?php
        for($dia = 1; $dia <= $diasMes; $dia++):

            $fechaCompleta =
            $anio . "-" .
            str_pad($mes,2,"0",STR_PAD_LEFT)
            . "-" .
            str_pad($dia,2,"0",STR_PAD_LEFT);

            $tieneRegistro =
            in_array($fechaCompleta, $registros);
        ?>

        <div
            class="day <?php echo $tieneRegistro ? 'has-record' : ''; ?>"
            onclick="window.location.href='guardar.php?fecha=<?php echo $fechaCompleta; ?>'">

            <div class="day-number">
                <?php echo $dia; ?>
            </div>

            <?php if($tieneRegistro): ?>
                <div class="flower">🌸</div>
            <?php endif; ?>

        </div>

        <?php endfor; ?>

        </div>

    </div>

</div>

</body>
</html>