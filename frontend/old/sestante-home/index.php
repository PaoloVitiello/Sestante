<?php 
$path = $_SERVER['DOCUMENT_ROOT'];
include "$path/inc/config.inc";

connetti_db();
global $CONF;

  if ($CONF['TypeApplication'] == 'WEB'){
//      if (!isset($_GET[method]))
//          header('Refresh: 0; URL=/help.php');
    }

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head profile="http://gmpg.org/xfn/11">
<title><?php echo $CONF['TitleApplication']?></title>
<style> * {cursor: url('/images/point.gif'), default;} </style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<?php

if (eregi("MSIE",$_SERVER['HTTP_USER_AGENT']))
    echo '<link rel="Stylesheet" href="/css/ie.css" type="text/css" media="screen" />';
else
    echo '<link rel="Stylesheet" href="/css/style.css" type="text/css" media="screen" />';
	
?>  

<meta HTTP-EQUIV="Window-Target" content="top">
<script type="text/javascript">
var aa ="";

var TempoSS = <?php list($tempoSS) = mysql_fetch_row(mysql_query("SELECT Valore from sistema WHERE Parametro='TimeoutTouchScreen'")); echo $tempoSS."000"; ?>; 
var ScreenSaverTimer;


function colorizePulsanti(pulsanteId){
  for (i=0; i<=4; i++){
      if (i == pulsanteId){
	     document.getElementById(i).style.backgroundColor="#CCC";
	    }
      else{
	   document.getElementById(i).style.backgroundColor="#FFF";
	  }
    }
}

function stopper(){
  //clearTimeout(varmia);
  //clearTimeout(Azzera);
}

function agg(bb){
  if (bb=="Spazio")
      aa += " ";
  else 
     aa += bb;

  if (aa == "IDDQD") {
    location.reload(true);
  }
	 
  document.RicercaAnalitica.lettera.value=aa;    
  document.RicercaAnalitica.submit();
  //Azzera = setTimeout('azzera()',AzzeraForm);  
  document.RicercaAnalitica.lettera.focus();

  ResetScreenSaverTimeout();
}

function azzeraOnly(){
  aa = '';
  document.RicercaAnalitica.lettera.value=aa;
}

function azzera(){
  aa = '';
  document.RicercaAnalitica.lettera.value=aa;
  document.RicercaAnalitica.submit();
  document.RicercaAnalitica.lettera.focus();

  ResetScreenSaverTimeout();
}

function Correzione(){
  aa ='';
  var LunghezzaStringa = document.RicercaAnalitica.lettera.value.length;
  var Stringa = document.RicercaAnalitica.lettera.value;
  var NuovaStringa = Stringa.slice(0, LunghezzaStringa-1);
  document.RicercaAnalitica.lettera.value=aa;
  aa=NuovaStringa;
  document.RicercaAnalitica.lettera.value = aa;
  document.RicercaAnalitica.lettera.focus();
  document.RicercaAnalitica.submit();

  ResetScreenSaverTimeout();
}

function HideScreenSaver() {
  document.getElementById('contenuto').style.display = 'block';
  document.getElementById('screensaver').style.display = 'none';
  StartScreenSaverTimeout();
  azzera();
}

function ShowScreenSaver() {
  document.getElementById('contenuto').style.display = 'none';
  document.getElementById('screensaver').style.display = 'block';
  StopScreenSaverTimeout();
}

function StartScreenSaverTimeout() {
  ScreenSaverTimer = setTimeout('ShowScreenSaver()',TempoSS);  
}

function StopScreenSaverTimeout() {
  clearTimeout(ScreenSaverTimer);
}

function ResetScreenSaverTimeout() {
  StopScreenSaverTimeout();
  StartScreenSaverTimeout();
}


StartScreenSaverTimeout();

</script>

</head>
<body>
  <div id="contenuto">
    <div id="main2">
      <img style='width:1050px;' src='/images/gemelli_ucsc.png'>
      <div class="entry"> 
        <div align=center>
          <iframe src="/unita.php?method=analitico  <?php if (isset($_GET['reparto'])) echo '&reparto='.$_GET['reparto'].'';  if (isset($_GET['mappa']))  echo '&mappa' ;if (isset($_GET['touchid']))  echo '&touchid='.$_GET['touchid'] ;?>" width=1050px height=1100px scrolling=no name=mio frameborder=0 ></iframe>
        </div>
        <?php  
        echo '
        <table  id="formLettera" >
          <tr  height=80>
            <td width=300 align=center><INPUT TYPE="button" value="Nuova ricerca"  onclick="azzera();"class=bottone250x74></td>
			<td  width=400 align=center valign=middle>';
			
			formRicercaAnalitica('form');
        echo '</td>';
        echo '
		<td width=300 align=center><INPUT TYPE="button" VALUE="&#8592 Torna indietro" onClick="stopper(); Correzione();" class=bottone250x74></td>
          </tr>
        </table>';
        ?>
      </div>  <!-- END entry-->
    </div><!-- END main2-->
    <?php  alfabeto(); ?>
  </div> <!-- END contenuto-->
 
  <div id='screensaver' onclick='HideScreenSaver();'>
    <div id="main2">
      <img  style='width:1050px;' src='/images/gemelli_ucsc.png'>
        <div style='text-align:center;'>
          <h2 style='font: 90px Montserrat; margin-top: 300px; margin-bottom:100px;'> ORIENTAMENTO </h2>
	  <img src='/images/bussola.png'>
          <h3 style='font: 60px Montserrat; margin-top:200px; color:black;'> Toccare lo schermo <br/> per iniziare</h3>
        </div>
    </div>
  </div>

</body>
<html>
