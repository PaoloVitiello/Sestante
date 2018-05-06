DROP TABLE IF EXISTS `ascensori`;

CREATE TABLE ascensori (
id INT NOT NULL AUTO_INCREMENT,
idvideo TEXT,
piano INT,
percorso TEXT,
descrizione TEXT,
dimensione_font INT,
spegnimento TEXT,
paginazione TEXT NOT NULL DEFAULT "",
PRIMARY KEY(id)
);
INSERT INTO ascensori (idvideo, piano, percorso, descrizione, dimensione_font) VALUES
('0401', 4,"grigio",  "piano 4, grigio", 30),
('0402', 4,"rosso",   "piano 4, rosso", 30),
('0403', 4,"azzurro", "piano 4, azzurro", 30),
('0404', 4,"arancio", "piano 4, arancio", 30),
('0405', 4,"blu",     "piano 4, blu", 30),
('0406', 4,"viola",   "piano 4, viola", 30),
('0407', 4,"marrone", "piano 4, marrone", 30),
('0408', 4,"giallo",  "piano 4, giallo", 30),
('0409', 4,"verde",   "piano 4, verde", 30);
