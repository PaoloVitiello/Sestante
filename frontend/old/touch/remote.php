<?php

include_once("funzioni_touch.php");
// include db_helper.php, config.php
// importa $path, $path_img


if(isset($_GET['idtouch']) && isset($_GET['op'])) {
  $idtouch = $_GET['idtouch'];
  $op = $_GET['op'];
  connetti_db();
  if ($op == "reboot") {
    $ret = reboot_touch_via_http($idtouch);
  } else if ($op == "ping") {
    $ret = ping_touch_via_http($idtouch);
  } else {
    echo "error\noperation not recognized\n";
  }
  if ($ret === false || $ret === "") { 
    echo "error\nfailed to open stream\n";
  } else { 
    echo $ret; 
  }
} else {
  echo "error\nmissing idvideo or op(eration)\n";
}

?>

