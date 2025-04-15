<?php
include('../../app/config.php');

// Validar existencia del parámetro
if(!isset($_GET['id_rol'])) {
    die('ID de rol no especificado');
}

// Obtener y sanitizar ID
$id_rol = filter_var($_GET['id_rol'], FILTER_VALIDATE_INT);
if(!$id_rol) {
    die('ID de rol inválido');
}

// Consulta segura
$stmt = $pdo->prepare("SELECT * FROM roles WHERE id_rol = :id_rol");
$stmt->execute(['id_rol' => $id_rol]);
$rol = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$rol) {
    die('Rol no encontrado');
}
?>

<!-- Solo el contenido del modal -->
<div class="container p-4">
    <h3 class="mb-4">Detalles del Rol</h3>
    
    <div class="row">
        <div class="col-md-12">
            <p><strong>Nombre del rol:</strong> <?= htmlspecialchars($rol['nombre_rol']) ?></p>
        </div>
    </div>
    
    <div class="row mt-3">
        <div class="col-md-9"></div>
        <div class="col-md-3">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                <i class="bi bi-x-lg"></i> Cerrar
            </button>
        </div>
    </div>
</div>