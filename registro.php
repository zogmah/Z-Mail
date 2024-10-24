<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Z-Mail | Registro de Usuario</title>
    <link rel="stylesheet" href="deco/stylesMain.css">
</head>

<body>
    <header>
        <div class="container hero">
            <div class="container-logo">
                <h1 class="logo"><a href="index.html">Z-Mail</a></h1>
            </div>
        </div>
    </header>
    
    <div class="registroForm">
        <h2>Registro de Usuarios</h2>
        <form action="scripts/register.php" method="post" onsubmit="return validateEmail()">
            <label for="usuario">Nombre de usuario: </label><br>
            <input type="text" id="username" name="username" required><br>

            <label for="email">Correo Electrónico: </label><br>
            <input type="text" id="email" name="email" required><br>

            <label for="contraseña">Contraseña</label><br>
            <input type="password" id="password" name="password" required><br>

            <input type="submit" value="Registrar">
        </form>
        <p>¿Ya tienes una cuenta?</p><a href="login.html">¡Inicia sesión aquí!</a>
    </div>

    <script src="scripts/formValidation.js"></script>
</body>
</html>