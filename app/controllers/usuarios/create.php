<?php

// Asegura la ruta correcta al archivo de configuración
include(__DIR__ . '/../../config.php');


session_start();

// Validamos que se haya presionado el botón de registrar
if (isset($_POST['btn-registrar-rol'])) {
    
    // Obtenemos los datos del formulario
    $nombres = $_POST['nombres'] ?? null;
    $rol_id = $_POST['rol_id'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repetir_password = $_POST['repetir_password'];

    // Validamos que las contraseñas coincidan
    if ($password != $repetir_password) {
        $_SESSION['mensaje'] = "❌ Las contraseñas no coinciden.";
        $_SESSION['icono'] = "error";
        header("Location: " . APP_URL . "/admin/usuarios/create.php");
        exit();
    }

    // Hasheamos la contraseña
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Guardamos el usuario en la base de datos
    $sentencia = $pdo->prepare("INSERT INTO usuarios 
        (nombres, rol_id, email, password, fyh_creacion, estado) 
        VALUES (:nombres, :rol_id, :email, :password, :fyh_creacion, :estado)");

    $resultado = $sentencia->execute([
        ':nombres' => $nombres,
        ':rol_id' => $rol_id,
        ':email' => $email,
        ':password' => $password_hash,
        ':fyh_creacion' => date("Y-m-d H:i:s"),
        ':estado' => 1
    ]);

    if ($resultado) {
        $_SESSION['mensaje'] = "✅ Se registró el usuario correctamente.";
        $_SESSION['icono'] = "success";
    } else {
        $_SESSION['mensaje'] = "❌ Error al registrar el usuario. Intenta nuevamente.";
        $_SESSION['icono'] = "error";
    }
    

    header("Location: " . APP_URL . "/admin/usuarios/create.php");
    exit();
} else {
    $_SESSION['mensaje'] = "❌ Acceso no permitido.";
    $_SESSION['icono'] = "warning";
    header("Location: " . APP_URL . "/admin/usuarios/");
    exit();
}




