<?php


function post($url, $data) {
  // use key 'http' even if you send the request to https://...
  $options = array(
		   'http' => array(
				   'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
				   'method'  => 'POST',
				   'content' => http_build_query($data),
				   ),
		   );
  $context  = stream_context_create($options);
  $result = file_get_contents($url, false, $context);
  return $result;
}

function stato_carta_from_touch_ip($ip, $touchid) {
  if (is_null($touchid)) {
    $q = "SELECT carta FROM touch WHERE ip='$ip'";
  } else {
    $q = "SELECT carta FROM touch WHERE id='$touchid'";
  }
  list($carta) = mysql_fetch_row(mysql_query($q));
  return $carta;
}  

function print_ticket($ip, $id_percorso) {
  $q = "SELECT reparto, edificio, piano, stanza
        FROM percorsi
        WHERE id=$id_percorso";
  list($reparto, $edificio, $piano, $stanza) = mysql_fetch_row(mysql_query($q));
  post("http://".$ip."/print", array('reparto' => $reparto, 'edificio' => $edificio, 'piano' => $piano, 'stanza' => $stanza));
}


?>
