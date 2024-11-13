<?php
session_start();
include 'db_connection.php';

// Actualizar configuraciones en la base de datos
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $eslogan = $_POST['eslogan'];
    $correo = $_POST['correo'];

    $stmt = $conn->prepare("UPDATE configuracion SET valor = ? WHERE nombre = ?");

    $stmt->bind_param("ss", $eslogan, $nombre);
    $nombre = 'eslogan';
    $stmt->execute();

    $stmt->bind_param("ss", $correo, $nombre);
    $nombre = 'color_fondo';
    $stmt->execute();


    $stmt->close();
    $conn->close();

    header("Location: ../admin.php");
    exit();
}
?>
