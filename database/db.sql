CREATE TABLE usuarios (
    id_usuario INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombres VARCHAR(255) NOT NULL,
    cargo VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE KEY,
    password TEXT NOT NULL,
    fyh_creacion DATETIME NULL,
    fyh_actualizacion DATETIME NULL,
    estado VARCHAR(11)
) ENGINE = InnoDB;

INSERT INTO
    usuarios (
        nombres,
        cargo,
        email,
        password,
        fyh_creacion,
        estado
    )
VALUES
    (
        'Daniel Blas Durand',
        'ADMINISTRADOR',
        'admin@admin.com',
        '$2y$10$FnKrTXj0rvOND0uUIfbASuBWIT1iwHC7jt1qelYhtYCsTk4T57mKS',
        '2025-03-31 20:29:10',
        '1'
    );

CREATE TABLE roles (
    id_rol INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre_rol VARCHAR(255) NOT NULL,
    fyh_creacion DATETIME NULL,
    fyh_actualizacion DATETIME NULL,
    estado VARCHAR(11)
) ENGINE = InnoDB;

INSERT INTO roles (nombre_rol, fyh_creacion, estado) VALUES
('ADMINISTRADOR', '2025-03-31 20:29:10', '1'),
('DIRECTOR ACADÉMICO', '2025-03-31 20:29:10', '1'),
('DIRECTOR ADMINISTRATIVO', '2025-03-31 20:29:10', '1'),
('COORDINADOR', '2025-03-31 20:29:10', '1'),
('DOCENTE', '2025-03-31 20:29:10', '1'),
('ESTUDIANTE', '2025-03-31 20:29:10', '1'),
('SECRETARÍA', '2025-03-31 20:29:10', '1');
