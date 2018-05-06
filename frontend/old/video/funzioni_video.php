<?php

$path = $_SERVER['DOCUMENT_ROOT'];
$img_path = $path."/img/";

include_once($path."/sestante/srv/config.php");
include_once($path."/sestante/srv/db_helper.php");


$shell_command = 'sudo xvfb-run -a -s "-screen 0, 1080x1920x24" CutyCapt --url="%s" --out="%s" --min-width=1080 --min-height=1920'; // parametri: url, outfile

$crontab_clear_command = "crontab -r";
$crontab_set_command = "crontab <<< \"%s\"";
$crontab_string = "%d %d * * * curl --silent http://localhost/video/send_all_images.php > /dev/null";
$crontab_spegnimento_ascensori_string = "0,30 * * * * curl --silent http://localhost/ascensori/spegnimento.php > /dev/null &";
$crontab_switch_paginazione_string = "*/10 * * * * curl --silent  http://localhost/ascensori/switch_all_paginated.php > /dev/null &";

$async_send_command = "curl --silent http://localhost/video/send_all_images.php > /dev/null &";
$async_save_command = "curl --silent http://localhost/video/save_all_images.php > /dev/null &";

function folder_to_use($idvideo) {
  global $img_path;

  $dir = $img_path . "/" . $idvideo;
  if(!file_exists($dir)) {
    mkdir($dir);
  }
  return $dir;
}



function image_to_use($idvideo) {
  return folder_to_use($idvideo) . "/image-" . $idvideo . ".png";
}

function image_to_use_pm($idvideo) {
  return folder_to_use($idvideo) . "/image-pm-" . $idvideo . ".png";
}

function image_page_to_use($idvideo,$page) {
  return folder_to_use($idvideo) . "/image_" . sprintf("%04d",$page) . "-" . $idvideo . ".png";
}

function image_page_to_use_pm($idvideo, $page) {
  return folder_to_use($idvideo) . "/image_". sprintf("%04d",$page)."-pm-" . $idvideo . ".png";
}




function generate_image($idvideo) {
  global $shell_command;

  if(!valid_idvideo($idvideo)) {
    return "error\ninvalid idvideo\n";
  } else {

    $filename = image_to_use($idvideo);

    connetti_db();
    $q = "SELECT generatore, generatore2, generatore3, generatore4 FROM video WHERE idvideo='$idvideo' LIMIT 1";
    list($generatore, $generatore2, $generatore3, $generatore4) = db_query_value($q);
    if(!$generatore) {
      return "error\nquery error\n";
    } else {
      $cmd = sprintf($shell_command, $generatore, $filename);
      exec($cmd, $txt,$ret);
      if($ret !== 0) {
	return "error/nprocess error/n";
      }

      // generatore pm
      if($generatore2) {
	$filename = image_to_use_pm($idvideo);
	$cmd = sprintf($shell_command, $generatore2, $filename);
	exec($cmd, $txt, $ret);
      } 
      // generatore pag2
      if($generatore3) {
	$filename = image_page_to_use($idvideo,1);
	$cmd = sprintf($shell_command, $generatore3, $filename);
	exec($cmd, $txt, $ret);
      } 

      // generatore pag2 pm
      if($generatore4) {
	$filename = image_page_to_use_pm($idvideo,1);
	$cmd = sprintf($shell_command, $generatore4, $filename);
	exec($cmd, $txt, $ret);
      } 

      return true;
    }
  }
}



function send_via_ftp($ip, $file, $filename_dest) {
  $timeout = 2;
  $conn = ftp_connect($ip, 21, $timeout);
  if ($conn===false) return ("error\nfailed ftp connection to $ip");
  if(ftp_login($conn, "anonymous", "")===false) return ("error\nfailed ftp login to $ip");
  if(ftp_chdir($conn, "in")===false) return("error\nfailed ftp chdir to $ip");
  if(ftp_pasv($conn, True) === false) return("error\nfailed ftp pasv to $ip");
  if(ftp_put($conn, $filename_dest, $file, FTP_BINARY) === false) return("error\nfailed ftp put to $ip");
  ftp_close($conn);
  return True;
}


