<?php
    
function db_query_value($query) {
  $r = mysql_query($query);
  if($r && mysql_num_rows($r)>0) {
    $arr = mysql_fetch_row($r);
    if(count($arr) == 1) {
      return $arr[0];
    } else {
      return $arr;
    }
  } else {
    return false;
  }
}

function db_query_list($query) {

  $r = mysql_query($query);

  if($r && mysql_num_rows($r)>0) {
    $list = array();

    while ($arr = mysql_fetch_row($r)) {
      if(count($arr) == 1) {
	$list[] = $arr[0];
      } else {
	$list[] = $arr;
      }
    }
    return $list;
  } else {
    return array();
  }
}
	
function valid_idvideo($idvideo) {
  if((strlen($idvideo)==4) && is_numeric($idvideo) && ($idvideo>0) && ($idvideo<=9999)) {
    return True;
  } else {
    return False;
  }
}

function valid_idtouch($idtouch) {
  if(is_numeric($idtouch) && ($idtouch>0) && ($idtouch<=9999)) {
    return True;
  } else {
    return False;
  }
}

?>
