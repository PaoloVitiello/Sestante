<?php
$path=$_SERVER["DOCUMENT_ROOT"];
include_once "$path/sestante/srv/config.php";
include($path."/sestante/srv/db_helper.php");
include_once "$path/sestante/srv/doctype.php";


echo '<HTML>';
echo '<link rel="stylesheet" href="/sestante/srv/styles.css" type="text/css">';
echo '<HEAD></HEAD>';
echo '<BODY>';

connetti_db();

$q = "SELECT idvideo, piano, percorso, dimensione_font, paginazione
      FROM ascensori WHERE id = '$idascensore' ";
$ascensore = db_query_value($q);
list($idvideo, $piano_corrente, $percorso, $dimensione_font, $paginazione) = $ascensore;
$percorso = trim(strtolower($percorso));

$uscita = db_query_value("SELECT Valore FROM sistema WHERE Parametro='PianoUscita'");

// i parametri grafici li prendiamo dal primo
// videowall, HACK TOFIX? 2015-01-07
$vid = db_query_value("SELECT dimensioni_font, larghezza_display, altezza_display, altezza_riga, larghezza_reparto, larghezza_edificio, larghezza_piano, larghezza_stanza, colore_sfondo, sfondo_riga_pari, sfondo_riga_dispari, colore_riga, colore_colonna_edificio, sfondo_colonna_edificio, colore_colonna_piano, sfondo_colonna_piano, colore_colonna_stanza, sfondo_colonna_stanza FROM videowall ORDER BY id LIMIT 1");
list($dimensioni_font_videowall,
     $larghezza_display,
     $altezza_display,
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
	 
// HACK TOFIX 2015-01-14
// larghezza_stanza diminuita visto che anche nel videowall e' troppo larga
// e qui abbiamo bisogno di spazio orizzontale
 $larghezza_stanza -= 50;

// HACK TOFIX 2015-01-19
// le dimensioni di varie parti del video sono scalate in base
// al rapporto ($scale) tra dimensione font del videowall e ascensore
$scale = $dimensione_font / $dimensioni_font_videowall;
$altezza_riga = intval($altezza_riga * $scale);
$larghezza_edificio = intval($larghezza_edificio * $scale);
$larghezza_stanza = intval($larghezza_stanza * $scale);
$alt_piano_grande = intval($altezza_riga * 2);

// scegli subset piani in base alla pagina
// per ora solo 2 pagine
if (trim($paginazione) === "" || $page > 1) {
  $subset_piani_query = "";
} elseif ($page==0){
  $subset_piani_query = "AND piano < $paginazione";
} elseif ($page==1){
 $subset_piani_query = "AND piano >= $paginazione";
}

$query = "SELECT DISTINCT piano FROM percorsi 
          WHERE attivo IN ('S','s','X') 
          AND ascensori IN ('S', 's', 'X')
          AND percorso = '$percorso' 
          $subset_piani_query
          ORDER BY piano DESC";
$elenco_piani = db_query_list($query);


foreach($elenco_piani as $p) {
  $query = "SELECT reparto, edificio, stanza FROM percorsi 
          WHERE attivo IN ('S','s','X') 
          AND ascensori IN ('S', 's', 'X')
          AND percorso = '$percorso'
          AND piano = $p
          ORDER BY reparto";
  $destinazioni_per_piano[$p] = db_query_list($query);
}


// div e tabella che racchiude tutta la pagina

echo "<div style='margin: 0px; padding: 0px; height: {$altezza_display}px; background-color:#$colore_sfondo; width:{$larghezza_display}px; border:solid 1px; position: relative''>";
echo "<table style='table-layout:fixed; 
                    float:left; 
                    display:block; 
                    width:{$larghezza_display}px; 
                    margin:0; 
                    font-family:Montserrat;
                    font-size:{$dimensione_font}px;
                    background-color:#$colore_sfondo;
                    border-collapse: collapse;
                    position: absolute;
                    bottom: 7px;' >";


$i = 0;
foreach($destinazioni_per_piano as $piano => $destinazioni) {
  if ($piano == $uscita) {
    //$colore_piano = 'white';
    $sfondo_piano = '#{$colore_sfondo}';
  } else {
    //$colore_piano = 'black';
    $sfondo_piano = "#{$sfondo_riga_pari}";
  }

  echo "<tr style='background:{$sfondo_piano}; 
                   border-bottom: 7px solid #{$colore_sfondo};'>";
  
  echo "<td style='max-width:{$alt_piano_grande}px;
                   font-size:50px;
                   vertical-align: super;
                   padding: 0px;
                   text-align:center;'>";
  $alt_div_piano_grande = $alt_piano_grande - 14; //considera il margine 2px
  echo "<div style='text-align: center;
                    line-height:{$alt_div_piano_grande}px;
                    height:{$alt_div_piano_grande}px;
                    width:{$alt_div_piano_grande}px;
                    background-color:#{$sfondo_colonna_piano}; 
                    color:#{$colore_colonna_piano}; 
                    font-weight:bold; 
                    margin: 7px;'>";
  echo "$piano";
  echo "</div>";

  if ($piano == $uscita) {
    $dim_image = intval($alt_piano_grande * 0.8);
    if($negativo) $image_file = 'exit_pm.png'; else $image_file = 'exit.png';
    echo "<img style='margin-top: 7px; width:{$dim_image}px;' src='../img/{$image_file}'>";
  }
  echo "</td>";
  
  echo "<td style='padding:0px; vertical-align: top;'>";
  echo "<table style='border-collapse:collapse;'>";

  foreach($destinazioni as $destinazione) {
    list($reparto, $edificio, $stanza) = $destinazione;

    $sfondo = ($i % 2) ? $sfondo_riga_pari : $sfondo_riga_dispari;
    $stanze = explode(" ", trim($stanza));
    $prima_stanza = $stanze[0];

   echo "<tr style='height:{$altezza_riga}px; width:360px; background-color:#$sfondo; color:#$colore_riga' >";

    // reparto
   echo "<td style='text-align: left; width:{$larghezza_reparto}px; max-width:{$larghezza_reparto}px; padding: 0px 0px 0px 0.3em;'>
            $reparto
          </td>";

    // edificio
   echo "<td style='max-width:{$larghezza_edificio}px; '>
           <div style='text-align: center; margin: 1px;  width:{$larghezza_edificio}px; color:#$colore_colonna_edificio; background-color:#$sfondo_colonna_edificio; font-weight:bold; overflow: hidden;'>
              $edificio
           <div>
          </td>";

    // piano
   echo "<td style='max-width:{$larghezza_piano}px; '>
           <div style='text-align: center; margin: 1px;  width:{$larghezza_piano}px; color:#$colore_colonna_piano; background-color:#$sfondo_colonna_piano; font-weight:bold; overflow: hidden;'>
              $piano
           <div>
          </td>";

    // stanza
   echo "<td >
            <div style='text-align: right; margin: 1px; width:{$larghezza_stanza}px; color:#$colore_colonna_stanza; background-color:#$sfondo_colonna_stanza; padding: 0 0.2em 0 0; overflow: hidden;'>
              $prima_stanza
            </div>
          </td>";

   echo "</tr>";
   $i++;
  }
  echo "</table>";
  echo "</td>";
  echo "</tr>";
  
}

// riga finale, indica il piano
echo "<tr>"; 
echo "<td colspan='2'>";

echo "<div style='text-align: center;
                  line-height:{$alt_div_piano_grande}px;
                  height:{$alt_div_piano_grande}px;
                  width:{$alt_div_piano_grande}px;
                  background-color:#{$sfondo_colonna_piano}; 
                  color:#{$colore_colonna_piano}; 
                  font-weight:bold; 
                  margin: 7px;
                  font-size: 50px;
                  float: right;'
         >";
echo "$piano_corrente";
echo "</div>";

echo "<div style='color: #{$sfondo_riga_pari};
                  float: right;
                  height: {$alt_div_piano_grande}px;
                  line-height: {$alt_div_piano_grande}px;
                  margin: 7px;'>";
echo "vi trovate al piano";
echo "</div>";

echo "</td>";
echo "</tr>";

echo "</table>";
echo "</div>";
?>

<!-- Content End -->
</BODY>
</HTML>
