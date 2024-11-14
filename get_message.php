<?php
include 'scripts/db_connection.php';


// Esto es un script para ver los mensajes en inbox.php, se supone que debería estar en la carpeta de
// scripts pero se rompe toda la página por un motivo que sinceramente no termino de entender si lo dejo allí.
// Así que se queda en la carpeta raíz porque ese fragmento de código tiene más fuerza de voluntad que
// yo después de 12 horas programando.
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
