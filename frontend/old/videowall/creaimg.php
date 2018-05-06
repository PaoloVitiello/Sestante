<?php
$path=$_SERVER["DOCUMENT_ROOT"];
include_once "$path/sestante/srv/config.php";
include($path."/sestante/srv/db_helper.php");
include_once "$path/sestante/srv/doctype.php";



echo '<HTML>  <link rel="stylesheet" href="/sestante/srv/styles.css" type="text/css"><HEAD></HEAD><BODY>';
//$idvideo='0301';
connetti_db();

$display = db_query_value("SELECT * FROM displaywall WHERE idvideo='$idvideo'");
list($id,
     $id_videowall,
     $id_displaywall,
     $idvideo,
     $righe) = $display;

  
  
$vid = db_query_value("SELECT * FROM videowall WHERE id='$id_videowall'");
list($id,
     $numero_videowall,
     $larghezza_display,
     $altezza_display,
     $dimensioni_font,
     $altezza_riga,
     $larghezza_reparto,
     $larghezza_edificio,
     $larghezza_piano,
     $larghezza_stanza,
     $colore_sfondo,
     $sfondo_riga_pari,
     $sfondo_riga_dispari,
     $colore_riga,
     $colore_colonna_edificio,
     $sfondo_colonna_edificio,
     $colore_colonna_piano,
     $sfondo_colonna_piano,
     $colore_colonna_stanza,
     $sfondo_colonna_stanza) = $vid;
	 
if ($negativo) {
  $colore_sfondo = sprintf("%06x",16777215-intval($colore_sfondo,16));
  $sfondo_riga_pari = sprintf("%06x",16777215-intval($sfondo_riga_pari,16));
  $sfondo_riga_dispari = sprintf("%06x",16777215-intval($sfondo_riga_dispari,16));
  $colore_riga = sprintf("%06x",16777215-intval($colore_riga,16));
  $colore_colonna_edificio = sprintf("%06x",16777215-intval($colore_colonna_edificio,16));
  $sfondo_colonna_edificio = sprintf("%06x",16777215-intval($sfondo_colonna_edificio,16));
  $colore_colonna_piano = sprintf("%06x",16777215-intval($colore_colonna_piano,16));
  $sfondo_colonna_piano = sprintf("%06x",16777215-intval($sfondo_colonna_piano,16));
  $colore_colonna_stanza = sprintf("%06x",16777215-intval($colore_colonna_stanza,16));
  $sfondo_colonna_stanza = sprintf("%06x",16777215-intval($sfondo_colonna_stanza,16));
}
	 

$totrighe = db_query_value("SELECT sum(righe) FROM displaywall WHERE idvideowall='$id_videowall' AND iddisplaywall<$id_displaywall");

	 
$query = "select * from percorsi WHERE attivo in ('S','s','X') AND videowall in ('S','s','X') ORDER BY reparto ";
$result = mysql_query($query);
$row=array();

while ($riga = mysql_fetch_assoc($result)){
  $row[]=$riga;
}

// tabella che racchiude tutta la pagina

echo "<table style='table-layout:fixed; float:left; display:block; height:{$altezza_display}px; width:{$larghezza_display}px; border:solid 1px;; margin:0; font-family:Montserrat; font-size:{$dimensioni_font}px; background-color:#$colore_sfondo;' cellspacing='0'>";

// prima riga, banda monocolore vuota
// TODO TOFIX gg 2014-12-19 ora altezza fissa 80px
//            deve essere modificabile via db/interfaccia

echo "<tr style='height:80px; width:360px;' >";
echo "<td style='width:{$larghezza_reparto}px;'></td>";
echo "<td style='width:{$larghezza_edificio}px;'></td>";
echo "<td style='width:{$larghezza_piano}px;'></td>";
echo "<td style='width:{$larghezza_stanza}px;'></td>";
echo "</tr>";


// intestazione / istruzioni
// da presentare solo sul primo displaywall
// HACK per ora mostrato a pagina intera, solo se numero righe = 0