function send_image($idvideo) {
  if(!valid_idvideo($idvideo)) {
    return "error\ninvalid idvideo\n";
  } else {
    connetti_db();
    $query = "SELECT Valore FROM sistema WHERE Parametro = 'Persistenza'";
    $persistenza = db_query_value($query);
    if ($persistenza != 'N') {
      $query_start = "SELECT Valore FROM sistema WHERE Parametro = 'PersistenzaStart'";
      $query_end = "SELECT Valore FROM sistema WHERE Parametro = 'PersistenzaEnd'";
      $start = db_query_value($query_start);
      $end = db_query_value($query_end);
      $start_epoch = strtotime($start);
      $end_epoch = strtotime($end);
      $now_epoch = strtotime('now');
      if ($end_epoch < $start_epoch) {
	$pm = ($now_epoch < $end_epoch) || ($now_epoch > $start_epoch);
      } else {
	$pm = ($start_epoch < $now_epoch) && ($now_epoch < $end_epoch);
      }
      return send_image_am_pm($idvideo, $pm);
    } else {
     return send_image_am_pm($idvideo, false);
    }
  }
}


function send_image_am_pm($idvideo, $pm) {
  // connetti_db gia chiamato da send_image
  // verifica idvideo gia fatta da send_image
  $q = "SELECT ip FROM video WHERE idvideo='$idvideo' LIMIT 1";
  $ip = db_query_value($q);
  if(!$ip) {
    return "error\nquery error\n";
  } else {
    if ($pm) {
      $img = image_to_use_pm($idvideo);
      $img_page = image_page_to_use_pm($idvideo, 1);
    } else {
      $img = image_to_use($idvideo);
      $img_page = image_page_to_use($idvideo, 1);
    }

    if (file_exists($img_page)) {
      send_via_ftp($ip, $img_page, "image_0001.png");
    }

    if (file_exists($img)) {
      return send_via_ftp($ip, $img, "image.png");
    } else {
      return "error\nno image found\n";
    }
  }
}


function send_all_images() {
  // assume 70 display, with 3 seconds timeout each
  set_time_limit(3*70);

  connetti_db();
  $timestamp_invio = db_query_value("SELECT Valore FROM progresso WHERE Parametro='timestamp_invio'");

  if($timestamp_invio > strtotime('-5 minutes')) {
    return "errore\ninvio in corso\n";
  }
  //set timestamp
  db_query_value("UPDATE progresso SET Valore='".strtotime('now')."' WHERE Parametro='timestamp_invio'");
  
  $ids = db_query_list("SELECT idvideo FROM video");
  $count = count($ids);

  // set totale
  db_query_value("UPDATE progresso SET Valore='$count' WHERE Parametro='totale_invio'");
  // azzera contatore
  db_query_value("UPDATE progresso SET Valore='0' WHERE Parametro='progresso_invio'");
  // azzera errori
  db_query_value("UPDATE progresso SET Valore='' WHERE Parametro='errori_invio'");
  $errori = array();

  foreach ($ids as $idvideo) {
    // echo "$idvideo ";
    $return = send_image($idvideo);
    if (is_string($return)) {
      $errori[] = $idvideo;
      $errori_string = implode(';', $errori);
      db_query_value("UPDATE progresso SET Valore='$errori_string' WHERE Parametro='errori_invio'");
    }
    // echo "<br>";
    db_query_value("UPDATE progresso SET Valore=Valore+1 WHERE Parametro='progresso_invio'");
  }

  //unset timestamp
  db_query_value("UPDATE progresso SET Valore='0' WHERE Parametro='timestamp_invio'");
  
  return true;
}


