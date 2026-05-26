<?php
mysqli_report(MYSQLI_REPORT_OFF);

$host = getenv('MYSQLHOST') ?: "localhost";
$user = getenv('MYSQLUSER') ?: "root";
$password = getenv('MYSQLPASSWORD') ?: "";

$db = getenv('MYSQLDATABASE') ?: "moonflow_db"; 
$port = getenv('MYSQLPORT') ?: "3306";

$conn = new mysqli($host, $user, $password, $db, $port);

if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

$conn->set_charset("utf8");
?>