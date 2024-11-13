<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Z-Mail | Registro de Usuario</title>
    <link rel="stylesheet" href="deco/stylesMain.css">
</head>
<body>
    <div class="background">
        <div class="register-container">
            <div class="login-logo">
                <img src="deco/logo.png" alt="Z-Mail Logo" class="logo-img">
            </div>
            <h2>Registro de Usuarios</h2>

            <form action="scripts/register.php" method="post" class="register-form" onsubmit="return validateEmail()">
                <label for="username">Nombre de usuario:</label>
                <input type="text" id="username" name="username" required>

                <label for="email">Correo Electrónico:</label>
                <input type="text" id="email" name="email" required>

                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>

                <input type="submit" value="Registrar" class="register-button">
            </form>

            <p class="already-have-account">¿Ya tienes una cuenta? <a href="index.html">¡Inicia sesión aquí!</a></p>
        </div>
    </div>

    <footer class="footer">
        <div class="footer-links">
            <a href="#">Ayuda</a>
            <a href="#">Privacidad</a>
            <a href="#">Términos</a>
        </div>
    </footer>

    <script src="scripts/formValidation.js"></script>
</body>
</html>
