<?php

include_once('funzioni_touch.php');

function connetti_db(){
  global $CONF;
  $link = mysql_connect ($CONF['database_host'], 
                         $CONF['database_user'], 
						 $CONF['database_password']) 
						 or die ("<p />DEBUG INFORMATION:<br />Connect: " .  mysql_error () . "");
   
  mysql_select_db ($CONF['database_name'], $link) 
                   or die ("<p />DEBUG INFORMATION:<br />MySQL Select Database: " .  mysql_error () . "");
}

function elenco(){
  elencoAlfa();
}

function perfezionaRicerca($method, $lettera){   
  $perfeziona = 'WHERE';
  if ($method == 'alfa')
      $perfeziona .= " reparto_esteso like '".$lettera."%' ";

  if ($method == 'analitico')
      $perfeziona .= " reparto_esteso like '%".$lettera."%' ";	

return $perfeziona;
}

function ScegliReparto($method, $reparto) {
   if($method == '')
      $ScegliReparto = 'WHERE';
   else 
      $ScegliReparto = 'AND';

   $ScegliReparto .= " reparto = '$reparto' ";
   
return $ScegliReparto;
}


function formRicercaAnalitica($tipoForm) {

  $get_method = isset($_GET['method']) ? $_GET['method'] : "";
  $get_lettera = isset($_GET['lettera']) ? $_GET['lettera'] : "";
  $touchid = isset($_GET['touchid']) ? $_GET['touchid'] : "";
	
    if ($tipoForm == 'form') {
		echo "<form method='GET' action='unita.php' class='form' name='RicercaAnalitica' target='mio'>";
//		echo "<input type='hidden' name='method' value='$get_method'>";
		echo "<input type='hidden' name='method' value='analitico'>";
		echo "<input type='hidden' name='touchid' value='$touchid'>";
		echo "<input type='text' style='outline:none;' name='lettera' id='lettera' class='search' value='$get_lettera'>";
		echo "</form>";
		}

   if ($tipoForm == 'NULL') {
		echo "<form method='GET' action='/index.php' class='form'>";
        echo "<input type='hidden' name='method' value='$get_method'>";
        echo "<input type='text' name='lettera' class='search' value=''>";
        echo "</form>";
		}
		
    if ($tipoForm == 'ricomincia') {
		echo "<a href='/index.php?method=analitico&lettera'>Ricomincia</a>";
		}
	}
/* funzioni Elenco alfabetico */

