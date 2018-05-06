DROP TABLE IF EXISTS `utenti`;

CREATE TABLE `utenti` (
    `id` int(2) NOT NULL AUTO_INCREMENT,
    `username` CHAR(128) UNIQUE NOT NULL,
    `password` varchar(128),
    `nome` TEXT,
    `admin` BOOLEAN,
    PRIMARY KEY (`id`)
);

INSERT INTO `utenti`
(username, password, nome, admin) VALUES 
('admin', MD5('canotta'), "Amministratore", 1),
('qms', MD5('passa'), "Utente generico", 0),
('qms2', MD5('passa'), "Secondo utente generico", "0");


