<?php

include_once("funzioni_video.php");
// include db_helper.php, config.php
// importa $path, $path_img

$h = $_GET['h'];
$m = $_GET['m'];
$ret = setup_cron_job($h,$m,7,0);
if(is_string($ret)) {
  echo $ret;
} else {
  echo "ok\n";
}

?>

