<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Z-Mail | Enviar Correo</title>
</head>
<body>
<header>
        <div class="container hero">
            <div class="container-logo">
                <h1 class="logo"><a href="index.html">Z-Mail</a></h1>
            </div>
        </div>
    </header>
    
    <div class="enviarCorreoForm">
        <h2>Enviar Correo</h2>
        <form action="scripts/mail.php" method="post">
            <label for="destinatario">Destinatario</label><br>
            <input type="text" id="receiver" name="receiver" required><br>

            <label for="asunto">Asunto:</label><br>
            <input type="text" id="subject" name="subject" required><br>

            <textarea name="body" id="body" rows="15" required></textarea><br>

            <input type="submit" value="Enviar Correo">
        </form>
    </div>
</body>
</html>