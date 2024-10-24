<?php
session_start();
include 'db_connection.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $sender = $_SESSION['user_id']; 
    $receiver_email = $_POST['receiver'];
    $subject = $_POST['subject'];
    $body = $_POST['body'];

    // Verificación para ver si existe el email
    $stmt = $conn->prepare("SELECT user_id FROM usuario WHERE email = ?");
    $stmt->bind_param("s", $receiver_email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        $receiver = $result->fetch_assoc();
        $receiver_id = $receiver['user_id'];

        $stmt = $conn->prepare("INSERT INTO mensaje(remitente_id, destinatario_id, asunto, texto) VALUES(?, ?, ?, ?)");
        $stmt->bind_param("iiss", $sender, $receiver_id, $subject, $body);
        $stmt->execute();

        $stmt->close();
        $conn->close();
    }
    header("Location: ../inbox.php");
    exit();
}