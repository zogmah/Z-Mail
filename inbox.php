<?php
session_start();
include 'scripts/db_connection.php';

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Verificar si la cuenta del usuario está activa
$stmt_status = $conn->prepare("SELECT estado FROM usuario WHERE user_id = ?");
$stmt_status->bind_param("i", $user_id);
$stmt_status->execute();
$stmt_status->bind_result($estado);
$stmt_status->fetch();
$stmt_status->close();

// Si el estado es 0 (desactivado), cerrar sesión y redirigir
if ($estado == 0) {
    // Cerrar la sesión
    session_unset();
    session_destroy();

    // Redirigir al inicio con un mensaje
    header("Location: index.php?error=account_disabled");
    exit();
}

// Obtener información del usuario para mostrar en el header
$stmt_user = $conn->prepare("SELECT username FROM usuario WHERE user_id = ?");
$stmt_user->bind_param("i", $user_id);
$stmt_user->execute();
$stmt_user->bind_result($username);
$stmt_user->fetch();
$stmt_user->close();

// Obtener mensajes
$stmt = $conn->prepare("SELECT mensaje.mensaje_id, mensaje.asunto, mensaje.texto, mensaje.horario, usuario.username AS sender
                        FROM mensaje
                        JOIN usuario ON mensaje.remitente_id = usuario.user_id
                        WHERE mensaje.destinatario_id = ?
                        ORDER BY mensaje.horario DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Z-Mail | Bandeja de Entrada</title>
        <link rel="stylesheet" href="deco/stylesMain.css">
    </head>
    <body>
        <div class="background">
            <div class="inbox-container">
                <div class="header">
                    <div class="logo-section">
                        <img src="deco/logo.png" alt="Z-Mail Logo" class="logo-img">
                        <h1 class="page-title">Z-Mail</h1>
                    </div>
                    
                    <!-- Sección de usuario -->
                    <div class="user-section">
                        <img src="deco/avatar.png" alt="User Avatar" class="user-avatar" id="user-avatar">
                        <span class="user-name"><?php echo htmlspecialchars($username); ?></span>
                        <div class="dropdown" id="dropdown-menu">
                            <a href="scripts/logout.php" class="logout-btn">Cerrar sesión</a>
                        </div>
                    </div>
                </div>
                <h2 class="inbox-title">Bandeja de Entrada</h2>
                <div class="inbox">
                    <div class="mensajes">
                        <table class="messages-table">
                            <thead>
                                <tr>
                                    <th>Asunto</th>
                                    <th>De</th>
                                    <th>Mensaje</th>
                                    <th>Horario</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['asunto']) ?></td>
                                    <td><?php echo htmlspecialchars($row['sender']) ?></td>
                                    <td>
                                        <?php echo htmlspecialchars(substr($row['texto'], 0, 100)); ?>
                                        <?php if (strlen($row['texto']) > 100): ?>
                                            ... <button class="open-modal-btn" data-id="<?php echo $row['mensaje_id']; ?>">Leer más</button>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo htmlspecialchars($row['horario']) ?></td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <a href="enviarCorreo.php" class="send-mail-button">Enviar Correo</a>
            </div>
        </div>

        <!-- Modal para mostrar mensaje completo -->
        <div id="message-modal" class="modal">
            <div class="modal-content">
                <span class="close-modal">&times;</span>
                <h3 id="modal-asunto"></h3>
                <p id="modal-autor"></p>
                <p id="modal-horario"></p>
                <div id="modal-texto"></div>
            </div>
        </div>

        <script>
            // Modal handling
            const modal = document.getElementById("message-modal");
            const closeModal = document.querySelector(".close-modal");
            const openModalBtns = document.querySelectorAll(".open-modal-btn");

            openModalBtns.forEach(btn => {
                btn.addEventListener("click", () => {
                    const messageId = btn.getAttribute("data-id");
                    fetchMessage(messageId);
                });
            });

            closeModal.onclick = () => {
                modal.style.display = "none";
            };

            window.onclick = (event) => {
                if (event.target === modal) {
                    modal.style.display = "none";
                }
            };

            function fetchMessage(id) {
                fetch(`get_message.php?mensaje_id=${id}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById("modal-asunto").textContent = data.asunto;
                        document.getElementById("modal-autor").textContent = `De: ${data.sender}`;
                        document.getElementById("modal-horario").textContent = `Horario: ${data.horario}`;
                        document.getElementById("modal-texto").textContent = data.texto;
                        modal.style.display = "block";
                    })
                    .catch(error => console.error("Error:", error));
            }

            // Mostrar menú de cerrar sesión
            const avatar = document.getElementById("user-avatar");
            const dropdownMenu = document.getElementById("dropdown-menu");

            avatar.onclick = () => {
                dropdownMenu.style.display = dropdownMenu.style.display === "block" ? "none" : "block";
            };
        </script>
    </body>
</html>

<?php
$stmt->close();
$conn->close();
?>
