<?php require_once 'config/database.php';

$id = $_GET['id'] ?? 0;

$stmt = $pdo->prepare("SELECT * FROM tareas WHERE id = ?");
$stmt->execute([$id]);
$tarea = $stmt->fetch();

if(!$tarea) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle de tarea</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Detalle de tarea</h1>
        
        <div class="detalle-tarea">
            <p><strong>ID:</strong> <?= $tarea['id'] ?></p>
            <p><strong>Título:</strong> <?= htmlspecialchars($tarea['titulo']) ?></p>
            <p><strong>Descripción:</strong></p>
            <div class="descripcion">
                <?= nl2br(htmlspecialchars($tarea['descripcion'])) ?>
            </div>
            <p><strong>Estado:</strong> 
                <?= $tarea['estado'] == 'pendiente' ? 'Pendiente' : 'Completada' ?>
            </p>
            <p><strong>Creado:</strong> <?= $tarea['creado_en'] ?></p>
        </div>
        
        <div class="botones-detalle">
            <a href="editar.php?id=<?= $tarea['id'] ?>" class="btn-editar">Editar</a>
            <a href="index.php" class="btn-volver">← Volver a la lista</a>
        </div>
    </div>
</body>
</html>