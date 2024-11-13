-- Incluyo la query de la creación de la base de datos para que se vea la información de cada tabla
CREATE DATABASE IF NOT EXISTS zmail;
USE zmail;

-- Tabla de los usuarios
CREATE TABLE IF NOT EXISTS usuario (
	user_id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(128) NOT NULL UNIQUE,
    username VARCHAR(48) NOT NULL UNIQUE,
    password VARCHAR(64) NOT NULL,
    rol ENUM('admin', 'usuario') DEFAULT 'usuario',
    estado TINYINT(1) DEFAULT 1;
    );

-- Tabla de los mensajes, basicamente cada mensaje que se envía   
CREATE TABLE IF NOT EXISTS mensaje (
	mensaje_id INT AUTO_INCREMENT PRIMARY KEY,
    remitente_id INT NOT NULL,
    destinatario_id INT NOT NULL,
    asunto VARCHAR(255) NOT NULL,
    texto TEXT NOT NULL,
    horario TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (remitente_id) REFERENCES usuario(user_id),
    FOREIGN KEY (destinatario_id) REFERENCES usuario(user_id)
    );

-- Tabla con la configuración de la página web, para hacer el sitio web más dinamico
CREATE TABLE IF NOT EXISTS configuracion (
    config_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) UNIQUE NOT NULL,
    valor TEXT NOT NULL
);