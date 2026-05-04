<?php
require_once 'config/database.php';

$id = $_GET['id'] ?? 0;

$stmt = $pdo->prepare("DELETE FROM tareas WHERE id = ?");
$stmt->execute([$id]);

header('Location: index.php');
exit;
?>