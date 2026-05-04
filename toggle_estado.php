<?php
require_once 'config/database.php';

$id = $_GET['id'] ?? 0;

$stmt = $pdo->prepare("SELECT estado FROM tareas WHERE id = ?");
$stmt->execute([$id]);
$tarea = $stmt->fetch();

if($tarea) {
    $nuevoEstado = $tarea['estado'] == 'pendiente' ? 'completada' : 'pendiente';
    $stmt = $pdo->prepare("UPDATE tareas SET estado = ? WHERE id = ?");
    $stmt->execute([$nuevoEstado, $id]);
}

header('Location: index.php');
exit;
?>