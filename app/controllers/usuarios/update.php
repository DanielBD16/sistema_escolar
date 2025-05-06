<?php

include(__DIR__ . '/../../config.php');
session_start();

if (isset($_POST['btn-registrar-rol'])) {

    // Obtener datos del formulario
    $id_usuario = $_POST['id_usuario'];
    $nombres = $_POST['nombres'] ?? null;
    $rol_id = $_POST['rol_id'];
    $email = $_POST['email'];

    $password = $_POST['password'];
    $repetir_password = $_POST['repetir_password'];

    // Validar contraseñas
    if ($password !== $repetir_password) {
        $_SESSION['mensaje'] = "❌ Las contraseñas no coinciden.";
        $_SESSION['icono'] = "error";
        header("Location: " . APP_URL . "/admin/usuarios/edit.php?id=" . $id_usuario);
        exit();
    }

    // Si NO se ingresó una nueva contraseña
    if (empty($password)) {
        $sentencia = $pdo->prepare("UPDATE usuarios 
            SET nombres = :nombres,
                rol_id = :rol_id,
                email = :email
            WHERE id_usuario = :id_usuario");

        $resultado = $sentencia->execute([
            ':nombres' => $nombres,
            ':rol_id' => $rol_id,
            ':email' => $email,
            ':id_usuario' => $id_usuario
        ]);
    } else {
        // Si SÍ se ingresó una nueva contraseña
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $sentencia = $pdo->prepare("UPDATE usuarios 
            SET nombres = :nombres,
                rol_id = :rol_id,
                email = :email,
                password = :password,
                fyh_creacion = :fyh_creacion,
                estado = :estado
            WHERE id_usuario = :id_usuario");

        $resultado = $sentencia->execute([
            ':nombres' => $nombres,
            ':rol_id' => $rol_id,
            ':email' => $email,
            ':password' => $password_hash,
            ':fyh_creacion' => date("Y-m-d H:i:s"),
            ':estado' => 1,
            ':id_usuario' => $id_usuario
        ]);
    }

    if ($resultado) {
        $_SESSION['mensaje'] = "✅ Usuario actualizado correctamente.";
        $_SESSION['icono'] = "success";
    } else {
        $_SESSION['mensaje'] = "❌ Error al actualizar el usuario. Intenta nuevamente.";
        $_SESSION['icono'] = "error";
    }

    header("Location: " . APP_URL . "/admin/usuarios/edit.php?id=" . $id_usuario);
    exit();
} else {
    $_SESSION['mensaje'] = "❌ Acceso no permitido.";
    $_SESSION['icono'] = "warning";
    header("Location: " . APP_URL . "/admin/usuarios/");
    exit();
}
