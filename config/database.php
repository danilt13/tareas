<?php

// =============================================
// DETECTAR RENDER (POSTGRESQL)
// =============================================
if(getenv('DB_HOST')) {

    $host = getenv('DB_HOST');
    $port = getenv('DB_PORT');
    $dbname = getenv('DB_NAME');
    $user = getenv('DB_USER');
    $password = getenv('DB_PASSWORD');

    try {
        $pdo = new PDO(
            "pgsql:host=$host;port=$port;dbname=$dbname",
            $user,
            $password
        );

    } catch(PDOException $e) {
        die("Error de conexión a la base de datos: " . $e->getMessage());
    }

// =============================================
// LOCAL (XAMPP - MYSQL)
// =============================================
} else {

    $host = 'localhost';
    $port = '3307';
    $dbname = 'tareas_db';
    $user = 'root';
    $password = '';

    try {
        $pdo = new PDO(
            "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4",
            $user,
            $password
        );

    } catch(PDOException $e) {
        die("Error de conexión a la base de datos: " . $e->getMessage());
    }
}

// Configuración común
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

?>
