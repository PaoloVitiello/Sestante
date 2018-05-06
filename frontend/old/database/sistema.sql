DROP TABLE IF EXISTS sistema;
CREATE TABLE sistema (
    `Id` int(2) NOT NULL AUTO_INCREMENT,
    `Parametro` TEXT,
    `Valore` TEXT,
    `Descrizione` TEXT,
    `Pattern` TEXT,
    PRIMARY KEY (`id`)
);

INSERT INTO sistema 
(Parametro, Valore, Descrizione, Pattern) VALUES
('Ip Server', '10.36.0.182', "Indirizzo IP dell'unità di controllo", "([01]?\\d\\d?|2[0-4]\\d|25[0-5])\\.([01]?\\d\\d?|2[0-4]\\d|25[0-5])\\.([01]?\\d\\d?|2[0-4]\\d|25[0-5])\\.([01]?\\d\\d?|2[0-4]\\d|25[0-5])"),
('Persistenza', 'S', "Riduzione della permanenza a video con effetto negativo [S/N]", "[SN]"),
('PersistenzaStart', '19:00', 'Orario di inizio della funzione di riduzione permanenza [HH:MM]', '([01]?[0-9]|2[0-3]):[0-5][0-9]'),
('PersistenzaEnd', '6:00', 'Orario di fine della funzione di riduzione permanenza [HH:MM]', '([01]?[0-9]|2[0-3]):[0-5][0-9]'),
('PianoUscita', '4', "Piano in cui si trova l\'uscita", '-?([0-9]|[1-9][0-9])'),
('TimeoutTouchScreen', '60', "Secondi timeout touchscreen per ritorno a schermata iniale", '[0-9]+'),
('AccensioneMonitor', "6:00", "Orario di accensione dei monitor di cui si attiva lo spegnimento", '([01]?[0-9]|2[0-3]):[0-5][0-9]'),
('SpegnimentoMonitor', "22:00", "Orario di spegnimento dei monitor di cui si attiva lo spegnimento", '([01]?[0-9]|2[0-3]):[0-5][0-9]'),
('IntervalloPaginazione', "30", "Intervallo in secondi tra una pagina e la successiva su disp ascensori", '[0-9]+');

