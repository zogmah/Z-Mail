<?php
include 'scripts/db_connection.php';

session_start();
// Verificación de si el usuario ya está logueado
if (isset($_SESSION['user_id'])) {
    header("Location: inbox.php");
    exit();
}

// Cargar configuraciones
$config = [];
$result = $conn->query("SELECT nombre, valor FROM configuracion");

while ($row = $result->fetch_assoc()) {
    $config[$row['nombre']] = $row['valor'];
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Z-Mail</title>
    <link rel="stylesheet" href="deco/stylesMain.css">
</head>
<body>
    <div class="background">
        <div class="login-container">
            <div class="login-logo">
                <img src="deco/logo.png" alt="Z-Mail Logo" class="logo-img">
            </div>
            <h2>Iniciar sesión</h2>
            <p class="login-subtext"><?php echo htmlspecialchars($config['eslogan']); ?></p>

            <form action="scripts/login.php" method="POST" class="login-form">
                <label for="username">Nombre de Usuario</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required>

                <div class="help-links">
                    <p>Página web hecha por Sebastián Monzón</p>
                    <p >Correo de Contacto: <?php echo htmlspecialchars($config['correo']); ?></p>
                </div>

                <div class="button-container">
                    <a href="registro.php" class="create-account">Crear cuenta</a>
                    <input type="submit" value="Siguiente" class="login-button">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