function elencoAlfa(){

  prelevapercorso();
  prelevaFabbricato();

  // HACK TODO TOFIX gg 2014-12-16
  // rimosso preleva reparto perche' non vuole dire piu niente
  // capire se e' ancora in uso

  // prelevaReparto();

  global $PERCORSO;
  global $FABBRICATO;
  global $REPARTO;
  global $CONF;

  /* $class = 'class=bottone250x74'; */

  if (isset($_GET['lettera']))
    $perfeziona = perfezionaRicerca($_GET['method'], $_GET['lettera']);
  else $perfeziona = '';
        
  if (isset($_GET['reparto']))
    $ScegliReparto = ScegliReparto($_GET['lettera'], $_GET['reparto']);
  else $ScegliReparto = '';

  if(isset($_GET['reparto']))
    $reparto = '&reparto='.$_GET['reparto'].'';
  else $reparto = '';
       
  if(isset($_GET['lettera']))
    $reparto = '&lettera='.$_GET['lettera'].'';
  else $lettera = '';

  if(isset($_GET['touchid']))
    $touchid = '&touchid='.$_GET['touchid'];
  else $touchid = '';
                
  if (!isset($_GET['limitMIN']) && !isset($_GET['limitMAX'])) {
    if(empty($perfeziona) && empty($ScegliReparto)) {
      $ontouch = "WHERE attivo='s' AND touch='s'";
    } else {
      $ontouch = "AND attivo='s' AND touch='s'";
    }
    $query = "select * from percorsi $perfeziona $ScegliReparto $ontouch";
    $result = mysql_query($query);
    $numero_righe = mysql_num_rows($result);      
     
    $query = "select * from percorsi $perfeziona $ScegliReparto $ontouch ORDER BY `reparto` ASC ";
    $result = mysql_query($query);       
    $linkDirettoNext = ''; 
    $classN = '';       
    //         }       
  }
  else{    
    if(empty($perfeziona) && empty($ScegliReparto)) {
      $ontouch = "WHERE attivo='s' AND touch='s'";
    } else {
      $ontouch = "AND attivo='s' AND touch='s'";
    }
    $query = "select * from percorsi  $perfeziona $ScegliReparto $ontouch ORDER BY `reparto` ASC LIMIT ".$_GET['limitMIN'].",".$_GET['limitMAX']."";
    $result = mysql_query($query);
    $numero_righe = mysql_num_rows($result);
    $prev_limitMIN = $_GET['limitMIN'] - 18;
             
    if ($_GET['limitMIN'] != '0'){
      $linkDirettoPrev = 'onclick="location.href = \'/unita.php?method='.$_GET['method'].$reparto.$lettera.$touchid.'&limitMIN='.                $prev_limitMIN.'&limitMAX=18\'"';
      $classP = 'class=bottone610x66';
    }
        
    if (($numero_righe != 0) && ($numero_righe < 18)){                    
      $linkDirettoNext = ''; 
      $class = '';
    }
    else 
      if ($numero_righe  == 18){
	$next_limitMIN = $_GET['limitMIN'] + 18;
	$linkDirettoNext = 'onclick="location.href=\'/unita.php?method='.$_GET['method'].$reparto.$lettera.$touchid.'&limitMIN='.                 $next_limitMIN.'&limitMAX=18\'"';
	$classN = 'class=bottone610x66';
      }           
  }
    
  if (!isset($classP) || $classP == '')
    $TastoPrecedente = '';
  else           
    $TastoPrecedente = ' <INPUT TYPE="button" value="'.$CONF[PaginaPrecedente].'"  '.$classP.' '.$linkDirettoPrev.'  >';
          
  if ($classN == '')          
    $TastoSuccessivo = '';
  else
    $TastoSuccessivo = '<INPUT TYPE="button" value="'.$CONF[PaginaSuccessiva].'"  '.$classN.' '.$linkDirettoNext.'  >';    

  $a = 1;
  $b = 1;
  echo '<div id="elencoreparti"><table valign="top" width="550" cellspacing=0 id="unita-tabella" >';

  while ($riga = mysql_fetch_assoc($result))
    {       
	  $p = $riga['piano'];
      $x = $riga['id_mappa'];
      $y = $riga['edificio'];
      $z = $riga['stanza'];
       
      $TempId = $riga['id'];
      $TempUnita = $riga['reparto'];

      $query_identico = " SELECT * FROM reparto WHERE reparto = '$TempUnita' AND id != '$TempId' ORDER BY id ASC LIMIT 0,1";  
          
      $repartoAttuale2 = '';
      if ($preleva_identico = mysql_query($query_identico))
	{     
	  if (mysql_num_rows($preleva_identico) > 0)
	    $repartoAttuale2 = ' - <b>'.$REPARTO['reparto'.$z.''].'</b>';
	}
       
      $linkDiretto = "onclick=\"parent.ResetScreenSaverTimeout();location.href = 'unita.php?stampa&unita=".$riga['id'].$touchid."'\""; /* link per stampa a video - ?stampa - l'unita prelevata dalla query e selezionata */ 

      //         if (($a %2)==0) 
      //            {
      $apriRiga = "<tr>"; /* non inizia la riga ma */
      $chiudiRiga = '</tr>';
      //            }
      //         else 
      //           { 
      //             $b++;
             
      //             $apriRiga = "<tr bgcolor=#ffffff width=100% >";
      //             $chiudiRiga = ' ';
      //         }
     
/*      echo "".$apriRiga."
             <td ".$linkDiretto." width=550><div id=controlloOverflow><img src=\"".$PERCORSO['bullet'.$x.'']."\"  width=50 align=left>".$riga['reparto']." ".$repartoAttuale2."</div></td>
            ".$chiudiRiga."";   
*/
			echo "".$apriRiga."
             <td ".$linkDiretto." width=850><div id=controlloOverflow>".$riga['reparto']." ".$repartoAttuale2."</div><div id=div_edificio>".$y."</div><div id=div_piano>".$p."</div><div id=div_stanza>".$z."</td>
            ".$chiudiRiga."";   
      //       $a++;
    }

  if (($a %2)==0) 
    {
      echo "</tr></table>";
    }
  else echo "<div style='clear:both;'></div> </table></div>";

}




