<?php
include 'db_connection.php';

if($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verificación para ver si el usuario existe
    $stmt = $conn->prepare("SELECT * FROM usuario WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verificación de la contraseña
        if(password_verify($password, $user['password'])){
            session_start();
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_rol'] = $user['rol'];
            header("Location: ../admin.php");
            exit();

        } else {
            echo "Nombre de usuario o contraseña incorrectos";
        }
    } else {
        echo "No existe este usuario";
    }

    $stmt->close();
    $conn->close();
}