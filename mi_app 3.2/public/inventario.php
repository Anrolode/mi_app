<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['rol'] !== 'admin') {
    header("Location: index.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inventario</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <style>
        .main-container {
            height: 80px;
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
                    <a href="usuarios.php" class="link" id="registro-link" style="background-color: rgb(192, 192, 192);">
                        <img src="../assets/img/registro.png" alt="Registro" class="icon">
                        <span class="title">Usuarios</span>
                    </a>
                    <a href="dashboard_admin.php" class="link" style="background-color: white">
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
            <a href="productos_registrados.php">
                Productos Registrados
                <img src="../assets/img/productoregistrado.png" width="30" alt="registrarproducto">
            </a>
            <?php endif; ?>
            <div class="separator"></div>
            <?php if ($_SESSION['rol'] === 'admin'): ?>
            <a href="registrar_producto.php">
                Registrar Producto
                <img src="../assets/img/registrarproducto.png" width="30" alt="registrarproducto">
            </a>
            <?php endif; ?>
            <div class="separator"></div>
            <?php if ($_SESSION['rol'] === 'admin'): ?>
            <a href="generar_reporte.php">
                Generar reporte
                <img src="../assets/img/generarreporte.png" width="30" alt="generarreporte">
            </a>
            <?php endif; ?>
         </div>       
</body>
</html>
