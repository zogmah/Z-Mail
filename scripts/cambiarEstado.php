<?php
session_start();
include 'db_connection.php';

// Verificar si el usuario es administrador
if (!isset($_SESSION['user_rol']) || $_SESSION['user_rol'] !== 'admin') {
    header("Location: index.php");
    exit();
}

// Obtener el ID del usuario y el estado actual
$user_id = $_POST['user_id'];
$current_state = $_POST['estado'];

// Cambiar el estado
$new_state = $current_state ? 0 : 1;
$stmt = $conn->prepare("UPDATE usuario SET estado = ? WHERE user_id = ?");
$stmt->bind_param("ii", $new_state, $user_id);

if ($stmt->execute()) {
    header("Location: ../admin.php"); // Redirigir a la página de administración
} else {
    echo "Error al cambiar el estado.";
}

$stmt->close();
$conn->close();
?>
