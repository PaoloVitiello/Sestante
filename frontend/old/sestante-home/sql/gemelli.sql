-- phpMyAdmin SQL Dump
-- version 2.7.0-pl2
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generato il: 04 Gen, 2007 at 03:48 PM
-- Versione MySQL: 4.0.23
-- Versione PHP: 4.3.10
-- 
-- Database: `gemelli`
-- 

-- --------------------------------------------------------

-- 
-- Struttura della tabella `SviluppoUnita`
-- 

-- DROP TABLE IF EXISTS `SviluppoUnita`;
CREATE TABLE `SviluppoUnita` (
  `id` int(11) NOT NULL auto_increment,
  `piano` char(2) NOT NULL default '',
  `idPercorso` tinyint(2) NOT NULL default '0',
  `idFabbricato` tinyint(2) NOT NULL default '0',
  `unita` varchar(60) NOT NULL default '',
  `descrizione` varchar(255) NOT NULL default '',
  `reparto` int(11) NOT NULL default '0',
  UNIQUE KEY `id_2` (`id`),
  KEY `id` (`id`)
) TYPE=MyISAM AUTO_INCREMENT=2 ;

-- 
-- Dump dei dati per la tabella `SviluppoUnita`
-- 

INSERT INTO `SviluppoUnita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (1, '2', 1, 1, '1', '1', 1);

-- --------------------------------------------------------

-- 
-- Struttura della tabella `fabbricato`
-- 

DROP TABLE IF EXISTS `fabbricato`;
CREATE TABLE `fabbricato` (
  `idFabbricato` tinyint(2) NOT NULL auto_increment,
  `fabbricato` varchar(255) NOT NULL default '',
  KEY `idPercorso` (`idFabbricato`)
) TYPE=MyISAM AUTO_INCREMENT=17 ;

-- 
-- Dump dei dati per la tabella `fabbricato`
-- 

INSERT INTO `fabbricato` (`idFabbricato`, `fabbricato`) VALUES (1, 'A');
INSERT INTO `fabbricato` (`idFabbricato`, `fabbricato`) VALUES (2, 'D1');
INSERT INTO `fabbricato` (`idFabbricato`, `fabbricato`) VALUES (3, 'E');
INSERT INTO `fabbricato` (`idFabbricato`, `fabbricato`) VALUES (4, 'L');
INSERT INTO `fabbricato` (`idFabbricato`, `fabbricato`) VALUES (5, 'M');
INSERT INTO `fabbricato` (`idFabbricato`, `fabbricato`) VALUES (6, 'B');
INSERT INTO `fabbricato` (`idFabbricato`, `fabbricato`) VALUES (7, 'C');
INSERT INTO `fabbricato` (`idFabbricato`, `fabbricato`) VALUES (8, 'D1');
INSERT INTO `fabbricato` (`idFabbricato`, `fabbricato`) VALUES (9, 'F');
INSERT INTO `fabbricato` (`idFabbricato`, `fabbricato`) VALUES (10, 'N');
INSERT INTO `fabbricato` (`idFabbricato`, `fabbricato`) VALUES (11, 'O');
INSERT INTO `fabbricato` (`idFabbricato`, `fabbricato`) VALUES (12, 'P');
INSERT INTO `fabbricato` (`idFabbricato`, `fabbricato`) VALUES (13, 'Q');
INSERT INTO `fabbricato` (`idFabbricato`, `fabbricato`) VALUES (14, 'J');
INSERT INTO `fabbricato` (`idFabbricato`, `fabbricato`) VALUES (15, 'CEMI');
INSERT INTO `fabbricato` (`idFabbricato`, `fabbricato`) VALUES (16, 'MI');

-- --------------------------------------------------------

-- 
-- Struttura della tabella `percorso`
-- 

DROP TABLE IF EXISTS `percorso`;
CREATE TABLE `percorso` (
  `idPercorso` tinyint(2) NOT NULL auto_increment,
  `bullet` varchar(255) NOT NULL default '/images/percorsoBullet.gif',
  `descrizione` varchar(255) NOT NULL default '',
  `note` varchar(255) default '',
  `base` varchar(255) NOT NULL default '',
  `img1` varchar(255) NOT NULL default '',
  `img2` varchar(255) NOT NULL default '',
  `img3` varchar(255) NOT NULL default '',
  `img4` varchar(255) NOT NULL default '',
  `piantaFinale` varchar(255) NOT NULL default '',
  `imgPS` varchar(255) NOT NULL default '',
  `imgWEB` varchar(255) NOT NULL default '',
  KEY `idPercorso` (`idPercorso`)
) TYPE=MyISAM AUTO_INCREMENT=16 ;

-- 
-- Dump dei dati per la tabella `percorso`
-- 

INSERT INTO `percorso` (`idPercorso`, `bullet`, `descrizione`, `note`, `base`, `img1`, `img2`, `img3`, `img4`, `piantaFinale`, `imgPS`, `imgWEB`) VALUES (1, '/images/bullet/percorsoBullet1.gif', 'Percorso GRIGIO', NULL, '/images/mappe/current/PiantaComp.eps', '/images/mappe/current/Legende.eps', '/images/mappe/current/PercA.eps', '/images/mappe/current/img.eps', '/images/mappe/current/letters.eps', '/images/mappe/PercA/stampa.ps', '/images/mappe/PercA/percorso.ps', '/images/mappe/PercA/percorso.gif');
INSERT INTO `percorso` (`idPercorso`, `bullet`, `descrizione`, `note`, `base`, `img1`, `img2`, `img3`, `img4`, `piantaFinale`, `imgPS`, `imgWEB`) VALUES (2, '/images/bullet/percorsoBullet2.gif', 'Percorso ARANCIONE', NULL, '/images/mappe/current/PiantaComp.eps', '/images/mappe/current/Legende.eps', '/images/mappe/current/PercD2.eps', '/images/mappe/current/img.eps', '/images/mappe/current/letters.eps', '/images/mappe/PercD2/stampa.ps', '/images/mappe/PercD2/percorso.ps', '/images/mappe/PercD2/percorso.gif');
INSERT INTO `percorso` (`idPercorso`, `bullet`, `descrizione`, `note`, `base`, `img1`, `img2`, `img3`, `img4`, `piantaFinale`, `imgPS`, `imgWEB`) VALUES (3, '/images/bullet/percorsoBullet3.gif', 'Percorso MARRONE', NULL, '/images/mappe/current/PiantaComp.eps', '/images/mappe/current/Legende.eps', '/images/mappe/current/PercE.eps', '/images/mappe/current/img.eps', '/images/mappe/current/letters.eps', '/images/mappe/PercE/stampa.ps', '/images/mappe/PercE/percorso.ps', '/images/mappe/PercE/percorso.gif');
INSERT INTO `percorso` (`idPercorso`, `bullet`, `descrizione`, `note`, `base`, `img1`, `img2`, `img3`, `img4`, `piantaFinale`, `imgPS`, `imgWEB`) VALUES (4, '/images/bullet/percorsoBullet4.gif', 'Percorso GIALLO', NULL, '/images/mappe/current/PiantaComp.eps', '/images/mappe/current/Legende.eps', '/images/mappe/current/PercL-M.eps', '/images/mappe/current/img.eps', '/images/mappe/current/letters.eps', '/images/mappe/PercL-M/stampa.ps', '/images/mappe/PercL-M/percorso.ps', '/images/mappe/PercL-M/percorso.gif');
INSERT INTO `percorso` (`idPercorso`, `bullet`, `descrizione`, `note`, `base`, `img1`, `img2`, `img3`, `img4`, `piantaFinale`, `imgPS`, `imgWEB`) VALUES (5, '/images/bullet/percorsoBullet5.gif', 'Percorso ROSSO', NULL, '/images/mappe/current/PiantaComp.eps', '/images/mappe/current/Legende.eps', '/images/mappe/current/PercB-C.eps', '/images/mappe/current/img.eps', '/images/mappe/current/letters.eps', '/images/mappe/PercB-C/stampa.ps', '/images/mappe/PercB-C/percorso.ps', '/images/mappe/PercB-C/percorso.gif');
INSERT INTO `percorso` (`idPercorso`, `bullet`, `descrizione`, `note`, `base`, `img1`, `img2`, `img3`, `img4`, `piantaFinale`, `imgPS`, `imgWEB`) VALUES (6, '/images/bullet/percorsoBullet6.gif', 'Percorso BLU', NULL, '/images/mappe/current/PiantaComp.eps', '/images/mappe/current/Legende.eps', '/images/mappe/current/PercD1.eps', '/images/mappe/current/img.eps', '/images/mappe/current/letters.eps', '/images/mappe/PercD1/stampa.ps', '/images/mappe/PercD1/percorso.ps', '/images/mappe/PercD1/percorso.gif');
INSERT INTO `percorso` (`idPercorso`, `bullet`, `descrizione`, `note`, `base`, `img1`, `img2`, `img3`, `img4`, `piantaFinale`, `imgPS`, `imgWEB`) VALUES (7, '/images/bullet/percorsoBullet7.gif', 'Percorso VERDE', NULL, '/images/mappe/current/PiantaComp.eps', '/images/mappe/current/Legende.eps', '/images/mappe/current/PercF.eps', '/images/mappe/current/img.eps', '/images/mappe/current/letters.eps', '/images/mappe/PercF/stampa.ps', '/images/mappe/PercF/percorso.ps', '/images/mappe/PercF/percorso.gif');
INSERT INTO `percorso` (`idPercorso`, `bullet`, `descrizione`, `note`, `base`, `img1`, `img2`, `img3`, `img4`, `piantaFinale`, `imgPS`, `imgWEB`) VALUES (8, '/images/bullet/percorsoBullet8.gif', 'Percorso AZZURRO', NULL, '/images/mappe/current/PiantaComp.eps', '/images/mappe/current/Legende.eps', '/images/mappe/current/PercN-O-P-Q.eps', '/images/mappe/current/img.eps', '/images/mappe/current/letters.eps', '/images/mappe/PercN-O-P-Q/stampa.ps', '/images/mappe/PercN-O-P-Q/percorso.ps', '/images/mappe/PercN-O-P-Q/percorso.gif');
INSERT INTO `percorso` (`idPercorso`, `bullet`, `descrizione`, `note`, `base`, `img1`, `img2`, `img3`, `img4`, `piantaFinale`, `imgPS`, `imgWEB`) VALUES (9, '/images/bullet/percorsoBullet9.gif', 'Percorso VIOLA', NULL, '/images/mappe/current/PiantaComp.eps', '/images/mappe/current/Legende.eps', '/images/mappe/current/Percpiastra.eps', '/images/mappe/current/img.eps', '/images/mappe/current/letters.eps', '/images/mappe/Percpiastra/stampa.ps', '/images/mappe/Percpiastra/percorso.ps', '/images/mappe/Percpiastra/percorso.gif');
INSERT INTO `percorso` (`idPercorso`, `bullet`, `descrizione`, `note`, `base`, `img1`, `img2`, `img3`, `img4`, `piantaFinale`, `imgPS`, `imgWEB`) VALUES (10, '/images/bullet/percorsoBullet10.gif', 'Percorso NERO', 'Questa unità si trova nel complesso Sanitario Polifunzionale. Seguire il percorso grigio fino al 7à piano e proseguire per il ponte di collegamento', '/images/mappe/current/PiantaComp.eps', '/images/mappe/current/Legende.eps', '/images/mappe/current/PercA.eps', '/images/mappe/current/img.eps', '/images/mappe/current/letters.eps', '/images/mappe/PercA/stampa.ps', '/images/mappe/PercA/percorso.ps', '/images/mappe/PercA/percorso.gif');
INSERT INTO `percorso` (`idPercorso`, `bullet`, `descrizione`, `note`, `base`, `img1`, `img2`, `img3`, `img4`, `piantaFinale`, `imgPS`, `imgWEB`) VALUES (15, '/images/percorsoBullet.gif', '', '', '/images/mappe/generale/img.gif', '', '', '', '', '', '', '');

-- --------------------------------------------------------

-- 
-- Struttura della tabella `reparto`
-- 

DROP TABLE IF EXISTS `reparto`;
CREATE TABLE `reparto` (
  `idReparto` tinyint(2) NOT NULL auto_increment,
  `reparto` varchar(255) NOT NULL default '',
  KEY `idPercorso` (`idReparto`)
) TYPE=MyISAM AUTO_INCREMENT=14 ;

-- 
-- Dump dei dati per la tabella `reparto`
-- 

INSERT INTO `reparto` (`idReparto`, `reparto`) VALUES (1, 'Day  Hospital');
INSERT INTO `reparto` (`idReparto`, `reparto`) VALUES (2, 'Ambulatori e Servizi');
INSERT INTO `reparto` (`idReparto`, `reparto`) VALUES (3, 'Reparti - Unit&agrave; Operative');

-- --------------------------------------------------------

-- 
-- Struttura della tabella `unita`
-- 

DROP TABLE IF EXISTS `unita`;
CREATE TABLE `unita` (
  `id` int(11) NOT NULL auto_increment,
  `piano` char(2) NOT NULL default '',
  `idPercorso` tinyint(2) NOT NULL default '0',
  `idFabbricato` tinyint(2) NOT NULL default '0',
  `unita` varchar(60) NOT NULL default '',
  `descrizione` varchar(255) NOT NULL default '',
  `reparto` int(11) NOT NULL default '0',
  UNIQUE KEY `id_2` (`id`),
  KEY `id` (`id`)
) TYPE=MyISAM AUTO_INCREMENT=131 ;

-- 
-- Dump dei dati per la tabella `unita`
-- 

INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (1, '9', 6, 2, 'Allergologia', '', 1);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (2, '8', 2, 7, 'Cardiologia', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex. Lor', 1);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (3, '0', 10, 15, 'Centro Med. dell''invecch. - Geriatria', '', 1);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (4, '10', 8, 12, 'Chirurgia digestiva', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex. Lor', 1);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (5, '9', 8, 10, 'Chirurgia endocrina', '', 1);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (6, '6', 8, 10, 'Chirurgia generale', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex. Lor', 1);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (7, '2', 2, 2, 'Chirurgia senologica', '', 1);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (8, '8', 4, 5, 'Chirurgia vascolare', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex. Lor', 1);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (9, '1', 10, 16, 'Clinica delle Malattie Infettive', '', 1);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (10, '9', 2, 2, 'Dermatologia e Chirurgia Plastica', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex. Lor', 1);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (11, '8', 6, 8, 'Diabetologia', '', 1);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (12, '10', 8, 10, 'Ematologia', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex. Lor', 1);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (13, '3', 4, 4, 'Endocrinologia', '', 1);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (14, '10', 4, 5, 'Malattie del ricambio', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex. Lor', 1);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (15, '4', 4, 5, 'Medicina interna e Gastroenterologia', '', 1);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (16, '10', 8, 10, 'Neurochirurgia', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex. Lor', 1);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (17, '7', 3, 3, 'Neurologia', '', 1);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (18, '3', 4, 5, 'Neuropsichiatria infantile', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex. Lor', 1);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (19, '2', 2, 7, 'Neuropsicologia', '', 1);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (70, '2', 8, 10, 'Oculistica', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex. Lor', 1);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (21, '5', 6, 8, 'Odontoiatria', '', 1);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (22, '8', 6, 8, 'Oncologia Medica', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex. Lor', 1);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (23, '10', 6, 8, 'Oncologia Pediatrica', '', 1);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (24, '3', 1, 1, 'Ostetricia e Ginecologia', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex. Lor', 1);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (25, '2', 2, 7, 'Otorinolaringoiatria', '', 1);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (26, '5', 4, 5, 'Pediatria', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex. Lor', 1);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (27, '-1', 4, 5, 'Psichiatria clinica e tossicodipendenze', '', 1);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (28, '2', 7, 9, 'Radiochemioterapia', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex. Lor', 1);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (29, '9', 8, 12, 'Urologia', '', 1);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (74, '3', 7, 9, 'Accettazione ricoveri e Day Hospital', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 2);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (75, '9', 6, 2, 'Allergologia', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 2);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (76, '8', 3, 3, 'Ambulatorio P.U.V.A.', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 2);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (77, '3', 9, 14, 'Analisi Ormonali', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 2);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (78, '4', 9, 14, 'Analisi immunologiche', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 2);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (79, '3', 7, 3, 'Angiologia medica', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 2);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (80, '8', 5, 7, 'Cardiologia Diagnostica Invasiva', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 2);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (81, '8', 2, 2, 'Cardiologia Diagnostica non Invasiva', '', 2);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (82, '0', 9, 14, 'Centro Antiveleni', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 2);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (83, '9', 2, 4, 'Centro di Biomagnetismo - Fisiol. Clinica', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 2);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (84, '3', 7, 9, 'Centro di Coordinamento Diagnostico', '', 2);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (85, '6', 5, 7, 'Centro Ipertensione', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 2);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (86, '7', 1, 1, 'Centro Studi e Amb. Med. dello Sport', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 2);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (87, '-1', 9, 14, 'Centro Trasfusionale (Lab. - Emoteca)', '', 2);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (88, '-1', 9, 14, 'Centro donatori', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 2);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (89, '3', 9, 14, 'Chimica clinica', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 2);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (90, '0', 10, 16, 'Clinica delle Malattie Infettive', '', 2);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (91, '4', 3, 3, 'Consultazione psichiatrica', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 2);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (92, '1', 4, 4, 'Dietetica', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 2);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (93, '3', 9, 14, 'Ematologia', '', 2);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (94, '10', 8, 11, 'Ematologia (Amb. "A. Ferrara")', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 2);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (95, '9', 1, 1, 'Emodialisi pazienti ricoverati', '', 2);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (96, '3', 1, 1, 'Endoscopia Digestiva Chirurgica', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 2);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (97, '3', 9, 14, 'Farmacologia', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 2);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (98, '2', 6, 14, 'Fisiopatologia respiratoria', '', 2);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (99, '9', 2, 2, 'Foniatria e Logopedia', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 2);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (100, '7', 2, 8, 'Gastroenterologia', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 2);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (101, '4', 9, 14, 'Genetica Medica', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 2);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (102, '7', 1, 1, 'I.S.I. - Ginecologia Disfunzionale', '', 2);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (103, '3', 9, 14, 'Istopatologia', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 2);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (104, '3', 9, 14, 'Malattie Emorragiche e Trombotiche', '', 2);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (105, '7', 2, 7, 'Med. del Lavoro e Tossicol. Ind.', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 2);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (106, '-1', 10, 15, 'Medicina Fisica e Riabilitazione', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 2);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (107, '2', 7, 3, 'Medicina Nucleare', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 2);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (108, '4', 9, 14, 'Microbiologia e virologia', '', 2);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (109, '2', 2, 7, 'Neuropsicologia', '', 2);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (110, '1', 8, 12, 'Oculustica', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 2);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (111, '7', 5, 6, 'Ortopedia', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 2);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (112, '3', 5, 7, 'Otorinolaringoiatria - Audiologia', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 2);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (113, '0', 10, 16, 'PET - TAC', '', 2);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (114, '8', 6, 8, 'Poliambulatorio', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 2);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (115, '7', 6, 8, 'Poliambulatorio', '', 2);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (116, '4', 6, 8, 'Poliambulatorio', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 2);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (117, '0', 9, 14, 'Pronto Soccorso', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 2);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (118, '2', 7, 9, 'Radiodiagnostica', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 2);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (119, '2', 7, 9, 'Radioterapia', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 2);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (120, '2', 6, 8, 'Sala Unica Prelievi', '', 2);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (121, '3', 6, 8, 'Spedalità - Accettazione ambulatoriale', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 2);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (122, '3', 7, 9, 'U.R.P. Accoglienza', '', 2);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (123, '8', 8, 10, 'Cardiochirurgia', '', 3);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (124, '8', 4, 5, 'Cardiochirurgia 2', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 3);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (125, '8', 8, 12, 'Cardiologia 1', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 3);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (126, '8', 4, 5, 'Cardiologia 2', '', 3);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (127, '5', 8, 12, 'Centro immaturi', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 3);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (128, '10', 8, 12, 'Chirurgia digestiva', '', 3);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (129, '10', 5, 6, 'Chirurgia endocrina', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 3);
INSERT INTO `unita` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (130, '6', 8, 10, 'Chirurgia generale 1', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 3);

-- --------------------------------------------------------

-- 
-- Struttura della tabella `unita2`
-- 

DROP TABLE IF EXISTS `unita2`;
CREATE TABLE `unita2` (
  `id` int(11) NOT NULL auto_increment,
  `piano` char(2) NOT NULL default '',
  `idPercorso` tinyint(2) NOT NULL default '0',
  `idFabbricato` tinyint(2) NOT NULL default '0',
  `unita` varchar(60) NOT NULL default '',
  `descrizione` varchar(255) NOT NULL default '',
  `reparto` int(11) NOT NULL default '0',
  UNIQUE KEY `id_2` (`id`),
  KEY `id` (`id`)
) TYPE=MyISAM AUTO_INCREMENT=131 ;

-- 
-- Dump dei dati per la tabella `unita2`
-- 

INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (1, '9', 6, 2, 'Allergologia', '', 1);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (2, '8', 2, 7, 'Cardiologia', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex. Lor', 1);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (3, '0', 10, 15, 'Centro Med. dell''invecch. - Geriatria', '', 1);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (4, '10', 8, 12, 'Chirurgia digestiva', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex. Lor', 1);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (5, '9', 8, 10, 'Chirurgia endocrina', '', 1);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (6, '6', 8, 10, 'Chirurgia generale', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex. Lor', 1);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (7, '2', 2, 2, 'Chirurgia senologica', '', 1);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (8, '8', 4, 5, 'Chirurgia vascolare', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex. Lor', 1);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (9, '1', 10, 16, 'Clinica delle Malattie Infettive', '', 1);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (10, '9', 2, 2, 'Dermatologia e Chirurgia Plastica', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex. Lor', 1);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (11, '8', 6, 8, 'Diabetologia', '', 1);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (12, '10', 8, 10, 'Ematologia', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex. Lor', 1);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (13, '3', 4, 4, 'Endocrinologia', '', 1);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (14, '10', 4, 5, 'Malattie del ricambio', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex. Lor', 1);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (15, '4', 4, 5, 'Medicina interna e Gastroenterologia', '', 1);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (16, '10', 8, 10, 'Neurochirurgia', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex. Lor', 1);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (17, '7', 3, 3, 'Neurologia', '', 1);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (18, '3', 4, 5, 'Neuropsichiatria infantile', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex. Lor', 1);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (19, '2', 2, 7, 'Neuropsicologia', '', 1);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (70, '2', 8, 10, 'Oculistica', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex. Lor', 1);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (21, '5', 6, 8, 'Odontoiatria', '', 1);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (22, '8', 6, 8, 'Oncologia Medica', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex. Lor', 1);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (23, '10', 6, 8, 'Oncologia Pediatrica', '', 1);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (24, '3', 1, 1, 'Ostetricia e Ginecologia', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex. Lor', 1);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (25, '2', 2, 7, 'Otorinolaringoiatria', '', 1);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (26, '5', 4, 5, 'Pediatria', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex. Lor', 1);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (27, '-1', 4, 5, 'Psichiatria clinica e tossicodipendenze', '', 1);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (28, '2', 7, 9, 'Radiochemioterapia', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex. Lor', 1);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (29, '9', 8, 12, 'Urologia', '', 1);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (74, '3', 7, 9, 'Accettazione ricoveri e Day Hospital', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 2);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (75, '9', 6, 2, 'Allergologia', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 2);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (76, '8', 3, 3, 'Ambulatorio P.U.V.A.', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 2);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (77, '3', 9, 14, 'Analisi Ormonali', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 2);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (78, '4', 9, 14, 'Analisi immunologiche', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 2);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (79, '3', 7, 3, 'Angiologia medica', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 2);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (80, '8', 5, 7, 'Cardiologia Diagnostica Invasiva', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 2);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (81, '8', 2, 2, 'Cardiologia Diagnostica non Invasiva', '', 2);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (82, '0', 9, 14, 'Centro Antiveleni', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 2);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (83, '9', 2, 4, 'Centro di Biomagnetismo - Fisiol. Clinica', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 2);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (84, '3', 7, 9, 'Centro di Coordinamento Diagnostico', '', 2);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (85, '6', 5, 7, 'Centro Ipertensione', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 2);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (86, '7', 1, 1, 'Centro Studi e Amb. Med. dello Sport', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 2);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (87, '-1', 9, 14, 'Centro Trasfusionale (Lab. - Emoteca)', '', 2);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (88, '-1', 9, 14, 'Centro donatori', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 2);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (89, '3', 9, 14, 'Chimica clinica', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 2);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (90, '0', 10, 16, 'Clinica delle Malattie Infettive', '', 2);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (91, '4', 3, 3, 'Consultazione psichiatrica', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 2);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (92, '1', 4, 4, 'Dietetica', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 2);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (93, '3', 9, 14, 'Ematologia', '', 2);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (94, '10', 8, 11, 'Ematologia (Amb. "A. Ferrara")', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 2);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (95, '9', 1, 1, 'Emodialisi pazienti ricoverati', '', 2);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (96, '3', 1, 1, 'Endoscopia Digestiva Chirurgica', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 2);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (97, '3', 9, 14, 'Farmacologia', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 2);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (98, '2', 6, 14, 'Fisiopatologia respiratoria', '', 2);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (99, '9', 2, 2, 'Foniatria e Logopedia', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 2);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (100, '7', 2, 8, 'Gastroenterologia', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 2);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (101, '4', 9, 14, 'Genetica Medica', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 2);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (102, '7', 1, 1, 'I.S.I. - Ginecologia Disfunzionale', '', 2);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (103, '3', 9, 14, 'Istopatologia', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 2);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (104, '3', 9, 14, 'Malattie Emorragiche e Trombotiche', '', 2);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (105, '7', 2, 7, 'Med. del Lavoro e Tossicol. Ind.', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 2);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (106, '-1', 10, 15, 'Medicina Fisica e Riabilitazione', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 2);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (107, '2', 7, 3, 'Medicina Nucleare', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 2);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (108, '4', 9, 14, 'Microbiologia e virologia', '', 2);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (109, '2', 2, 7, 'Neuropsicologia', '', 2);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (110, '1', 8, 12, 'Oculustica', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 2);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (111, '7', 5, 6, 'Ortopedia', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 2);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (112, '3', 5, 7, 'Otorinolaringoiatria - Audiologia', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 2);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (113, '0', 10, 16, 'PET - TAC', '', 2);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (114, '8', 6, 8, 'Poliambulatorio', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 2);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (115, '7', 6, 8, 'Poliambulatorio', '', 2);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (116, '4', 6, 8, 'Poliambulatorio', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 2);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (117, '0', 9, 14, 'Pronto Soccorso', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 2);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (118, '2', 7, 9, 'Radiodiagnostica', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 2);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (119, '2', 7, 9, 'Radioterapia', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 2);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (120, '2', 6, 8, 'Sala Unica Prelievi', '', 2);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (121, '3', 6, 8, 'Spedalità - Accettazione ambulatoriale', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 2);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (122, '3', 7, 9, 'U.R.P. Accoglienza', '', 2);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (123, '8', 8, 10, 'Cardiochirurgia', '', 3);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (124, '8', 4, 5, 'Cardiochirurgia 2', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 3);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (125, '8', 8, 12, 'Cardiologia 1', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 3);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (126, '8', 4, 5, 'Cardiologia 2', '', 3);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (127, '5', 8, 12, 'Centro immaturi', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 3);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (128, '10', 8, 12, 'Chirurgia digestiva', '', 3);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (129, '10', 5, 6, 'Chirurgia endocrina', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 3);
INSERT INTO `unita2` (`id`, `piano`, `idPercorso`, `idFabbricato`, `unita`, `descrizione`, `reparto`) VALUES (130, '6', 8, 10, 'Chirurgia generale 1', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex.', 3);
