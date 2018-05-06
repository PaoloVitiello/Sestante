DROP TABLE IF EXISTS progresso;
CREATE TABLE progresso (
    `Id` int(2) NOT NULL AUTO_INCREMENT,
    `Parametro` TEXT,
    `Valore` TEXT,
    PRIMARY KEY (`id`)
);

INSERT INTO progresso
(Parametro, Valore) VALUES
('totale_invio', '0'),
('progresso_invio', '0'),
('timestamp_invio', '0'),
('errori_invio',''),
('totale_save', '0'),
('progresso_save', '0'),
('timestamp_save', '0'),
('errori_save', '');
