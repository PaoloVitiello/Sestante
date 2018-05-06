<?php

$path = $_SERVER['DOCUMENT_ROOT'];
$img_path = $path."/img/";

include_once($path."/sestante/srv/config.php");
include_once($path."/sestante/srv/db_helper.php");




function reboot_touch_via_http($idtouch) {
  if(!valid_idtouch($idtouch)) {
    return "error\ninvalid idtouch\n";
  } else {
    $ip = db_query_value("SELECT ip FROM touch WHERE id='$idtouch' LIMIT 1");
    $ctx = stream_context_create(array('http' => array('timeout' => 1))); 
    $ret = file_get_contents("http://".$ip."/reboot", 0, $ctx);
    return $ret;
  }
}

function ping_touch_via_http($idtouch) {
  if(!valid_idtouch($idtouch)) {
    return "error\ninvalid idtouch\n";
  } else {
    $ip = db_query_value("SELECT ip FROM touch WHERE id='$idtouch' LIMIT 1");
    $ctx = stream_context_create(array('http' => array('timeout' => 1))); 
    $ret = @file_get_contents("http://".$ip."/ping", 0, $ctx);
    return $ret;
  }
}


?>