function save_all_images() {
  // assume 70 display, with 30 seconds timeout each
  set_time_limit(30*70);

  connetti_db();
  $timestamp_invio = db_query_value("SELECT Valore FROM progresso WHERE Parametro='timestamp_save'");

  if($timestamp_save > strtotime('-10 minutes')) {
    return "errore\ninvio in corso\n";
  }
  //set timestamp
  db_query_value("UPDATE progresso SET Valore='".strtotime('now')."' WHERE Parametro='timestamp_save'");
  
  $ids = db_query_list("SELECT idvideo FROM video");
  $count = count($ids);

  // set totale
  db_query_value("UPDATE progresso SET Valore='$count' WHERE Parametro='totale_save'");
  // azzera contatore
  db_query_value("UPDATE progresso SET Valore='0' WHERE Parametro='progresso_save'");
  // azzera errori
  db_query_value("UPDATE progresso SET Valore='' WHERE Parametro='errori_save'");
  $errori = array();

  foreach ($ids as $idvideo) {
    // echo "$idvideo ";
    $return = generate_image($idvideo);
    $return2 = send_image($idvideo);
    if (is_string($return) || is_string($return2)) {
      $errori[] = $idvideo;
      $errori_string = implode(';', $errori);
      db_query_value("UPDATE progresso SET Valore='$errori_string' WHERE Parametro='errori_save'");
    }
    // echo "<br>";
    db_query_value("UPDATE progresso SET Valore=Valore+1 WHERE Parametro='progresso_save'");
  }

  //unset timestamp
  db_query_value("UPDATE progresso SET Valore='0' WHERE Parametro='timestamp_save'");
  
  return true;
}




function send_all_images_async() {
  global $async_send_command;
  exec($async_send_command);
  return true;
}


function save_all_images_async() {
  global $async_save_command;
  exec($async_save_command);
  return true;
}


function status_invio() {
  connetti_db();
  $timestamp_invio = db_query_value("SELECT Valore FROM progresso WHERE Parametro='timestamp_invio'");
  $totale_invio = db_query_value("SELECT Valore FROM progresso WHERE Parametro='totale_invio'");
  $progresso_invio = db_query_value("SELECT Valore FROM progresso WHERE Parametro='progresso_invio'");
  $errori_invio = db_query_value("SELECT Valore FROM progresso WHERE Parametro='errori_invio'");
  $errori_invio = explode(';', $errori_invio);
  return array('timestamp' => $timestamp_invio, 'totale' => $totale_invio, 'progresso' => $progresso_invio, 'errori' => $errori_invio);
}

function status_save() {
  connetti_db();
  $timestamp_save = db_query_value("SELECT Valore FROM progresso WHERE Parametro='timestamp_save'");
  $totale_save = db_query_value("SELECT Valore FROM progresso WHERE Parametro='totale_save'");
  $progresso_save = db_query_value("SELECT Valore FROM progresso WHERE Parametro='progresso_save'");
  $errori_save = db_query_value("SELECT Valore FROM progresso WHERE Parametro='errori_save'");
  $errori_save = explode(';', $errori_save);
  return array('timestamp' => $timestamp_save, 'totale' => $totale_save, 'progresso' => $progresso_save, 'errori' => $errori_save);
}


function setup_cron_job($start_hour,$start_minute,$end_hour,$end_minute) {
  global $crontab_clear_command, $crontab_set_command, $crontab_string, $crontab_spegnimento_ascensori_string, $crontab_switch_paginazione_string;

  exec($crontab_clear_command);
  $cmd1 = sprintf($crontab_string, $start_minute+1, $start_hour);
  $cmd2 = sprintf($crontab_string, $end_minute+1, $end_hour);
  $joined = $cmd1."\n".$cmd2."\n".$crontab_spegnimento_ascensori_string."\n".$crontab_switch_paginazione_string;
  exec(sprintf($crontab_set_command, $joined), $txt, $ret);
  return $ret;
}


