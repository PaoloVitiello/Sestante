<?php

 include 'functions.inc'; 

/* Definisci scopo applicazione */  

//$CONF['TypeApplication'] = 'WEB';
$CONF['TypeApplication'] = 'PS';



/* Accesso al database */

$CONF['database_type'] = 'mysql';
$CONF['database_host'] = 'localhost';
$CONF['database_user'] = 'root';
$CONF['database_password'] = 'Can0ttA';
$CONF['database_name'] = 'sestante';
$CONF['database_prefix'] = '';

/* File System */
$path=$_SERVER['DOCUMENT_ROOT'];
/*$CONF['Dir_installazione'] = '/var/www/theta/data/gemelli/web'; */
$CONF['Dir_installazione'] = $path;
$CONF['FileStampaPS'] = ''.$CONF['Dir_installazione'].'/images/mappe/stampa.ps';
$CONF['IMG_mappaGenerale']= ''.$CONF['Dir_installazione'].'/images/mappe/generale/pianta.gif';


/* LABEL */
$CONF['TitleApplication'] = 'Piante GEMELLI - 1';
$CONF['Home'] = 'MAPPA GENERALE';
$CONF['PaginaPrecedente'] = 'Pagina Precedente';        /* Label pulsante */
$CONF['PaginaSuccessiva'] = 'Pagina Successiva';        /* Label pulsante */

/* Temporizzazioni */
$CONF['AttendiRitornoMappa'] = '10';
$CONF['AttendiStampaPS'] = '60';


/* Data e ora */
setlocale(LC_ALL, 'it_IT');
date_default_timezone_set('Europe/Rome');
$CONF['Mese'] = ucfirst(strftime("%B"));
$CONF['Anno'] = strftime("%Y");
$CONF['Giorno'] = strftime("%d");
$CONF['NomeGiorno'] = ucfirst(strftime("%a"));
$CONF['Ora'] = strftime("%H");
$CONF['Minuti'] = strftime("%M");

?>
