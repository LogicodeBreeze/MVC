-- -------------------------------------------------------
-- Base de datos: Biblioteca
-- -------------------------------------------------------
CREATE DATABASE IF NOT EXISTS Biblioteca
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE Biblioteca;

-- -------------------------------------------------------
-- 1) Tabla Usuarios (login / registro)
-- -------------------------------------------------------
CREATE TABLE usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombreUsuario VARCHAR(50) NOT NULL UNIQUE,
  email VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  nivel INT NOT NULL DEFAULT 2, 
  fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- -------------------------------------------------------
-- 2) Tabla Autores (solo nombre + apellidos)
-- -------------------------------------------------------
CREATE TABLE autores (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(60) NOT NULL,
  apellidos VARCHAR(90) NOT NULL
) ENGINE=InnoDB;

-- -------------------------------------------------------
-- 3) Tabla Editoriales (pocos campos)
-- -------------------------------------------------------
CREATE TABLE editoriales (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(120) NOT NULL UNIQUE
) ENGINE=InnoDB;

-- -------------------------------------------------------
-- 4) Tabla Libros
-- -------------------------------------------------------
CREATE TABLE libros (
  id INT AUTO_INCREMENT PRIMARY KEY,
  titulo VARCHAR(150) NOT NULL,
  descripcion TEXT,
  anio INT NOT NULL,
  idAutor INT NOT NULL,
  idEditorial INT NOT NULL,
  fecha_alta TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

  CONSTRAINT fk_libros_autores
    FOREIGN KEY (idAutor) REFERENCES autores(id)
    ON DELETE RESTRICT ON UPDATE CASCADE,

  CONSTRAINT fk_libros_editoriales
    FOREIGN KEY (idEditorial) REFERENCES editoriales(id)
    ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB;

-- -------------------------------------------------------
-- Datos de prueba
-- -------------------------------------------------------

-- Usuarios (password sin hash solo para pruebas; en tu app deberías guardar hash)
INSERT INTO usuarios (nombreUsuario, email, password, nivel) VALUES
('admin', 'admin@biblioteca.com', '123456', 1),
('juan',  'juan@ejemplo.com',     '123456', 2);

-- Autores
INSERT INTO autores (nombre, apellidos) VALUES
('Gabriel', 'García Márquez'),
('Isabel', 'Allende'),
('Miguel', 'de Cervantes');

-- Editoriales
INSERT INTO editoriales (nombre) VALUES
('Planeta'),
('Anaya'),
('Penguin Random House');

-- Libros (ojo: ids según inserts anteriores)
INSERT INTO libros (titulo, descripcion, anio, idAutor, idEditorial) VALUES
('Cien años de soledad', 'Novela emblemática del realismo mágico.', 1967, 1, 1),
('La casa de los espíritus', 'Saga familiar con elementos mágicos.', 1982, 2, 3),
('Don Quijote de la Mancha', 'Clásico de la literatura española.', 1605, 3, 2);