<?php 

include 'inc/config.inc';

if (isset($_GET['stampaPS']))
{
  header('Refresh: '.$CONF['AttendiStampaPS'].'; URL=/unita.php?method=analitico');
} else if (!isset($_GET['mappa'])) {
  //header('Refresh:  '.$CONF[AttendiRitornoMappa].'; URL=/unita.php?method=analitico&mappa');
}

connetti_db(); 
echo "<html><head>";
echo "<style> * {cursor: url('/images/point.gif'), default;} </style>";
echo "</head>";
                
if (eregi("MSIE",$_SERVER['HTTP_USER_AGENT'])) 
{
  echo '<link rel="Stylesheet" href="/css/ie.css" type="text/css" media="screen" />';
} else {
  echo '<link rel="Stylesheet" href="/css/style.css" type="text/css" media="screen" />';
}
echo "</head><body>";

if (isset($_GET['mappa'])) { mappa(); }
else if (isset($_GET['stampa'])) { stampa($_GET['unita']); }
else if (!isset($_GET['stampaPOST'])) { elenco(); }

if (isset($_GET['stampaPOST'])) {stampaPOST($_GET['unita']); }

echo "</body></html>";

?>
