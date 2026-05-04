<?php require_once 'config/database.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql = "INSERT INTO tareas (titulo, descripcion) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_POST['titulo'], $_POST['descripcion']]);
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>+ tarea</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>+ tarea</h1>
        <form method="POST">
            <div class="campo">
                <label>Título *</label>
                <input type="text" name="titulo" required>
            </div>
            <div class="campo">
                <label>Descripción</label>
                <textarea name="descripcion" rows="4"></textarea>
            </div>
            <div class="botones">
                <button type="submit" class="btn-guardar">Guardar</button>
                <a href="index.php" class="btn-cancelar">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>