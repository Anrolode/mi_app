<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['rol'] !== 'admin') {
    header("Location: index.html");
    exit();
}
?>
<?php
include 'conexion.php';

// Obtener todos los usuarios
$query = "SELECT id, nombre, nombre_usuario, correo, rol, estado, fecha_registro FROM usuarios";
$stmt = $pdo->query($query);
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de usuarios</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <style>
    .main-container {
        border: 2px solid black; /* Borde negro alrededor del contenedor */
        margin: 20px auto;
        width: 80%;
        height: 400px; /* Ajusta la altura del contenedor */
        overflow-y: auto; /* Habilita el scroll vertical */
        background-color: #f0f0f0; /* Fondo gris claro */
        padding: 10px;
        }
    </style>
 </head>
<body>
    <header>
        <div class="menu">
            <div class="logo-container">
                <img src="../assets/img/logo.png" alt="Logo" class="logo">
            </div>
            <div>
                <nav>
                    <a href="dashboard_admin.php" class="link" style="background-color: rgb(255, 255, 255);">
                        <img src="../assets/img/registro.png" alt="Gestión" class="icon">
                        <span class="title">Usuarios</span>
                    </a>
                    <a href="inventario.php" class="link" style="background-color: rgb(192, 192, 192);">
                        <img src="../assets/img/inventario.png" alt="Inventario" class="icon">
                        <span class="title">Inventario</span>
                    </a>
                    <a href="facturacion.php" class="link" style="background-color: rgb(192, 192, 192);">
                        <img src="../assets/img/factura.png" alt="Facturación" class="icon">
                        <span class="title">Facturación</span>
                    </a>
                    <h1>Bienvenido Administrador, <?php echo $_SESSION['nombre']; ?> 🛠️</h1>
                    <a href="../backend/logout.php">Cerrar sesión</a>
                </nav>
            </div>
        </div>
    </header>

    <div class="main-container">
        <div id="registro-acciones" class="acciones">
            <?php if ($_SESSION['rol'] === 'admin'): ?>
        <a href="registrar_usuario.php" id="openModalBtn">
                Registrar Usuario
                <img src="../assets/img/registrar.png" width="30" alt="Registrar">
            </a>
            <?php endif; ?>
            <div class="separator"></div>
            <?php if ($_SESSION['rol'] === 'admin'): ?>
        <a href="usuarios.php">
             Editar <img src="../assets/img/cliceditar.png" width="30" alt="Editar">
        </a>
        <?php endif; ?>
            <div class="separator"></div>
            <?php if ($_SESSION['rol'] === 'admin'): ?>
            <a href="eliminar_usuario.php">
             Eliminar <img src="../assets/img/eliminar.png" width="30" alt="Eliminar"></a>
            <?php endif; ?>
        </div>

        <div class="container-fluid">
            <br>
            <table class="custom-table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Usuario</th>
                <th>Correo</th>
                <th>Rol</th>
                <th>Estado</th>
                <th>Fecha Registro</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <td><?php echo htmlspecialchars($usuario['nombre']); ?></td>
                    <td><?php echo htmlspecialchars($usuario['nombre_usuario']); ?></td>
                    <td><?php echo htmlspecialchars($usuario['correo']); ?></td>
                    <td><?php echo htmlspecialchars($usuario['rol']); ?></td>
                    <td><?php echo $usuario['estado'] ? 'Activo' : 'Inactivo'; ?></td>
                    <td><?php echo htmlspecialchars($usuario['fecha_registro']); ?></td>
                    <td>
                        <a href="actualizar_usuario.php?id=<?php echo $usuario['id']; ?>">Editar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
        </div>  
    </div>
</body>
</html>
