<?php

function runMigrations()

{
    try {
        // error_log("prueba log: " . "\n", 3, __DIR__ . "../app/Storage/Logs/app.log");

        // Conectar a la base de datos tasklist
        $pdo = new PDO('mysql:host=mysql;dbname=tasklist', 'root', 'secret');

        // Verificar si la tabla de migraciones existe, si no, crearla
        $pdo->exec("CREATE TABLE IF NOT EXISTS migrations (name VARCHAR(255) PRIMARY KEY)");

        // Verificar si las migraciones ya han sido ejecutadas
        $stmt = $pdo->query("SELECT COUNT(*) FROM migrations WHERE name = 'initial_migration'");

        if ($stmt->fetchColumn() == 0) {
            // Ejecutar las migraciones SQL desde el archivo
            $sql = file_get_contents(__DIR__ . '/migration.sql');

            $pdo->exec($sql);

            // Marcar la migración como ejecutada
            $stmt = $pdo->prepare("INSERT INTO migrations (name) VALUES (?)");
            $stmt->execute(['initial_migration']);

            echo "Migraciones ejecutadas exitosamente.<br>";
        } else {
            echo "Las migraciones ya han sido ejecutadas previamente.<br>";
        }
    } catch (PDOException $e) {
        // error_log("Error al ejecutar migraciones: " . $e->getMessage() . "\n", 3, __DIR__ . "../app/Storage/Logs/app.log");
        echo "Error al ejecutar migracioness: " . $e->getMessage() . "<br>";
    }
}
