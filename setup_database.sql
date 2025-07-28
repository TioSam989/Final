CREATE DATABASE IF NOT EXISTS bdstandds;
USE bdstandds;

CREATE TABLE IF NOT EXISTS clientes (
    idcli INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    datanasc DATE,
    categoria VARCHAR(50)
);

INSERT INTO clientes (nome, datanasc, categoria) VALUES
('João Silva', '1990-05-15', 'premium'),
('Maria Santos', '1985-08-22', 'regular'),
('Pedro Costa', '1992-12-10', 'premium');

DELIMITER //
CREATE PROCEDURE sp_dois(IN idcli INT, OUT total INT)
BEGIN
    SELECT COUNT(*) INTO total FROM clientes WHERE idcli = idcli;
END //
DELIMITER ;