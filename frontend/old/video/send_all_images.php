<?php

include_once("funzioni_video.php");
// include db_helper.php, config.php
// importa $path, $path_img

$ret = send_all_images();
if(is_string($ret)) {
  echo $ret;
} else {
  echo "ok\n";
}

?>

