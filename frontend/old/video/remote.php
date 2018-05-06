<?php

include_once("funzioni_video.php");
// include db_helper.php, config.php
// importa $path, $path_img


if(isset($_GET['idvideo']) && isset($_GET['op'])) {
  $idvideo = $_GET['idvideo'];
  $op = $_GET['op'];
  connetti_db();
  if ($op == "reboot") {
    $ret = reboot_via_http($idvideo);
  } else if ($op == "video_on") {
    $ret = video_on_via_http($idvideo);
  } else if ($op == "video_off") {
    $ret = video_off_via_http($idvideo);
  } else if ($op == "ping") {
    $ret = ping_via_http($idvideo);
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

