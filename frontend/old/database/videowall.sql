DROP TABLE IF EXISTS `videowall`;

CREATE TABLE videowall (
id INT NOT NULL AUTO_INCREMENT,
numero_videowall INT,
larghezza_display INT,
altezza_display INT,
dimensioni_font INT,
altezza_riga INT,
larghezza_reparto INT,
larghezza_edificio INT,
larghezza_piano INT,
larghezza_stanza INT,
colore_sfondo TEXT,
sfondo_riga_pari TEXT,
sfondo_riga_dispari TEXT,
colore_riga TEXT,
colore_colonna_edificio TEXT,
sfondo_colonna_edificio TEXT,
colore_colonna_piano TEXT,
sfondo_colonna_piano TEXT,
colore_colonna_stanza TEXT,
sfondo_colonna_stanza TEXT,
PRIMARY KEY(Id)
);

INSERT INTO videowall VALUES(1,1,1080,1920,33,50,770,80,50,180,'2E2D62','F0F0F6','E3E1EE','2E2D62','FFFFFF','2E2D62','2E2D62','A4CEF0','2E2D62','D2E6F8');
