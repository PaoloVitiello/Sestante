<?php
session_start();
$logged=false;
$is_admin=false;
if(isset($_SESSION['sess_username'])) { $logged=true; $username = $_SESSION['sess_username'];}
if(isset($_SESSION['sess_is_admin'])) { $is_admin=$_SESSION['sess_is_admin'];}

$path = $_SERVER['DOCUMENT_ROOT'];
include($path."/sestante/srv/config.php");
include($path."/sestante/srv/db_helper.php");
include "$path/sestante/srv/doctype.php";

connetti_db();

$statmsg='';


if (isset($_POST['cambia']) && $logged) {

  $userid =  $_POST['userid'];
  $written_old_password = trim($_POST['old_password']);
  $new_password = trim($_POST['new_password']);
  $real_old_password_md5 = db_query_value("SELECT password FROM utenti WHERE id='$userid'");

  if ((md5($written_old_password) == $real_old_password_md5)) {
    $q = "UPDATE utenti SET password=MD5('$new_password')";
    $res = mysql_query($q);
    if($res) { 
      header("Location: utenti.php");
    }  else {
      $statmsg=" ERRORE ".mysql_errno()."---".mysql_error();
    }
  } else {
    $statmsg = "ERRORE La vecchia password inserita &egrave; errata.<br>Se dimenticata, richiedere una nuova password all'amministratore di sistema";
  }
}
?>


<html>
<head>
	<?php include($path . "/sestante/srv/head.php"); ?>
	<title> Cambia password </title>
<style>
#modifica {margin: 0 0 10px 50px; border: solid 1px black; padding:4px;}
td { vertical-align:top;}
td.right { text-align:right;}
textarea {resize:none; width:200px; }
input.center{width:200px;}
div.help {width:400px; word-wrap: break-word;}
#stato {margin:0 0 0 50px; color:red}
</style>
</head>
<body>
	<?php include($path . "/sestante/srv/header.php"); ?>

	
<?php 

echo "<p class=titolo>Modifica Password Utente</p>";

if ($logged) {
  if ($is_admin || !isset($_POST['userid']) || ($_POST['userid']==$_SESSION['sess_user_id'])) {
    if (!isset($_POST['userid'])) {
      $userid = $_SESSION['sess_user_id'];
    } else {
      $userid = $_POST['userid'];
    }
      
    $pattern_password = ".*";
    $help_password = "Password di autenticazione dell'utente";

    echo "<table id='modifica' cellpadding='3' RULES=ROWS FRAME=BOX>";
    echo " <form method='post'>";

if(!$is_admin) {
    echo "  <tr>";
    echo "   <td class=right' > vecchia password: </td>";
    echo "   <td>";
    echo "    <input class='center' type='password' name='old_password' value='' required='required' pattern='$pattern_password' autofocus >";
    echo "   </td>";
    echo "   <td>";
    echo "    <div class='help' >$help_password</div>";
    echo "   </td>";
    echo "  </tr>";
	}
    echo "  <tr>";
    echo "   <td class='right' > nuova password: </td>";
    echo "   <td>";
    echo "    <input class='center' type='password' name='new_password' value='' required='required' pattern='$pattern_password' >";
    echo "   </td>";
    echo "   <td>";
    echo "    <div class='help' >$help_password</div>";
    echo "   </td>";
    echo "  </tr>";

    echo "</table>";
    echo "<input type='hidden' name='userid' value='$userid'>";


    // bottoni logged
    echo "<table class='buttons'><tr>";
    echo "<td><button class='action orange' type='submit' name='cambia'>Modifica</button>";
    echo "<button class='action green' type='button' onClick=\"window.location.href='/utenti/utenti.php'\">Annulla</button>";
    echo "</td></tr></form></table><br>";
    //fine bottoni logged

  } else {
  $statmsg="Questa funzione &egrave; riservata agli utenti amministratori.</div>";
  echo "<td><button class='action green' type='button' onClick=\"window.location.href='/sestante/home/home.php'\">Annulla</button>";
  }

} else {

  $phpfile= $_SERVER['PHP_SELF'];
  echo "<div class='alert'> Per accedere a questa funzione e' necessario autenticarsi</div>";
  // bottoni not logged
  echo "<table class='buttons'><tr>";
  echo "<form method='POST' action='/utenti/login.php'>";
  echo "<td><button class='action green' type'submit' name='file' value='$phpfile' autofocus >Login</button>";
  echo "</td></form>";
  echo "<form>";
  echo "<td><button class='action green' type='button' onClick=\"window.location.href='/sestante/home/home.php'\">Annulla</button>";
  echo "</td></form></tr></table>";
  // fine bottoni not logged
}
echo "<div id='stato'>$statmsg</div><br>";
include "$path/sestante/srv/footer.php";
?>

</body>
</html>
