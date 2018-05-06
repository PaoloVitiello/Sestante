<?php
$path=$_SERVER["DOCUMENT_ROOT"];
include "$path/sestante/srv/config.php";
include "$path/srv/db_helper.php";
connetti_db();

$today=date('Y-m-d');
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=sestante-percorsi-'.$today.'.csv');

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// output the column headings
fputcsv($output, array('id', 'attivo', 'videowall', 'ascensori', 'touch',
		       'reparto', 'reparto_esteso', 'edificio',
		       'piano', 'stanza', 'percorso'));

// fetch the data
$rows = mysql_query('SELECT id, attivo, videowall, ascensori, touch, reparto, reparto_esteso, edificio, piano, stanza, percorso FROM percorsi ORDER BY reparto');

// loop over the rows, outputting them
while ($row = mysql_fetch_assoc($rows)) fputcsv($output, $row);

?>
