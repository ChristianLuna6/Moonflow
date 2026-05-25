<?php
$fechaHoy = date("Y-m-d");
header("Location: guardar.php?fecha=" . $fechaHoy);
exit();
?>