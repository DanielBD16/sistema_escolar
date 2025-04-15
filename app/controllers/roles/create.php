<?php
session_start();
include('../../config.php');

$nombre_rol = $_POST['nombre_rol'] ?? null;
$nombre_rol = mb_strtoupper(trim($nombre_rol), 'UTF-8');

if (!$nombre_rol) {
    $_SESSION['mensaje'] = 'El nombre del rol es obligatorio.';
    $_SESSION['tipo_mensaje'] = 'error';
    header('Location: ' . APP_URL . 'admin/roles/create.php');
    exit;
}

$fecha_hora_actual = date("Y-m-d H:i:s");

try {
    // Validar duplicado
    $verifica = $pdo->prepare("SELECT COUNT(*) FROM roles WHERE nombre_rol = :nombre_rol");
    $verifica->bindParam(':nombre_rol', $nombre_rol);
    $verifica->execute();

    if ($verifica->fetchColumn() > 0) {
        $_SESSION['mensaje'] = 'Este rol ya existe.';
        $_SESSION['tipo_mensaje'] = 'warning';
        header('Location: ' . APP_URL . 'admin/roles/create.php');
        exit;
    }

    // Insertar
    $sentencia = $pdo->prepare("INSERT INTO roles (nombre_rol, fyh_creacion, estado) VALUES (:nombre_rol, :fyh_creacion, :estado)");
    $sentencia->bindParam(':nombre_rol', $nombre_rol);
    $sentencia->bindParam(':fyh_creacion', $fecha_hora_actual);
    $sentencia->bindParam(':estado', $estado_de_registro);

    if ($sentencia->execute()) {
        $_SESSION['mensaje'] = 'Rol registrado correctamente.';
        $_SESSION['tipo_mensaje'] = 'success';
        header('Location: ' . APP_URL . 'admin/roles/index.php');
        exit;
    } else {
        $_SESSION['mensaje'] = 'Error al registrar el rol.';
        $_SESSION['tipo_mensaje'] = 'error';
        header('Location: ' . APP_URL . 'admin/roles/create.php');
        exit;
    }
} catch (PDOException $e) {
    $_SESSION['mensaje'] = 'Error: ' . $e->getMessage();
    $_SESSION['tipo_mensaje'] = 'error';
    header('Location: ' . APP_URL . 'admin/roles/create.php');
    exit;
}
