<?php
$path = $_SERVER['DOCUMENT_ROOT'];
include_once($path."/sestante/srv/config.php");
include_once($path."/sestante/srv/db_helper.php");

connetti_db();
$ip = db_query_value("SELECT Valore FROM sistema WHERE Parametro = 'IP Server'");
?>

  <div id="footer">
  sestante-admin.net <?php echo $ip; ?>
  </div>
</div>