function stampa($id_percorso) {

  if(isset($_GET['touchid']))
    $touchid = '&touchid='.$_GET['touchid'];
  else $touchid = '';

  $pulsanteStampa = '<div id=pulsanteStampa2 align=center>';
  $pulsanteStampa .= '<INPUT TYPE="button" VALUE="Stampa questo percorso" onClick="parent.ResetScreenSaverTimeout(); location.href=\'/unita.php?stampaPOST'.$touchid.'&unita=';
  $pulsanteStampa .= $id_percorso;
  $pulsanteStampa .= '\'" class=bottone480x74 >';
  $pulsanteStampa .= '</div>';

  $q = "SELECT reparto, edificio, piano, stanza, categoria, orario, orario2, telefono
         FROM percorsi
         WHERE id = $id_percorso";
  list($reparto, $edificio, $piano, $stanza, $categoria, $orario, $orario2, $telefono)=mysql_fetch_row(mysql_query($q));
  echo "<div id=unita align=left>
        <h2>$reparto</h2>";

  $riq_style = "margin: auto; font-size: 50px; min-height: 90px; text-align:center; line-height: 90px;";
  $edi_style = $riq_style . "width: 90px; font-weight: bold; background: #21205f; color: white;";
  $pia_style = $riq_style . "width: 90px; font-weight: bold; background: #a3cff0; color: black;";
  $sta_style = $riq_style . "width: 180px; background: #d2e6f8; color: black;";

  // tabella indicazioni
  echo "<table style='margin-bottom: 70px;'>";
  echo "  <tr>";
  echo "    <td class='tdcenter'><h4>Fabbricato</h4></td><td class='tdcenter'><h4>Piano</h4></td><td class='tdcenter'><h4>Stanza</h4></td>";
  echo "  </tr>";
  echo "  <tr>";
  echo "    <td class='tdcenter'>";
  echo "      <div style='$edi_style'>$edificio</div>";
  echo "    </td>";
  echo "    <td class='tdcenter'>";
  echo "      <div style='$pia_style'>$piano</div>";
  echo "    </td>";
  echo "    <td class='tdcenter'>";
  echo "      <div style='$sta_style'>$stanza</div>";
  echo "    </td>";
  echo "  </tr>";
  echo "</table>";

  // tabella stesse indicazioni con istruzioni
  echo "<table>";
  echo "  <tr>";
  echo "    <td class='tdleft'>";
  echo "      <h3>Seguire le indicazioni per l'edificio</h3>";
  echo "    </td>";
  echo "    <td class='tdleft'>";
  echo "      <div style='$edi_style; display: inline-block;'>$edificio</div>";
  echo "    </td>";
  echo "  </tr>";

  echo "  <tr>";
  echo "    <td class='tdleft'>";
  echo "      <h3>Raggiungere il piano</h3>";
  echo "    </td>";
  echo "    <td class='tdleft'>";
  echo "      <div style='$pia_style; display: inline-block;'>$piano</div>";
  echo "    </td>";
  echo "  </tr>";


  echo "  <tr>";
  echo "    <td class='tdleft'>";
  echo "      <h3>Seguire le indicazioni sino alla stanza</h3>";
  echo "    </td>";
  echo "    <td class='tdleft'>";
  echo "      <div style='$sta_style; display: inline-block;'>$stanza</div>";
  echo "    </td>";
  echo "  </tr>";

  echo "</table>";


  // tabella telefono e orario
  echo "<table class='tab-telefono' style='margin-top:50px'>";
  echo "  <tr>";
  if ($telefono) {
    echo "<td><h4 style='font-weight:bold;'>Telefono:</h4></td>";
  }
  if ($orario) {
    echo "<td colspan='2'><h4 style='font-weight:bold;'>Orario di apertura:</h4></td>";
  }
  echo "  </tr>";  

  echo "  <tr>";
  if ($telefono) {
    echo "<td style='vertical-align: top;'><pre style='padding: 10px; font:25px Montserrat;'>$telefono</pre></td>";
  }
  if ($orario) {
    echo "<td style='vertical-align: top;'><pre style='padding: 10px; font:25px Montserrat;'>";
    echo $orario;
    echo "</pre></td>";
    echo "<td style='vertical-align: top;'><pre style='padding: 10px; font:25px Montserrat;'>";
    echo $orario2;
    echo "</pre></td>";
  }
  echo "  </tr>";
  echo "</table>";


  echo "</div>"; //unita

  echo $pulsanteStampa;
}











