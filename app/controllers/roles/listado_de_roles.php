<?php
// session_start();
// require_once __DIR__ . '/../validar_sesion.php';


$sql_roles = "SELECT * FROM roles WHERE estado = 1";
$query_roles = $pdo->prepare($sql_roles);
$query_roles->execute();
$roles = $query_roles->fetchAll(PDO::FETCH_ASSOC);


