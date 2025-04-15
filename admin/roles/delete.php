<?php
include('../../app/config.php');

if (!isset($_POST['id_rol'])) {
    echo 'error';
    exit;
}

$id_rol = filter_var($_POST['id_rol'], FILTER_VALIDATE_INT);

$stmt = $pdo->prepare("DELETE FROM roles WHERE id_rol = :id");
$success = $stmt->execute(['id' => $id_rol]);

echo $success ? 'ok' : 'error';
?>
