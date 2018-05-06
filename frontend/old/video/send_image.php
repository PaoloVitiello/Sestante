<?php

include_once("funzioni_video.php");
// include db_helper.php, config.php
// importa $path, $path_img


if(!isset($_GET['idvideo'])) {
  echo "error\nmissing idvideo\n";
} else {
  $idvideo = $_GET['idvideo'];
  $ret = send_image($idvideo);
  if(is_string($ret)) {
    echo $ret;
  } else {
    echo "ok\n";
  }
}

?>

