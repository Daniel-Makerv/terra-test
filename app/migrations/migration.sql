CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    last_name VARCHAR(100),
    email VARCHAR(100)
);

CREATE TABLE IF NOT EXISTS tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    task_name VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users (name, last_name, email) VALUES
('user', 'terra', 'terra@example.com');



-- Insertar 10 tareas ficticias
INSERT INTO tasks (task_name) VALUES 
('Revisar correos'),
('Preparar presentación'),
('Actualizar base de datos'),
('Llamar a cliente'),
('Reunión semanal'),
('Enviar reporte'),
('Analizar métricas'),
('Planificar proyecto'),
('Hacer backup'),
('Capacitación interna');
