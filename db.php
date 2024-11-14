<?php
$host = "127.0.0.1";
$user = "root";
$password = "";
$dbname = "catalogo";

// Crear conexión
$conn = new mysqli($host, $user, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
