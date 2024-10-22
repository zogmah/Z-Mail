CREATE DATABASE IF NOT EXISTS zmail;
USE zmail;

CREATE TABLE IF NOT EXISTS usuario (
	user_id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(128) NOT NULL UNIQUE,
    username VARCHAR(48) NOT NULL UNIQUE,
    password VARCHAR(64) NOT NULL
    );
    
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
    