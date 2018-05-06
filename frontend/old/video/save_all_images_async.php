<?php

include_once("funzioni_video.php");
// include db_helper.php, config.php
// importa $path, $path_img

$ret = save_all_images_async();
if(is_string($ret)) {
  echo $ret;
} else {
  echo "ok\n";
}

?>

