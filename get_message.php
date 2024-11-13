<?php
include 'scripts/db_connection.php';

if (isset($_GET['mensaje_id'])) {
    $mensaje_id = $_GET['mensaje_id'];

    $stmt = $conn->prepare("SELECT mensaje.asunto, mensaje.texto, mensaje.horario, usuario.username AS sender
                            FROM mensaje
                            JOIN usuario ON mensaje.remitente_id = usuario.user_id
                            WHERE mensaje.mensaje_id = ?");
    $stmt->bind_param("i", $mensaje_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    echo json_encode($data);

    $stmt->close();
}
$conn->close();
?>
