<?php

// Detectar si es Railway
if(getenv('MYSQLHOST')) {
    // =============================================
    // CONFIGURACIÓN PARA RAILWAY (PRODUCCIÓN)
    // =============================================
    $host = getenv('MYSQLHOST');
    $port = getenv('MYSQLPORT');
    $dbname = getenv('MYSQLDATABASE');
    $user = getenv('MYSQLUSER');
    $password = getenv('MYSQLPASSWORD');
} else {
    // =============================================
    // CONFIGURACIÓN PARA XAMPP
    // =============================================
    $host = 'localhost';
    $port = '3307';
    $dbname = 'tareas_db';
    $user = 'root';
    $password = '';
}

try {
    $pdo = new PDO(
        "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4",
        $user,
        $password
    );
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
} catch(PDOException $e) {
    die("Error de conexión a la base de datos: " . $e->getMessage());
}
?>