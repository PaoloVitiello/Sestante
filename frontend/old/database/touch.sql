DROP TABLE IF EXISTS `touch`;

CREATE TABLE `touch` (
    `id` int(2) NOT NULL AUTO_INCREMENT,
    `descrizione` TEXT,
    `ip` TEXT,
    `carta` BOOLEAN,
    `timestamp_carta` INT,
    PRIMARY KEY (`id`)
);

INSERT INTO `touch`
(id, descrizione, ip, carta, timestamp_carta) VALUES 
(1, "Touchscreen piano 3", '10.100.219.198', 1, 20150220093000);