if ($id_displaywall== 1 && $righe == 0)
{
  $istru_h = $altezza_display - 80*2;

  $istru_tr_style = "height: {$istru_h}px;";
  $istru_tr_style .= "background-color: #{$sfondo_riga_dispari};";

  $istru_td_style = "padding: 80px;";
  $istru_td_style .= "color: #{$colore_riga};";

  $istru_h1_style = "text-align: center;"; 
  $istru_h1_style .= "font-size: 2.5em;";
  $istru_h1_style .= "margin-bottom: 100px;";

  $istru_li_style = "margin-bottom: 40px;";
  $istru_li_style .= "font-size: 1.3em;";

  $istru_img_style = "width: 900px;"; 
  $istru_img_style .= "margin-top: 100px;";

  $istru_reparto = "color: #$colore_riga;"; 
  $istru_reparto .= "background-color: #$sfondo_riga_pari;";
  $istru_reparto .= "padding-left:0.3em;";
  $istru_reparto .= "display: inline-block;";
  $istru_reparto .= "text-align: left;";
  $istru_reparto .= "min-width: 550px;";
  $istru_reparto .= "font-size: {$dimensioni_font}px;";
  $istru_reparto .= "padding: 0 0.2em 0 0;";

  $istru_edificio = "color: #$colore_colonna_edificio;"; 
  $istru_edificio .= "background-color: #$sfondo_colonna_edificio;";
  $istru_edificio .= "font-weight: bold;";
  $istru_edificio .= "display: inline-block;";
  $istru_edificio .= "text-align: center;";
  $istru_edificio .= "min-width: {$larghezza_edificio}px;";
  $istru_edificio .= "font-size: {$dimensioni_font}px;";

  $istru_piano = "color: #$colore_colonna_piano;"; 
  $istru_piano .= "background-color: #$sfondo_colonna_piano;";
  $istru_piano .= "font-weight: bold;";
  $istru_piano .= "display: inline-block;";
  $istru_piano .= "text-align: right;";
  $istru_piano .= "min-width: {$larghezza_piano}px;";
  $istru_piano .= "font-size: {$dimensioni_font}px;";
  $istru_piano .= "padding: 0 0.2em 0 0;";

  $istru_stanza = "color: #$colore_colonna_stanza;"; 
  $istru_stanza .= "background-color: #$sfondo_colonna_stanza;";
  $istru_stanza .= "display: inline-block;";
  $istru_stanza .= "text-align: right;";
  $istru_l_stanza = $larghezza_stanza - 10;
  $istru_stanza .= "min-width: {$istru_l_stanza}px;";
  $istru_stanza .= "font-size: {$dimensioni_font}px;";
  $istru_stanza .= "padding: 0 0.2em 0 0;";

  echo "<tr style='{$istru_tr_style}'>";
  echo "  <td colspan='4' style='{$istru_td_style}'>";
  echo "    <h1 style='{$istru_h1_style}'>INFORMAZIONI</h1>";
  echo "<ol>";
  echo "<li style='{$istru_li_style}'> Individuare dall’elenco la propria destinazione e memorizzare il codice corrispondente. Esempio:<br> <span style='{$istru_reparto}'>Cardiologia</span><span style='{$istru_edificio}'>M</span><span style='{$istru_piano}'>8</span><span style='{$istru_stanza}'>M801</span></li>";
  echo "<li style='{$istru_li_style}'> Seguire le indicazioni di percorso della lettera indicata. Es: <span style='{$istru_edificio}'>M</span> </li>";
  echo "<li style='{$istru_li_style}'> Raggiungere il piano indicato dal numero successivo. Es:  <span style='{$istru_piano}'>8</span> </li>";
  echo "<li style='{$istru_li_style}'> Una volta al piano seguire le indicazioni per la destinazione finale. Es: <span style='{$istru_stanza}'>M801</span> </li>";
  echo "</ol>";
  echo "<img style='{$istru_img_style}' src='/img/gemelli_ucsc_900.png'>";
  echo "  </td>";
  echo "</tr>";
}



$i=0;
foreach($row as $value ) {
  extract($value);
  if($i>=$totrighe AND $i<$totrighe+$righe) 
  {
    $sfondo = ($i % 2) ? $sfondo_riga_pari : $sfondo_riga_dispari;
    $stanze = explode(" ", trim($stanza));
    $prima_stanza = $stanze[0];

    // riga
    echo "<tr style='height:{$altezza_riga}px; width:360px; background-color:#$sfondo; color:#$colore_riga' >";

    // reparto
    echo "<td style='text-align: left;max-width:{$larghezza_reparto}px; padding-left:0.3em;'>
            $reparto
          </td>";

    // edificio
    echo "<td style='max-width:{$larghezza_edificio}px; '>
           <div style='text-align: center; margin: 1px; color:#$colore_colonna_edificio; background-color:#$sfondo_colonna_edificio; font-weight:bold; overflow: hidden;'>
              $edificio
           <div>
          </td>";

    // piano
    echo "<td style='max-width:{$larghezza_piano}px;'>
            <div style='text-align: right; margin: 1px; color:#$colore_colonna_piano; background-color:#$sfondo_colonna_piano; font-weight:bold; padding: 0 0.2em 0 0;'>
              $piano
            </div>
          </td>";

    // stanza
    echo "<td style='max-width:{$larghezza_stanza}px;'>
            <div style='text-align: right; margin: 1px; color:#$colore_colonna_stanza; background-color:#$sfondo_colonna_stanza; padding: 0 0.2em 0 0; overflow: hidden;'>
              $prima_stanza
            </div>
          </td>";

    // fine riga
    echo "</tr>";
  }
  $i++;
}
  
//  echo '</table>';
//echo "<pre>";
//print_r($display);
//echo "</pre>";

?>

<!-- Content End -->
</BODY>
</HTML>
