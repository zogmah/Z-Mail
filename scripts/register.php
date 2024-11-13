<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encriptamos la contraseña

    // Verificación de si ya existe el usuario/email
    $checkUser = $conn->prepare("SELECT * FROM usuario WHERE email = ? OR username = ?");
    $checkUser->bind_param("ss", $email, $username);
    $checkUser->execute();
    $result = $checkUser->get_result();

    if ($result->num_rows == 0) {
        $stmt = $conn->prepare("INSERT INTO usuario (email, username, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $email, $username, $password);

        if ($stmt->execute()) {
            header("Location: ../index.php");
            exit();
        } else {
            echo "Error en el registro: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "El correo o nombre de usuario ya está registrado.";
    }

    $conn->close();
}
?>