function reboot_via_http($idvideo) {
  if(!valid_idvideo($idvideo)) {
    return "error\ninvalid idvideo\n";
  } else {
    $ip = db_query_value("SELECT ip FROM video WHERE idvideo='$idvideo' LIMIT 1");
    $ctx = stream_context_create(array('http' => array('timeout' => 1))); 
    $ret = file_get_contents("http://".$ip."/reboot", 0, $ctx);
    return $ret;
  }
}

function ping_via_http($idvideo) {
  if(!valid_idvideo($idvideo)) {
    return "error\ninvalid idvideo\n";
  } else {
    $ip = db_query_value("SELECT ip FROM video WHERE idvideo='$idvideo' LIMIT 1");
    $ctx = stream_context_create(array('http' => array('timeout' => 1))); 
    $ret = @file_get_contents("http://".$ip."/ping", 0, $ctx);
    return $ret;
  }
}

function video_on_via_http($idvideo) {
  if(!valid_idvideo($idvideo)) {
    return "error\ninvalid idvideo\n";
  } else {
    $ip = db_query_value("SELECT ip FROM video WHERE idvideo='$idvideo' LIMIT 1");
    $ctx = stream_context_create(array('http' => array('timeout' => 1))); 
    $ret = file_get_contents("http://".$ip."/video_on", 0, $ctx);
    return $ret;
  }
}

function video_off_via_http($idvideo) {
  if(!valid_idvideo($idvideo)) {
    return "error\ninvalid idvideo\n";
  } else {
    $ip = db_query_value("SELECT ip FROM video WHERE idvideo='$idvideo' LIMIT 1");
    $ctx = stream_context_create(array('http' => array('timeout' => 1))); 
    $ret = file_get_contents("http://".$ip."/video_off", 0, $ctx);
    return $ret;
  }
}

function video_switch_via_http($idvideo) {
 if(!valid_idvideo($idvideo)) {
    return "error\ninvalid idvideo\n";
  } else {
    $ip = db_query_value("SELECT ip FROM video WHERE idvideo='$idvideo' LIMIT 1");
    $ctx = stream_context_create(array('http' => array('timeout' => 1))); 
    $ret = file_get_contents("http://".$ip."/switch", 0, $ctx);
    return $ret;
  }
}




function spegnimento_ascensori() {
  connetti_db();
  $query_start = "SELECT Valore FROM sistema WHERE Parametro = 'AccensioneMonitor'";
  $query_end = "SELECT Valore FROM sistema WHERE Parametro = 'SpegnimentoMonitor'";
  $start = db_query_value($query_start);
  $end = db_query_value($query_end);
  $start_epoch = strtotime($start);
  $end_epoch = strtotime($end);
  $now_epoch = strtotime('now');
  if ($end_epoch < $start_epoch) {
    $on = ($now_epoch < $end_epoch) || ($now_epoch > $start_epoch);
  } else {
    $on = ($start_epoch < $now_epoch) && ($now_epoch < $end_epoch);
  }

  $query = "SELECT idvideo FROM ascensori WHERE spegnimento = 's'";
  $video_da_spegnere = db_query_list($query);
  foreach($video_da_spegnere as $idvideo) {
    echo "$idvideo - ";
    if ($on) {
      echo "on<br>";
      video_on_via_http($idvideo);
    } else {
      echo "off<br>";
      video_off_via_http($idvideo);
    }
  }
}


function switch_all_paginated() {
  set_time_limit(660);
  connetti_db();
  $start = time();
  $last_switch = 0;
  // per 10 minuti
  while (time() < $start + 600) {
    $intervallo = db_query_value("SELECT Valore FROM sistema WHERE Parametro = 'IntervalloPaginazione'");
    if (time() > $last_switch + $intervallo) {
      //error_log("avvio $start, intervallo $intervallo, now ".time());
      $query = "SELECT idvideo FROM ascensori WHERE paginazione != ''";
      $video_da_switchare = db_query_list($query);
      foreach($video_da_switchare as $idvideo) {
	video_switch_via_http($idvideo);
      }
      $last_switch = time();
    } else {
      sleep(1);
    }
  }
  //error_log('fine 10 min '.time());
}

?>
