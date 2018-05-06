<?php

function connetti_db(){
  global $CONF;
  $link = mysql_connect ($CONF['database_host'], 
                         $CONF['database_user'], 
                         $CONF['database_password']
                        ) 
						 or die ("<p />DEBUG INFORMATION:<br />Connect: " .  mysql_error () . " " . $CONF['database_host'] . " " . $CONF['database_user'] . "/" . $CONF['database_password']);
  
  mysql_select_db ($CONF['database_name'],$link) 
                   or die ("<p />DEBUG INFORMATION:<br />MySQL Select Database: " .  mysql_error () . "");
}
/*
function GetLcd($index) {

// parametri da ricavare da database
  $widtab="1080px";
  $heitab="1920px";
  $fontab="33px";
  $lines=36;
  $widrep="750px";
  $widedi="80px";
  $widpia="50px";
  $widsta="180px";
// **************  

  connetti_db();
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
  
  // $reparto=prelevareparto();
  $passo=floor(630/intval($lines));
  $start=intval(strval(intval($index)-1)*strval(intval($lines)));
  $end=intval(strval(intval($index))*strval(intval($lines)));
  
  echo '<table style="table-layout:fixed; float:left; display:block; height:'.$heitab.'; width:'.$widtab.'; border:solid 1px; margin:50px 0 0 0 ;  font-size:'.$fontab.';">';
  $i=0; 
    echo '<tr style=" height:80px; width:360px; background-color:#EEE;" >
	<td style="width:'.$widrep.'; padding:0 0 0 4px;">'."Reparto".' </td>
	<td style="width:'.$widedi.'; padding:3px; line-height: 0.8; text-align: center;">'."Edif.".' </td>
	<td style="width:'.$widpia.'; padding:0; line-height: 0.8; text-align: center;">'."P.".' </td>
	<td style="width:'.$widsta.'; padding:0; text-align: center;">'."Stanza".' </td>
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
}
*/

?>
