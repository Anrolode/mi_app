<?php
include "conexion.php";

header("Content-Type: application/json");

function validarCampos($nombre, $nombre_usuario, $correo, $clave, $rol) {
    if (empty($nombre) || empty($nombre_usuario) || empty($correo) || empty($clave) || empty($rol)) {
        return ["status" => "error", "message" => "Todos los campos son obligatorios."];
    }

    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        return ["status" => "error", "message" => "Formato de correo no válido."];
    }

    if (strlen($nombre_usuario) > 30 || strlen($correo) > 100 || strlen($nombre) > 100) {
        return ["status" => "error", "message" => "Los campos exceden la longitud permitida."];
    }

    return null;
}

function verificarCorreoExistente($conexion, $correo) {
    $sql_check = "SELECT id FROM usuarios WHERE correo = ?";
    $stmt_check = $conexion->prepare($sql_check);
    $stmt_check->bind_param("s", $correo);
    $stmt_check->execute();
    $stmt_check->store_result();

    if ($stmt_check->num_rows > 0) {
        return ["status" => "error", "message" => "El correo ya está registrado."];
    }

    return null;
}

function registrarUsuario($conexion, $nombre, $nombre_usuario, $correo, $clave_hash, $rol, $estado) {
    $sql = "INSERT INTO usuarios (nombre, nombre_usuario, correo, clave, rol, estado) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sssssi", $nombre, $nombre_usuario, $correo, $clave_hash, $rol, $estado);
        if ($stmt->execute()) {
            return ["status" => "success", "message" => "Registro exitoso"];
        } else {
            return ["status" => "error", "message" => "Error en el registro: " . $stmt->error];
        }
        $stmt->close();
    } else {
        return ["status" => "error", "message" => "Error en la consulta: " . $conexion->error];
    }
}

// Obtener los datos
$nombre = trim($_POST['nombre']);
$nombre_usuario = trim($_POST['nombre_usuario']);
$correo = trim($_POST['correo']);
$clave = trim($_POST['clave']);
$rol = trim($_POST['rol']);
$estado = isset($_POST['estado']) ? (int) $_POST['estado'] : 1; // Por defecto activo

// Validar campos
$validacion = validarCampos($nombre, $nombre_usuario, $correo, $clave, $rol);
if ($validacion) {
    echo json_encode($validacion);
    exit;
}

// Verificar si el correo ya está registrado
$correoExistente = verificarCorreoExistente($conexion, $correo);
if ($correoExistente) {
    echo json_encode($correoExistente);
    exit;
}

// Hash de la contraseña
$clave_hash = password_hash($clave, PASSWORD_DEFAULT);

// Registrar el usuario
$resultado = registrarUsuario($conexion, $nombre, $nombre_usuario, $correo, $clave_hash, $rol, $estado);
echo json_encode($resultado);

$conexion->close();
?>

