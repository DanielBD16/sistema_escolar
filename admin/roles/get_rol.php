<?php
include('../../app/config.php');

if (!isset($_GET['id_rol'])) {
    echo json_encode(['error' => 'ID no proporcionado']);
    exit;
}

$id_rol = filter_var($_GET['id_rol'], FILTER_VALIDATE_INT);
$stmt = $pdo->prepare("SELECT * FROM roles WHERE id_rol = :id");
$stmt->execute(['id' => $id_rol]);
$rol = $stmt->fetch(PDO::FETCH_ASSOC);

if ($rol) {
    echo json_encode($rol);
} else {
    echo json_encode(['error' => 'Rol no encontrado']);
}
?>
