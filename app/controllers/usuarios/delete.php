<?php
// 1) Incluimos la configuración y PDO
require_once __DIR__ . '/../../config.php';  

// 2) Solo aceptamos POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo 'Error: Método no permitido';
    exit;
}

// 3) Validamos que venga el ID
$id_usuario = $_POST['id_usuario'] ?? null;
if (!$id_usuario || !ctype_digit($id_usuario)) {
    echo 'Error: ID de usuario no válido';
    exit;
}

// 4) Preparamos y ejecutamos la eliminación
try {
    $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id_usuario = :id_usuario");
    $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo 'ok';  // éxito
    } else {
        // Si falla, devolvemos el error de PDO
        $errorInfo = $stmt->errorInfo();
        echo 'Error al eliminar el usuario: ' . $errorInfo[2];
    }
} catch (PDOException $e) {
    echo 'Error en la base de datos: ' . $e->getMessage();
}
