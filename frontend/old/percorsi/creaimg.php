<?php
  $path=$_SERVER["DOCUMENT_ROOT"];
  include_once "$path/sestante/srv/config.php";
  include_once "$path/sestante/srv/doctype.php";
  
  echo '<HTML>  <link rel="stylesheet" href="/sestante/srv/styles.css" type="text/css"><HEAD></HEAD><BODY>';
  if(isset($_GET["index"])) { $index=$_GET["index"]; }

  connetti_db();

  $query = 'select * from videowall ORDER BY Idvideo ';
  $result = mysql_query($query);
  $x = 1;
  while ($riga = mysql_fetch_assoc($result)){
    if($x==$index) {
    $idvideo = $riga['Idvideo']; 
    $posiziobe = $riga['Posizione']; 
    $widtab = $riga['Widtab']; 
    $heitab = $riga['Heitab']; 
    $fontab = $riga['Fontab']; 
    $linee = $riga['Linee']; 
    $widrep = $riga['Widrep']; 
    $widedi = $riga['Widedi']; 
    $widpia = $riga['Widpia']; 
    $widsta	= $riga['Widsta']; 
    }
	$x++;
    }

 $reparto=array();
  $query = 'select * from percorsi WHERE Attivo="X" OR Attivo="x" ORDER BY Nome ';
  $result = mysql_query($query);
  $x = 1;
  while ($riga = mysql_fetch_assoc($result)){
    $reparto[] = $riga['Nome']; 
    $edificio[] = $riga['Edificio']; 
    $piano[] = $riga['Piano']; 
    $stanza[] = $riga['Stanza']; 
	$x++;
    }
  $passo=floor(630/intval($linee));
  $start=intval(strval(intval($index)-1)*strval(intval($linee)));
  $end=intval(strval(intval($index))*strval(intval($linee)));
  
  echo '<table style="table-layout:fixed; float:left; display:block; height:'.$heitab.'px; width:'.$widtab.'px; border:solid 1px;; margin:0 ;  font-size:'.$fontab.'px;">';
  $i=0; 
    echo '<tr style=" height:80px; width:360px; background-color:#EEE;" >
	<td style="width:'.$widrep.'px; padding:0 0 0 4px;">'."Reparto".' </td>
	<td style="width:'.$widedi.'px; padding:3px; line-height: 0.8; text-align: center;">'."Edif.".' </td>
	<td style="width:'.$widpia.'px; padding:0; line-height: 0.8; text-align: center;">'."P.".' </td>
	<td style="width:'.$widsta.'px; padding:0; text-align: center;">'."Stanza".' </td>
	</tr>';

    echo '<tr style=" width:360px;" >
	</tr>';
 
  foreach($reparto as $value ) {
  if($i >=$start AND $i < $end) {
    echo '<tr style=" height:auto; width:360px; background-color:#DDD;" >
	<td style="padding:0 0 0 4px;">'.$value.' </td>
	<td style="padding:0 0 0 4px; text-align: center;">'.$edificio[$i].' </td>
	<td style="padding:0 0 0 6px; text-align: center;">'.$piano[$i].' </td>
	<td style="padding:0 0 0 4px;">'.$stanza[$i].' </td>
	</tr>';
	}
	$i++;
  }
  echo '</table>';

?>

<!-- Content End -->
</BODY>
</HTML>