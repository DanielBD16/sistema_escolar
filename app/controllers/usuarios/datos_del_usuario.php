<?php 
$id_usuario = $_GET['id']; // ← Tomamos el id directamente de la URL

$sql_usuarios = "SELECT * FROM usuarios WHERE estado = 1 and id_usuario = '$id_usuario'";
$query_usuarios = $pdo->prepare($sql_usuarios);
$query_usuarios->execute();
$usuarios = $query_usuarios->fetchAll(PDO::FETCH_ASSOC);

foreach ($usuarios as $usuario) {
    $nombres = $usuario['nombres'] ?? null;
    $rol_id = $usuario['rol_id'];  // Esto es el ID del rol

    // Consultamos el nombre del rol basado en el rol_id
    $sql_rol = "SELECT nombre_rol FROM roles WHERE id_rol = '$rol_id'"; // Buscamos el nombre del rol
    $query_rol = $pdo->prepare($sql_rol);
    $query_rol->execute();
    $rol = $query_rol->fetch(PDO::FETCH_ASSOC);
    
    $nombre_rol = $rol['nombre_rol'] ?? 'Sin rol'; // Si no encuentra el rol, ponemos 'Sin rol'

    $email = $usuario['email'];
    $password = $usuario['password'];
}
?>


