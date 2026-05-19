<?php require_once 'config/database.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tengo tareas pendientes</title>
    <link rel="stylesheet" href="css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="container">
        <h1>Mis tareas</h1>

        <a href="crear.php" class="btn-nueva">+ tarea</a>
        
        <div class="filtros">
            <a href="?filtro=todas">Todas</a>
            <a href="?filtro=pendiente">Pendientes</a>
            <a href="?filtro=completada">Completadas</a>
        </div>
        
        <table class="tabla-tareas">
            <thead>
                <tr><th>Título</th><th>Descripción</th><th>Estado</th><th>Acciones</th></tr>
            </thead>
            <tbody>
                <?php
                $filtro = $_GET['filtro'] ?? 'todas';
                if($filtro == 'todas') {
                    $sql = "SELECT * FROM tareas ORDER BY creado_en DESC";
                    $stmt = $pdo->query($sql);
                } else {
                    $sql = "SELECT * FROM tareas WHERE estado = ? ORDER BY creado_en DESC";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$filtro]);
                }
                
                while($tarea = $stmt->fetch(PDO::FETCH_ASSOC)):
                ?>
                <tr class="fila-<?= $tarea['estado'] ?>">
                    <td><?= htmlspecialchars($tarea['titulo']) ?></td>
                    <td><?= htmlspecialchars($tarea['descripcion']) ?></td>
                    <td>
                        <a href="toggle_estado.php?id=<?= $tarea['id'] ?>" class="btn-estado">
                            <?= $tarea['estado'] == 'pendiente' ? ' Pendiente' : ' Completada' ?>
                        </a>
                    </td>
                    <td class="acciones">
                        <a href="ver.php?id=<?= $tarea['id'] ?>" class="btn-ver">Ver</a>
                        <a href="editar.php?id=<?= $tarea['id'] ?>" class="btn-editar">Editar</a>
                        <a href="eliminar.php?id=<?= $tarea['id'] ?>" onclick="return confirm('¿Eliminar esta tarea?')" class="btn-eliminar">Eliminar</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <div class="recursos">
    <h3>Recursos útiles</h3>

    <div class="recursos-grid">
        <a href="https://calendar.google.com/" target="_blank">Google Calendar</a>
        <a href="https://trello.com/" target="_blank">Trello</a>
        <a href="https://www.notion.so/" target="_blank">Notion</a>
    </div>
    </div>

    </div>
</body>
</html>