<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Z-Mail | Enviar Correo</title>
    <link rel="stylesheet" href="deco/stylesMain.css">
</head>
<body>
    <div class="background">
        <!-- Logo y enlace de regreso -->
        <div class="header">
            <div class="container-logo">
                <a href="index.html">
                    <img src="deco/logo.png" alt="Z-Mail Logo" class="logo-img">
                    <h1 class="page-title">Z-Mail</h1>
                </a>
            </div>
            <div class="back-button-container">
                <a href="inbox.php" class="back-button">Volver a la Bandeja de Entrada</a>
            </div>
        </div>

        <!-- Formulario de Enviar Correo -->
        <div class="enviarCorreoForm">
            <h2>Enviar Correo</h2>
            <form action="scripts/mail.php" method="post">
                <div class="form-group">
                    <label for="receiver">Destinatario</label>
                    <input type="text" id="receiver" name="receiver" required>
                </div>

                <div class="form-group">
                    <label for="subject">Asunto</label>
                    <input type="text" id="subject" name="subject" required>
                </div>

                <div class="form-group">
                    <label for="body">Mensaje</label>
                    <textarea name="body" id="body" rows="10" required></textarea>
                </div>

                <button type="submit" class="submit-button">Enviar Correo</button>
            </form>
        </div>
    </div>

    <footer class="footer">
        <div class="footer-links">
            <a href="#">Ayuda</a>
            <a href="#">Privacidad</a>
            <a href="#">Términos</a>
        </div>
    </footer>
</body>
</html>
