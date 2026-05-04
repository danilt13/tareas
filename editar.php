<?php require_once 'config/database.php';

$id = $_GET['id'] ?? 0;

$stmt = $pdo->prepare("SELECT * FROM tareas WHERE id = ?");
$stmt->execute([$id]);
$tarea = $stmt->fetch();

if(!$tarea) {
    header('Location: index.php');
    exit;
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql = "UPDATE tareas SET titulo = ?, descripcion = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_POST['titulo'], $_POST['descripcion'], $id]);
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar tarea</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Editar tarea</h1>
        <form method="POST">
            <div class="campo">
                <label>Título *</label>
                <input type="text" name="titulo" value="<?= htmlspecialchars($tarea['titulo']) ?>" required>
            </div>
            <div class="campo">
                <label>Descripción</label>
                <textarea name="descripcion" rows="4"><?= htmlspecialchars($tarea['descripcion']) ?></textarea>
            </div>
            <div class="botones">
                <button type="submit" class="btn-guardar">Actualizar</button>
                <a href="index.php" class="btn-cancelar">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>