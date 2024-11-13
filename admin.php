<?php
session_start();
include 'scripts/db_connection.php';

// Verificar si el usuario es administrador
if (!isset($_SESSION['user_rol']) || $_SESSION['user_rol'] !== 'admin') {
    header("Location: index.php"); // Redirigir a login si no es admin
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

// Cargar las configuraciones
$config = [];
$result = $conn->query("SELECT nombre, valor FROM configuracion");
while ($row = $result->fetch_assoc()) {
    $config[$row['nombre']] = $row['valor'];
}

// Obtener lista de usuarios
$stmt = $conn->prepare("SELECT user_id, username, email, rol, estado FROM usuario ORDER BY user_id ASC");
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - Z-Mail</title>
    <link rel="stylesheet" href="deco/stylesMain.css">
</head>
<body>
    <div class="background">
        <!-- Logo y Header -->
        <div class="header">
            <div class="container-logo">
                <a href="index.php">
                    <img src="deco/logo.png" alt="Z-Mail Logo" class="logo-img">
                    <h1 class="page-title">Z-Mail Admin</h1>
                </a>
            </div>
            <div class="logout-button-container">
                <a href="scripts/logout.php" class="logout-button">Cerrar sesión</a>
            </div>
        </div>

        <div class="admin-panel container">
            <!-- Gestión de Usuarios -->
            <section class="user-management">
                <h2>Gestión de Usuarios</h2>
                <div class="box">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Rol</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['user_id']); ?></td>
                                <td><?php echo htmlspecialchars($row['username']); ?></td>
                                <td><?php echo htmlspecialchars($row['email']); ?></td>
                                <td><?php echo htmlspecialchars($row['rol']); ?></td>
                                <td><?php echo $row['estado'] ? 'Activo' : 'Inactivo'; ?></td>
                                <td>
                                    <form action="scripts/cambiarRol.php" method="post" style="display:inline;">
                                        <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
                                        <input type="hidden" name="rol" value="<?php echo $row['rol']; ?>">
                                        <button type="submit" class="btn">
                                            Cambiar Rol a <?php echo $row['rol'] === 'admin' ? 'Usuario' : 'Admin'; ?>
                                        </button>
                                    </form>
                                    <form action="scripts/cambiarEstado.php" method="post" style="display:inline;">
                                        <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
                                        <input type="hidden" name="estado" value="<?php echo $row['estado']; ?>">
                                        <button type="submit" class="btn">
                                            <?php echo $row['estado'] ? 'Desactivar' : 'Activar'; ?>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </section>
            
            <!-- Configuración del Sitio -->
            <section class="site-configuration">
                <h2>Configuración del Sitio</h2>
                <div class="box">
                    <form action="scripts/guardar_configuracion.php" method="post">
                        <div class="form-group">
                            <label for="eslogan">Eslogan:</label>
                            <input type="text" id="eslogan" name="eslogan" value="<?php echo htmlspecialchars($config['eslogan']); ?>">
                        </div>
                        <div class="form-group">
                            <label for="correo">Correo de contacto:</label>
                            <input type="text" id="correo" name="correo" value="<?php echo htmlspecialchars($config['correo']); ?>">
                        </div>
                        <button type="submit" class="submit-button">Guardar Cambios</button>
                    </form>
                </div>
            </section>
        </div>
    </div>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
