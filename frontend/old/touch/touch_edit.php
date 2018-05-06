<?php
session_start();
$logged=false;
$is_admin=false;
if(isset($_SESSION['sess_username'])) { $logged=true;}
if(isset($_SESSION['sess_is_admin'])) { $is_admin=$_SESSION['sess_is_admin'];}

$path = $_SERVER['DOCUMENT_ROOT'];
include($path."/sestante/srv/config.php");
include($path."/sestante/srv/db_helper.php");
include "$path/sestante/srv/doctype.php";

$descrizione='';
connetti_db();

if(isset($_POST['touchid'])) {
  $id = $_POST['touchid'];
  list($descrizione, $ip) = db_query_value("SELECT descrizione, ip FROM touch WHERE id='$id'");
}

$statmsg='';
if (isset($_POST['salva'])) {
  $q = "UPDATE touch SET descrizione = '$_POST[descrizione]',
                           ip = '$_POST[ip]'
          WHERE id = '$_POST[touchid]'";
  
  $res = mysql_query($q);
  if($res) { header("Location: touch.php");}
  else {$statmsg=" ERRORE ".mysql_errno()."---".mysql_error();}
}
?>


<html>
<head>
	<?php include($path . "/sestante/srv/head.php"); ?>
	<title> Edit Touchscreen </title>
<style>
#modifica {margin: 0 0 20px 50px; border: solid 1px black; padding:4px;}
#titolo { margin:50px; font-size: 30px;}
td { vertical-align:top;}
td.right { text-align:right;}
textarea {resize:none; width:200px; }
input.center{width:200px;}
div.help {width:400px; word-wrap: break-word;}
#stato {margin:0 0 0 50px; color:red;}
</style>
</head>
<body>

<?php include($path . "/sestante/srv/header.php"); ?>

<?php

echo "<p class=titolo>Modifica Touchscreen</p>";

if ($logged) {
  if ($is_admin) {
    $pattern_desc = ".*";
    $help_desc = "Descrizione estesa del touchscreen";

    //$pattern_ip="([01]?\\d\\d?|2[0-4]\\d|25[0-5])\\.([01]?\\d\\d?|2[0-4]\\d|25[0-5])\\.([01]?\\d\\d?|2[0-4]\\d|25[0-5])\\.([01]?\\d\\d?|2[0-4]\\d|25[0-5])";
    $pattern_ip="^(([a-zA-Z0-9]|[a-zA-Z0-9][a-zA-Z0-9\-]*[a-zA-Z0-9])\.)*([A-Za-z0-9]|[A-Za-z0-9][A-Za-z0-9\-]*[A-Za-z0-9])$";
    $help_ip="Indirizzo ip o nome host del touchscreen ";


    echo "<table id='modifica' cellpadding='3' RULES=ROWS FRAME=BOX>";
    echo " <form method='post'>";

    echo "  <tr>";
    echo "   <td class=right' > descrizione: </td>";
    echo "   <td>";
    echo "    <input class='center' type='text' name='descrizione' value='$descrizione' pattern='$pattern_desc' autofocus >";
    echo "   </td>";
    echo "   <td>";
    echo "    <div class='help'>$help_desc</div>";
    echo "   </td>";
    echo "  </tr>";

    echo "  <tr>";
    echo "   <td class=right' > host: </td>";
    echo "   <td>";
    echo "    <input class='center' type='text' name='ip' value='$ip' required='required' pattern='$pattern_ip' autofocus >";
    echo "   </td>";
    echo "   <td>";
    echo "    <div class='help'>$help_ip</div>";
    echo "   </td>";
    echo "  </tr>";

    echo "</table>";
    echo "<div id='stato'>$statmsg</div>";


    // bottoni logged
    echo "<table class='buttons'><tr>";
    echo "<td><button class='action orange' type='submit' name='salva' value='salva'>Salva</button>";
    echo "<input type='hidden' name='touchid' value='$id'>";
    echo "<button class='action green' type='button' onClick=\"window.location.href='/touch/touch.php'\">Annulla</button>";
    echo "</td></tr></form></table><br><r>";
    //fine bottoni logged
  } else {
    echo "<div class='alert'> Questa funzione &egrave; riservata agli utenti amministratori.</div>";
  }

} else {
$phpfile= $_SERVER['PHP_SELF'];
echo "<div class='alert'> Per accedere a questa funzione e' necessario autenticarsi</div>";
// bottoni not logged
echo "<table class='buttons'><tr>";
echo "<form method='POST' action='/utenti/login.php'>";
echo "<input type='hidden' name='userid' value='$id'>";
echo "<td><button class='action green' type'submit' name='file' value='$phpfile' autofocus >Login</button>";
echo "</td></form>";
echo "<form>";
echo "<td><button class='action green' type='button' onClick=\"window.location.href='/utenti/utenti.php'\">Annulla</button>";
echo "</td></form></tr></table><br>";
// fine bottoni not logged
}

/*
echo "<pre>";
print_r($_POST);
echo "</pre>";
*/

include "$path/sestante/srv/footer.php";
?>

</body>
</html>

