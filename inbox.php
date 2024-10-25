<?php
session_start();
include 'scripts/db_connection.php';

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT mensaje.mensaje_id, mensaje.asunto, mensaje.texto, mensaje.horario, usuario.username AS sender
                        FROM mensaje
                        JOIN usuario ON mensaje.remitente_id = usuario.user_id
                        WHERE mensaje.destinatario_id = ?
                        ORDER BY mensaje.horario DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Z-Mail</title>
    <link rel="stylesheet" href="deco/stylesMain.css">
</head>
<body>
    <div class="container hero">
        <div class="container-logo">
            <h1 class="logo"><a href="index.html">Z-Mail</a></h1>
        </div>
    </div>

    <div class="inbox">
        <h2>Bandeja de Entrada</h2>
        <div class="mensajes">
            <table>
                <tr>
                    <th>Asunto</th>
                    <th>De</th>
                    <th>Mensaje</th>
                    <th>Horario</th>
                </tr>

                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['asunto']) ?></td>
                    <td><?php echo htmlspecialchars($row['sender']) ?></td>
                    <td><?php echo htmlspecialchars($row['texto']) ?></td>
                    <td><?php echo htmlspecialchars($row['horario']) ?></td>
                </tr>
                <?php endwhile; ?>
            </table>
        </div>
    </div>

    <footer class="footer">
        <div class="container container-footer">
            <div class="menu-footer">
                <div class="contact-info">
                    <p class="title-footer">Información de Contacto</p>
                    <ul>
                        <li>Telefono: 123-456-789</li>
                        <li>Email: sebamatiasmonzon@gmail.com</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="copyright">
            <p>
                Z-Mail &copy; 2024
            </p>
        </div>
    </footer>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>