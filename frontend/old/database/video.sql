DROP TABLE IF EXISTS `video`;

CREATE TABLE `video` (
    `id` int(2) NOT NULL AUTO_INCREMENT,
    `idvideo` CHAR(4) UNIQUE NOT NULL DEFAULT '0000',
    `ip` varchar(32) UNIQUE,
    `descrizione` TEXT,
    `generatore` varchar(1024),
    `generatore2` varchar(1024),
    `generatore3` varchar(1024),
    `generatore4` varchar(1024),
    PRIMARY KEY (`id`)
);

INSERT INTO `video` 
(idvideo, ip, descrizione, generatore, generatore2, generatore3, generatore4) VALUES 
('0501', '192.168.2.41', "grigio 5o piano", "", "", "", ""),
('4002', '192.168.2.42', "RASPI GG", "", "", "", ""),
('4003', '192.168.2.43', "RASPI GG", "", "", "", ""),
('4004', '192.168.2.44', "RASPI GG", "", "", "", ""),
('4005', '192.168.2.45', "RASPI GG", "", "", "", ""),
('4006', '192.168.2.46', "RASPI GG", "", "", "", ""),
('4007', '192.168.2.47', "RASPI GG", "", "", "", ""),
('4008', '192.168.2.48', "RASPI GG", "", "", "", ""),
('0401', '192.168.2.49', "RASPI GG", "", "", "", ""),
('0402', '192.168.2.50', "RASPI GG", "", "", "", ""),
('0403', '10.100.219.88', "test", "", "", "", ""),
('0001', '192.168.2.104', "touch di la", "", "", "", "");

ALTER TABLE `video` MODIFY `ip` VARCHAR(256);