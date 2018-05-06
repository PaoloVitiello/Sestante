<?php
error_reporting(E_ALL | E_STRICT);  
ini_set('display_errors',1);  
ini_set('display_startup_errors',1);  
ini_set('log_errors',1);  
ini_set('log_errors_max_len',0);  
ini_set('ignore_repeated_errors',0);  
ini_set('ignore_repeated_source',0);  
ini_set('report_memleaks',1);  
ini_set('track_errors',1);  
ini_set('error_log','/percorso/file/php_error.log');
  $path=$_SERVER["DOCUMENT_ROOT"];
  include "$path/sestante/srv/config.php";
  include "$path/sestante/srv/doctype.php";
?>
<HTML>
<HEAD>
<?php include "$path/sestante/srv/head.php"; ?>

<style>
td.right { text-align:right;}
#titolo { margin:50px; font-size: 30px;}
</style>
</HEAD>
<BODY>
<?php include "$path/sestante/srv/header.php"; ?>
<!-- Content Start -->

<?php
echo "<p id=titolo>Configurazione di Sistema</p>";
echo "<table class='tabella' ><tr style='background-color:silver; font-weight:bold;'><td>Parametro</td><td>Valore</td><td>Azione</td></tr>";

connetti_db();
$query= "SELECT * FROM sistema" ;
$result = mysql_query($query);
$x = 1;
$parametri=array();
while ($riga = mysql_fetch_assoc($result)){
  $parametri[$x][0] = $riga['Id'];
  $parametri[$x][1] = $riga['Parametro'];
  $parametri[$x][2] = $riga['Valore']; 
  echo "<tr><td class='right'>".$parametri[$x][1].":</td>";
  echo     "<td>".$parametri[$x][2]."</td>";
  $iidd=$parametri[$x][0];
  echo "<td><form method='POST' action='sistema_edit.php'>";
  echo "<input type='hidden' name='edit' value='$iidd'>";
  echo "<button class='action orange' name='file' value='sistema.php' >Modifica</button></form></td></tr>";
  $x++;
  }
echo "</table>";
    
?>


<!-- Content End -->
<?php include "$path/sestante/srv/footer.php"; ?>
</BODY>
</HTML>