<?php
include('../../app/config.php');

$id_rol = $_POST['id_rol'];
$nombre_rol = strtoupper(trim($_POST['nombre_rol']));

$stmt = $pdo->prepare("UPDATE roles SET nombre_rol = :nombre WHERE id_rol = :id");
$success = $stmt->execute([
    'nombre' => $nombre_rol,
    'id' => $id_rol
]);

echo $success ? 'ok' : 'error';
?>