// stampa_con_mappa() est la vecchia versione di stampa()
// sostiuita 2015-02-24
function stampa_con_mappa($idUnita)
{
	
	
global $CONF;
prelevapercorso();
prelevaFabbricato();
prelevaReparto();
global $PERCORSO;
global $FABBRICATO;
global $REPARTO;
  $query = "select * from percorsi where id= ".$idUnita." ";
        $result = mysql_query($query);
         $a = 1;

       while ($riga = mysql_fetch_assoc($result))
       {       
	       $x = $riga['id_mappa'];
	       $y = $riga['edificio'];
	       $z = $riga['categoria'];
	    

               $unita = $riga['reparto'];               
               $fabbricato = $y; // $FABBRICATO['fabbricato'.$y.''];
               $piano = $riga['piano'];
	       // HACK TOFIX TODO gg 2014-12-16
               // $descrizione = $riga['descrizione'];
	       $descrizione = $riga['percorso'];
               


        $a++;

       }

  


   $NuovofilePS =  ''.LeggiContenutoFile(''.$CONF['Dir_installazione'].'/images/mappe/ps/testata_template.ps').'';
   $PStoGIF = $NuovofilePS;

   $ContenutoTestoPS = '
/Arial-Bold findfont
12 scalefont setfont
30 210 moveto
(Data della stampa:) show
/Arial findfont
12 scalefont setfont
(: '.$CONF['Giorno'].' '.$CONF['Mese'].' '.$CONF['Anno'].' - '.$CONF['Ora'].':'.$CONF['Minuti'].' ) show

/Arial-Bold findfont
12 scalefont setfont
30 190 moveto
(Unita operativa) show
/Arial findfont
10 scalefont setfont
(: '.$unita.') show

/Arial-Bold findfont
12 scalefont setfont
30 170 moveto
(Colore del percorso) show
/Arial findfont
10 scalefont setfont
(: '.$PERCORSO['descrizione'.$x.''].') show

/Arial-Bold findfont
12 scalefont setfont
30 150 moveto
(Fabbricato) show
/Arial findfont
10 scalefont setfont
(: '.$fabbricato.') show

/Arial-Bold findfont
12 scalefont setfont
30 130 moveto
(Piano:) show
/Arial findfont
10 scalefont setfont
(: '.$piano.') show

/Arial-Bold findfont
12 scalefont setfont
30 110 moveto
(Reparto di appartenenza) show
/Arial findfont
10 scalefont setfont
(: '.$z.') show

/Arial-Bold findfont
12 scalefont setfont
30 90 moveto
(Istruzioni:) show
/Arial findfont
10 scalefont setfont
(: Seguire il "'.$PERCORSO['descrizione'.$x.''].'" raggiungere il piano '.$piano.' e seguire le indicazioni al piano) show

/Arial-bold findfont
12 scalefont setfont
30 70 moveto
(Descrizione dell\'unita\': ) show
/Arial findfont
12 scalefont setfont
30 55 moveto
('.$descrizione.' ) show
';
    $filedascrivere = ''.$CONF['Dir_installazione'].'/images/mappe/ps/testo.ps';
   ScriviFile($filedascrivere, $ContenutoTestoPS);
   
   $NuovofilePS .=  ''.LeggiContenutoFile(''.$CONF['Dir_installazione'].'/images/mappe/ps/testo.ps').'';      


   $NuovofilePS .= beginEPSF(30, 220);
   $NuovofilePS .=  ''.LeggiContenutoFile(''.$CONF['Dir_installazione'].''.$PERCORSO['base'.$x.''].'').'';
   $NuovofilePS .=  ''.LeggiContenutoFile(''.$CONF['Dir_installazione'].''.$PERCORSO['img1'.$x.''].'').'';
   $NuovofilePS .=  ''.LeggiContenutoFile(''.$CONF['Dir_installazione'].''.$PERCORSO['img2'.$x.''].'').'';
   $NuovofilePS .=  ''.LeggiContenutoFile(''.$CONF['Dir_installazione'].''.$PERCORSO['img3'.$x.''].'').'';
   $NuovofilePS .=  ''.LeggiContenutoFile(''.$CONF['Dir_installazione'].''.$PERCORSO['img4'.$x.''].'').'';
   $NuovofilePS .= endEPSF();
   
   $PStoGIF .= $NuovofilePS; 
 
   
     
//   $NuovofilePS .=  ''.LeggiContenutoFile(''.$CONF['Dir_installazione'].'/images/mappe/ps/footer_template.ps').'';
//   $PStoGIF .=  ''.LeggiContenutoFile(''.$CONF['Dir_installazione'].'/images/mappe/ps/footer_template.ps').'';
   $NuovofilePS .=  ''.LeggiContenutoFile(''.$CONF['Dir_installazione'].'/images/mappe/ps/footer_template.ps').'';
   $PStoGIF .=  ''.LeggiContenutoFile(''.$CONF['Dir_installazione'].'/images/mappe/ps/footer_template.ps').'';


   $filedascrivere = ''.$CONF['Dir_installazione'].''.$PERCORSO['piantaFinale'.$x.''].'';
   ScriviFile($filedascrivere, $NuovofilePS);
   
   if ($CONF['TypeApplication'] == 'WEB')
   {
     system("ps2pdf ".$filedascrivere."", $retval);
    //echo $retval;
     $pulsanteStampa = '
   <div id="pulsanteStampa2" align=center><INPUT TYPE="button" VALUE="Stampa questo percorso" onClick="location.href=\'/unita.php?stampaPOST&pdf&unita='.$idUnita.'\'" class=bottone480x74 ></div>
';
//<div  id=pulsanteStampa align=center><a href=\"/unita.php?stampaPOST&pdf&unita=".$idUnita."\" target=mio>Stampa questo percorso</a></div>
   }
   else 
   $pulsanteStampa = '
   <div id=pulsanteStampa2 align=center><INPUT TYPE="button" VALUE="Stampa questo percorso" onClick="location.href=\'/unita.php?stampaPOST&unita='.$idUnita.'\'" class=bottone480x74 ></div>
   
';
//<div  id=pulsanteStampa align=center><a href=\"/unita.php?stampaPOST&unita=".$idUnita."\">Stampa questo percorso</a></div>

   $filedascrivere = ''.$CONF['Dir_installazione'].''.$PERCORSO['imgPS'.$x.''].'';
   ScriviFile($filedascrivere, $PStoGIF);
   
   $dir= dirname(''.$CONF['Dir_installazione'].''.$PERCORSO['piantaFinale'.$x.''].'');


if ($descrizione != '') 
$StampaDescrizione = " 
    <h3>Dettagli sul reparto
    <span>$descrizione</span></h3>
 
      ";
else $StampaDescrizione = '';


echo "
   <div id=mappa>
   ";
   directory_tree4gif($dir);
   //<img src=\"".$PERCORSO['bullet'.$x.'']."\" align=top> 
     echo "</div>
   <div id=unita align=left>
   <h3>Unita operativa:   <span>".$unita."</span></h3>
   <h3>Percorso:&nbsp;&nbsp;<span>[".$PERCORSO['descrizione'.$x.'']."]</span> </h3>
   <h3>Fabbricato:   <span><b>".$fabbricato."</b></span></h3>
   <h3>Piano: <span><b>".$piano."</b></span></h3>
   <h3>Reparto di appartenenza: <span>".$z."</span></h3>
   <h3>Istruzioni: <span>seguire il <b>".$PERCORSO['descrizione'.$x.'']."</b>, raggiungere il piano <b>".$piano."</b> e seguire le indicazioni al piano</span></h3>
     ".$StampaDescrizione."      
</div>";

echo ''.$pulsanteStampa.'';

}






function mappa()
{
global $CONF;

   $dir= dirname(''.$CONF['IMG_mappaGenerale'].'');

echo "
<div style=\"position:relative\">
   <div id=mappa>
   ";
   directory_tree4gif($dir);
   
   echo '</div>
   <div id=unitaMappa align=justify>
   <div id=IstruzioniMenuGenerale>Tasti per la scelta del reparto</div>
   
 <div id=IstruzioniVoiSieteQui>Voi vi trovate qui</div>   
 <div id=IstruzioniTastiera>Scrivere con la tastiera l\'unit&agrave da ricercare</div>  

';
   
/*echo '</div>
   <div id=unitaMappa align=justify>
   <div id=IstruzioniMenuGenerale>Scelta del reparto</div>
 <h2>Voi siete qui: <img src="/images/grafica/qui.gif" align=absmiddle></h2>  
<H3>Menu superiore</H3>
Attraverso il menu superiore &egrave; possibile ricercare tutte le unit&agrave presenti in un determinato reparto.<br>
Le unit&agrave attive saranno visualizzate al centro della pagina.<br>
Il pulsante <b>[ MAPPA GENERALE ]</b> visualizza questa pagina.
<H3>Mappa della struttura</H3>
Nella parte destra dello schermo &egrave; visualizzata la mappa della struttura e la legenda necessaria alla sua interpretazione.<br>
Il percorso da seguire viene inserito dopo aver selezionato un\'unit&agrave; specifica.
<H3>Ricerca unita</H3>
E\' possibile ricercare un\'unit&agrave nei seguenti modi:
<ul>
  <li>Utilizzare il pulsante <b>[ Tutti i reparti ]</b>;</li>
  <li>Scegliere uno dei reparti presenti nel <b>Menu superiore </b>;</li>
  <li>Effettuare una ricerca attraverso la tastiera presente in fondo allo schermo.</li>
</ul> 
Se la ricerca ottiene come risultato pi&ugrave; di 20 unit&agrave; &egrave; possibile; scorrere tra i risultati attraverso i pulsanti <b>[precedente ]</b> e <b>[successivo]</b> 
<H3>Tastiera per ricerca analitica</H3>
Utilizzare la tastiera per effettuare la ricerca di una unit&agrave; specifica.<br>
Tutte le unit&agrave; che contengono la parola ricercata tramite tastiera verranno inserite al centro dello schermo.<br>
ES: Se ricercate "<b>GIA</b>" otterrete le unit&agrave <b>"ALLERGOLOGIA"</b>, <b>"DIABETOLOGIA"</b>, <b>"CHIRURGIA GENERALE"</b>, <b>"CHIRURGIA PEDIATRICA"</b> etc....<br>
Il pulsante <b>[ Azzera ]</b> consente di iniziare una nuova ricerca.
';*/
echo '</div></div>';




}

//This is the function which is doing the search...
function directory_tree4gif($address)
{
global $CONF;
   @$dir = opendir($address);


   $x=0;
   
   if(!$dir){ return 0; }
    
   while($entry = readdir($dir))
       { 
	       

        if(is_dir("$address/$entry") && ($entry != ".." && $entry != "."))
	  {                           
          //directory_tree4("$address/$entry");
          }
         else
	   {            
            if($entry != ".." && $entry != ".") 
	      {
               $x++;
	       $onlyfile = "$entry" ;
               $fulldir = "$address"."/"."$entry" ;	   
               $estensione = explode (".", $onlyfile);
               $percorso = explode ($CONF['Dir_installazione'], $address);

if($estensione[1]== 'gif')
echo '<img src="'.$percorso[1].'/'.$onlyfile.'">';
	        // echo 'fulldir = '.$fulldir.' <br> onlyfile ='.$onlyfile.' estensione = '.$estensione[1].'<br>';

             }
           }
        }

}

function stampaPS($idUnita)
{

  ContaStampe();

  prelevapercorso();
  global $PERCORSO;
  global $CONF;

  $dir= dirname(''.$CONF['Dir_installazione'].''.$PERCORSO['piantaFinale'.$x.''].'');

  $query = "select * from unita where id= ".$idUnita." ";
  $result = mysql_query($query);
  $riga = mysql_fetch_assoc($result);
  $x = $riga['idPercorso'];
  $dir= dirname(''.$CONF['Dir_installazione'].''.$PERCORSO['piantaFinale'.$x.''].'');
  //echo "<br><br>IL FILE DA STAMPARE E'   ".$CONF['Dir_installazione']."".$PERCORSO['piantaFinale'.$x.'']."<br><br>";
  echo "<div style=\"position:relative\">";
  if (exec('lp '.$CONF['Dir_installazione'].''.$PERCORSO['piantaFinale'.$x.''].''))
    {
      echo '
      <div id="unita" ALIGN=JUSTIFY>
      <h3>ISTRUZIONI AL VISITATORE</h3>
      <ul>
        <li>Attendere che il percorso sia stampato</li>
        <li>Prelevare il percorso stampato nel vassoio posto dietro il monitor</li>
        <li>Verificare che il percorso stampato corrisponda a quello richiesto</li>
        <li>Seguire le indicazioni presenti nello stampato</li>
        <li>Per maggiori informazioni il nostro <b>Ufficio Relazioni con il Pubblico</b>, che si trova all\'ingresso principale posto al 4 piano, &egrave a vostra disposizione</li>
      </ul>
      <h1>Grazie per aver scelto la nostra struttura!</h1>
      </div>
      
      <div id=mappa>';
      directory_tree4gif($dir);
      echo '</div>';
    }
  else 
    {
      echo '
      <div id="unita" ALIGN=JUSTIFY>
      <h3>Carta Terminata</h3>
      <ul>
        <li>Per maggiori informazioni il nostro <b>Ufficio Relazioni con il Pubblico</b>, che si trova all\'ingresso principale posto al 4 piano, &egrave a vostra disposizione</li>
      </ul>
      <h1>Grazie per aver scelto la nostra struttura!</h1>';
      if ($CONF['TypeApplication'] == 'WEB')
	echo '<div id=pulsanteStampa2 align=center><INPUT TYPE="button" VALUE="Visualizza file PDF - Versione per la stampa" onClick="location.href=\'/stampa.pdf\'" class=bottone480x74 ></div>';
      echo'      </div>
      
      <div id=mappa>';
      directory_tree4gif($dir);
      echo '</div></div>';
    }
}
    
function stampaPOST($id_percorso) {
  global $PERCORSO, $CONF;


  $ip = $_SERVER['REMOTE_ADDR'];
  if(isset($_GET['touchid'])) {
    $touchid = $_GET['touchid'];
  } else {
    $touchid = NULL;
  }
  if (stato_carta_from_touch_ip($ip, $touchid)) {
    print_ticket($ip, $id_percorso);
    echo '
      <div id="unita" ALIGN=JUSTIFY>
      <h3>ISTRUZIONI AL VISITATORE</h3>
      <ul>
        <li>Attendere che il percorso sia stampato</li>
        <li>Prelevare il percorso stampato nel vassoio posto dietro il monitor</li>
        <li>Verificare che il percorso stampato corrisponda a quello richiesto</li>
        <li>Seguire le indicazioni presenti nello stampato</li>
        <li>Per maggiori informazioni il nostro <b>Ufficio Relazioni con il Pubblico</b>, che si trova all\'ingresso principale posto al 4 piano, &egrave a vostra disposizione</li>
      </ul>
      <h1>Grazie per aver scelto la nostra struttura!</h1>
      </div>';
  } else {
    echo '
      <div id="unita" ALIGN=JUSTIFY>
      <h3><br><br><br>ATTENZIONE</h3>
      <br>
      <p ><h4 style="color:red;">La stampa del percorso non &egrave; momentaneamente disponibile</h4></p>
      <p> <h4>Per maggiori informazioni, il nostro <b>Ufficio Relazioni con il Pubblico</b>, che si trova all\'ingresso principale posto al 4 piano, &egrave a vostra disposizione</h4></p>
     <h4>Grazie per aver scelto la nostra struttura!</h4>
      </div>';
  }
}



function alfabeto()
{
if(isset($_GET['reparto']))
  $reparto = '&reparto='.$_GET['reparto'].'';
else $reparto = '';

$method = 'analitico';
$kbdl1 = "QWERTYUIOP";
$kbdl2 = "ASDFGHJKL";
$kbdl3 = "ZXCVBNM.";
 
echo '<div  id="alfabeto" align=center>';
        
echo '<table><tr>';
for ($x = 0; $x<strlen($kbdl1); $x++){
  $char=substr($kbdl1,$x,1); $ochar=ord($char);
  echo "<td style='width:90px; height:90px;' ><INPUT TYPE='button' VALUE='$char' onClick='stopper(); agg(this.value)' class='bottone' id='$char'></td>";
  }
echo "<td style='width:90px; height:90px;' ><INPUT TYPE='button' VALUE='&larr;' onClick='stopper(); Correzione()' class='bottone' id='backspace'></td>";
echo "</tr></table>";	
 
echo "<table><tr>";	
for ($x = 0; $x<strlen($kbdl2); $x++){
  $char=substr($kbdl2,$x,1); $ochar=ord($char);
  echo "<td style='width:90px; height:90px;' ><INPUT TYPE='button' VALUE='$char' onClick='stopper(); agg(this.value)' class='bottone' id='b$ochar'></td>";
  }
echo "</tr></table>";	
  
echo "<table><tr>";	
for ($x = 0; $x<strlen($kbdl3); $x++){
  $char=substr($kbdl3,$x,1); $ochar=ord($char);
  echo "<td style='width:90px; height:90px;' ><INPUT TYPE='button' Value='$char' onClick='stopper(); agg(this.value)' class='bottone' id='b$ochar)'></td>";
  }
echo "</tr></table>";	
  
echo "<table><tr>";	
echo "<td colspan=2 style='width:250px; height:90px;'><INPUT TYPE='button' VALUE='Spazio' onClick='stopper(); agg(this.value)' class='bottone250x74'></td>"; 
echo "</tr></table>";         
echo "</div>";         
}

function prelevapercorso()
{
  global $PERCORSO;
  $query = "select * from mappe";
  $result = mysql_query($query);
  $x = 1;
  while ($riga = mysql_fetch_assoc($result))
       {
           $PERCORSO['id'.$x.''] = $riga['id']; 
           $PERCORSO['bullet'.$x.''] = $riga['bullet']; 
           $PERCORSO['descrizione'.$x.''] = $riga['descrizione']; 
           $PERCORSO['note'.$x.''] = $riga['note']; 
           $PERCORSO['base'.$x.''] = $riga['base']; 
           $PERCORSO['img1'.$x.''] = $riga['img1']; 
           $PERCORSO['img2'.$x.''] = $riga['img2']; 
           $PERCORSO['img3'.$x.''] = $riga['img3']; 
           $PERCORSO['img4'.$x.''] = $riga['img4']; 
           $PERCORSO['piantaFinale'.$x.''] = $riga['piantaFinale']; 
           $PERCORSO['imgPS'.$x.''] = $riga['imgPS']; 
           $PERCORSO['imgWEB'.$x.''] = $riga['imgWEB']; 
           //echo "id = ".$PERCORSO['id'.$x.'']." - fabbricato = ".$PERCORSO['fabbricato'.$x.'']." - bullet = ".$PERCORSO['bullet'.$x.'']." <br>";
             $x++;
       }
  return  $PERCORSO;      
}

function prelevaFabbricato()
{
  global $FABBRICATO;
  $query = "select distinct edificio as idFabbricato, edificio as fabbricato from percorsi";
  $result = mysql_query($query);
  $x = 1;
  while ($riga = mysql_fetch_assoc($result))
       {
           $FABBRICATO['id'.$x.''] = $riga['idFabbricato']; 
           if ($riga['fabbricato'] =='D1' )
             $FABBRICATO['fabbricato'.$x.''] = 'D';
           else if ($riga['fabbricato'] =='D2' )
             $FABBRICATO['fabbricato'.$x.''] = 'D';
           else 
             $FABBRICATO['fabbricato'.$x.''] = $riga['fabbricato'];         
             $x++;
       }
  return  $FABBRICATO;      
}

function prelevaReparto()
{
  global $REPARTO;
  $query = "select distinct categoria as idReparto, categoria as reparto from percorsi";
  $result = mysql_query($query);

  $x = 1;
  while ($riga = mysql_fetch_assoc($result))
       {
           $REPARTO['id'.$x.''] = $riga['idReparto']; 
           $REPARTO['reparto'.$x.''] = $riga['reparto']; 
           $x++;
       }
  return  $REPARTO;      
}


/*
fine
funzioni Elenco alfabetico
*/

function elencoAnalitico()
{
elencoAlfa();
}



function LeggiContenutoFile($PercorsoFile)
{
$LetturaFile = '';
if (file_exists($PercorsoFile))
   {
     if ($handle = fopen("".$PercorsoFile."", "r"))
        while (!feof($handle)) 
                {
                  $buffer = fgets($handle, 4096);
                  $LetturaFile .= $buffer;
                }
        fclose($handle);
        return $LetturaFile;
   }
}

function ScriviFile($PercorsoFile, $TestoDaScrivere)
{
if ($handle = fopen("".$PercorsoFile."", "w"))
$put = fputs($handle, $TestoDaScrivere);
fclose($handle);
}



function elencoReparti()
{
elencoAlfa();
}

function beginEPSF($valoreX, $valoreY)
   {
      $istruzione = 'BeginEPSF
';
      $istruzione .= '%%BeginDocument: MyEPSFile';
      $istruzione  .= '
'.$valoreX.' '.$valoreY.' translate
';
      return $istruzione;
   }

function endEPSF()
   {
      $istruzione = '%%EndDocument
';
      $istruzione .= 'EndEPSF
';
      return $istruzione;
   }

function ContaStampe()
{
$file = $_SERVER['DOCUMENT_ROOT'] . '/contatore.txt';
$visite = file($file);
$visite[0]++;
$fp = fopen($file , "w");
fputs($fp , "$visite[0]");
fclose($fp);
}


function PulsanteAttivo()
{

if (!isset($_GET['reparto']))
   {
      if (isset($_GET['stampaPS']))
          $PulsanteAttivo ='';
      else if (isset($_GET['stampa']))
           $PulsanteAttivo ='';

      else
           $PulsanteAttivo = 'class=aLink';
   }
else $PulsanteAttivo ='';



return $PulsanteAttivo;
}



function PulsanteAttivoReparto($reparto)
{
   if (isset($_GET['reparto']))
   {
      if ($_GET['reparto'] == $reparto)
         $PulsanteAttivo = 'class=aLink';
         else $PulsanteAttivo = '';
   }


return $PulsanteAttivo;
}

function PulsantiReparto()
{
 $query = "select * from reparto";
 $result = mysql_query($query);

  $x = 1;
  while ($riga = mysql_fetch_assoc($result))
       {
           $REPARTO['id'.$x.''] = $riga['idReparto']; 
           $REPARTO['reparto'.$x.''] = $riga['reparto']; 
           
          /* if ($_GET['reparto'] == $riga['idReparto'])
              $PulsanteAttivo = 'id=aLink';
              else $PulsanteAttivo ='';*/
             
           echo '<td><INPUT TYPE="button" value="'.$riga['reparto'].'"  
           onclick="location.href=
           \'/index.php?method=analitico&reparto='.$riga['idReparto'].'\'" class=bottone180x74></td>
           
           ';
           $x++;
       }
} 





?>