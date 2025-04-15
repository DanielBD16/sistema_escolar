<?php

include('../app/config.php');

session_start();

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM usuarios WHERE email = '$email' AND estado = 1";
$query = $pdo->prepare($sql);
$query->execute();

$usuarios = $query->fetchAll(fetch_style: PDO::FETCH_ASSOC);
// print_r($usuarios);

$contador = 0;
foreach ($usuarios as $usuario) {
    $password_tabla = $usuario['password'];
    $contador = $contador + 1;
}

if ($contador > 0  && password_verify($password, $password_tabla)) {
    $_SESSION['mensaje'] = "¡Bienvenido al sistema!";
    $_SESSION['tipo_mensaje'] = "success";
    $_SESSION['sesion_email'] = $email;
    $_SESSION['sesion_nombre'] = $usuario['nombres'];
    $_SESSION['sesion_rol_id'] = $usuario['rol_id'];
    header('Location: ' . APP_URL . '/admin');
    exit;
} else {
    $_SESSION['mensaje'] = "Los datos ingresados son incorrectos, vuelve a intentarlo";
    $_SESSION['tipo_mensaje'] = "error";
    // $_SESSION['mensaje'] = "Los datos ingresados son incorrectos, vuelve a intentarlo";
    header('Location: ' . APP_URL . '/login');
    exit;
}
