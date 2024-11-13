<?php
session_start();
include 'db_connection.php';

// Verificar si el usuario es administrador
if (!isset($_SESSION['user_rol']) || $_SESSION['user_rol'] !== 'admin') {
    header("Location: index.php");
    exit();
}

// Obtener el ID del usuario y el rol actual
$user_id = $_POST['user_id'];
$current_role = $_POST['rol'];

// Cambiar el rol
$new_role = ($current_role === 'admin') ? 'usuario' : 'admin';
$stmt = $conn->prepare("UPDATE usuario SET rol = ? WHERE user_id = ?");
$stmt->bind_param("si", $new_role, $user_id);

if ($stmt->execute()) {
    header("Location: ../admin.php"); // Redirigir a la página de administración
} else {
    echo "Error al cambiar el rol.";
}

$stmt->close();
$conn->close();
?>
