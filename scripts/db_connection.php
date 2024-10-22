<?php

// Parámetros para la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "zmail";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificación si la conexión fue exitosa
if ($conn->connect_error) {
    die("Conexión Fallida: " . $conn->connect_error); // Muestra el error y detiene el script en caso de que haya problemas
}