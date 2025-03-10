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
    <title>Registro de usuarios</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        /* Estilos para el modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 10;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4); /* Fondo oscuro semi-transparente */
        }

        .modal-content {
            position: absolute;
            top: 100px; /* Ajusta según la posición deseada */
            left: 50%;
            transform: translateX(-50%);
            width: 400px; /* Ancho del formulario */
            background-color: rgb(195, 195, 195); /* Fondo gris */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            position: relative; /* Necesario para posicionar el botón de cierre */
        }

        .modal-header {
            display: flex;
            justify-content: flex-end;
        }

        .close {
            font-size: 24px;
            cursor: pointer;
            color: #333;
        }

        .modal-content label {
            display: block;
            margin-bottom: 10px;
        }

        .modal-content input,
        .modal-content select {
            width: calc(100% - 20px);
            padding: 8px;
            margin-bottom: 10px;
        }

        .modal-content .buttons {
            display: flex;
            justify-content: space-between;
        }

        .modal-content .buttons button {
            padding: 10px;
        }
    </style>
</head>
<body>
    <header>
        <div class="menu">
            <div class="logo-container">
                <img src="img/logo.png" alt="Logo" class="logo">
            </div>  
            <div>
                <nav>
                    <a href="registrousuario.php" class="link" id="registro-link" style="background-color: rgb(192, 192, 192);">
                        <img src="img/registro.png" alt="Registro" class="icon">
                        <span class="title">Usuarios</span>
                    </a>
                    <a href="dashboard_admin.php" class="link" style="background-color: white">
                        <img src="img/inventario.png" alt="Inventario" class="icon">
                        <span class="title">Inventario</span>
                    </a>
                    <a href="facturacion.html" class="link" style="background-color: rgb(192, 192, 192);">
                        <img src="img/factura.png" alt="Facturación" class="icon">
                        <span class="title">Facturación</span>
                    </a>
                    <h1>Bienvenido Administrador, <?php echo $_SESSION['nombre']; ?> 🛠️</h1>
                    <a href="../backend/logout.php">Cerrar sesión</a>
                </nav>
            </div>
        </div>
    </header>

    <!-- Contenedor principal con scroll -->
    <div class="main-container">
        <!-- Sección de acciones (Registrar, Editar, Eliminar) -->
        <div id="registro-acciones" class="acciones">
            <a href="#" onclick="openRegisterModal()">
                Registrar producto
                <img src="img/registrarproducto.png" width="30" alt="registrarproducto">
            </a>
            <div class="separator"></div>
            <a href="stock.html">
                Stock
                <img src="img/stock.png" width="30" alt="stock">
            </a>
            <div class="separator"></div>
            <a href="generarreporte.html">
                Generar reporte
                <img src="img/generarreporte.png" width="30" alt="generarreporte">
            </a>
         </div>       

         <!-- Tabla de productos -->
         <div class="container-fluid">
            <br>
            <table class="custom-table">
              <thead>
                <tr>
                  <th>Nombre del producto</th>
                  <th>Descripción</th>
                  <th>Precio</th>
                  <th>Categoría</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
        </div>  
    </div>

    <!-- Modal para registrar producto -->
    <div id="registerModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="close" onclick="closeRegisterModal()">&times;</span>
            </div>
            <h2>Registrar Producto</h2>
            <form id="registroProductoForm">
                <label for="Producto">Nombre del producto:</label>
                <input type="text" id="Producto" name="producto" value="" required>
                <br>
                <label for="Descripción">Descripción:</label>
                <textarea id="descripcion" name="descripcion" rows="3" required></textarea> 
                <label for="Precio">Precio ($):</label>
                <input type="number" id="Precio" name="Precio" required>
                <br>
                <label for="categoria">Categoría:</label>
                <select id="categoria" name="categoria" required>
                    <option value="" disabled selected>Seleccione categoría</option>
                    <option value="Muebles">Muebles</option>
                    <option value="Electronica">Electrónica</option>
                    <option value="Oficinas">Oficinas</option>
                </select>                
                <br>
                <div class="buttons">
                    <button type="submit">Registrar</button>
                    <button type="button" onclick="closeRegisterModal()">Cancelar</button>
                </div>
            </form>
        </div>
    </div>

    <script src="js/registroproducto.js"></script>

    <script>
        function openRegisterModal() {
            document.getElementById('registerModal').style.display = 'block';
        }

        function closeRegisterModal() {
            document.getElementById('registerModal').style.display = 'none';
        }

        // Cerrar el modal si se hace clic fuera de él
        window.onclick = function(event) {
            if (event.target == document.getElementById('registerModal')) {
                closeRegisterModal();
            }
        }
    </script>
</body>
</html>