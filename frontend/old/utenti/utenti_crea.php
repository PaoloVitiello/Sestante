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


connetti_db();


$statmsg='';
if (!empty($_POST)) {
  if ($_POST['admin'] == 'N') {
    $admin_value = 0;
  } else {
    $admin_value = 1;
  }
  $q = "INSERT INTO utenti (username, nome, password, admin) 
        VALUES (\"$_POST[username]\", \"$_POST[nome]\",
                MD5(\"$_POST[password]\"), $admin_value) ";
  $res = mysql_query($q);
  if($res) { header("Location: utenti.php");}
  else {$statmsg=" ERRORE ".mysql_errno()."---".mysql_error();}
}
?>


<html>
<head>
	<?php include($path . "/sestante/srv/head.php"); ?>
	<title> Edit Video </title>
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

echo "<p class=titolo>Creazione Nuovo Utente</p>";

if ($logged) {
  if ($is_admin) {
    $pattern_username = "[a-zA-Z0-9]{1,128}";
    $help_username = "Username di autenticazione dell'utente, pu&ograve; contenere lettere maiuscole, minuscole e cifre";

    $pattern_password = ".*";
    $help_password = "Password di autenticazione dell'utente";

    $pattern_nome = ".*";
    $help_nome = "Nome completo dell'utente";

    $pattern_admin = "[SN]";
    $help_admin = "Privilegi di amministratore [S/N]";

    echo "<table id='modifica' cellpadding='3' RULES=ROWS FRAME=BOX>";
    echo " <form method='post'>";

    echo "  <tr>";
    echo "   <td class=right' > username: </td>";
    echo "   <td>";
    echo "    <input class='center' type='text' name='username' required='required' pattern='$pattern_username' autofocus >";
    echo "   </td>";
    echo "   <td>";
    echo "    <div class='help'>$help_username</div>";
    echo "   </td>";
    echo "  </tr>";

    echo "  <tr>";
    echo "   <td class=right' > password: </td>";
    echo "   <td>";
    echo "    <input class='center' type='password' name='password' value='' required='required' pattern='$pattern_password' autofocus >";
    echo "   </td>";
    echo "   <td>";
    echo "    <div class='help' >$help_password</div>";
    echo "   </td>";
    echo "  </tr>";

    echo "  <tr>";
    echo "   <td class=right' > nome: </td>";
    echo "   <td>";
    echo "    <input class='center' type='text' name='nome' required='required' pattern='$pattern_nome' autofocus >";
    echo "   </td>";
    echo "   <td>";
    echo "    <div class='help'>$help_nome</div>";
    echo "   </td>";
    echo "  </tr>";

    echo "  <tr>";
    echo "   <td class=right' > admin: </td>";
    echo "   <td>";
    echo "    <input class='center' type='text' name='admin' value='' required='required' pattern='$pattern_admin' autofocus >";
    echo "   </td>";
    echo "   <td>";
    echo "    <div class='help' >$help_admin</div>";
    echo "   </td>";
    echo "  </tr>";

    echo "</table>";
    echo "<div id='stato'>$statmsg</div>";

    // bottoni logged
    echo "<table class='buttons'><tr>";
    echo "<td><button class='action orange' type='submit' value='crea'>Crea</button>";
    echo "<button class='action green' type='button' onClick=\"window.location.href='/sestante/utenti/utenti.php'\">Annulla</button>";
    echo "</td></tr></form></table><br><br>";
    //fine bottoni logged

  } else {
    echo "<div class='alert'> Questa funzione &egrave; riservata agli utenti amministratori.</div>";
  }

} else {

  $phpfile= $_SERVER['PHP_SELF'];
  echo "<div class='alert'> Per accedere a questa funzione e' necessario autenticarsi</div>";
  // bottoni not logged
  echo "<table class='buttons'><tr>";
  echo "<form method='POST' action='/sestante/utenti/login.php'>";
  echo "<td><button class='action green' type'submit' name='file' value='$phpfile' autofocus >Login</button>";
  echo "</td></form>";
  echo "<form>";
  echo "<td><button class='action green' type='button' onClick=\"window.location.href='/sestante/utenti/utentu.php'\">Annulla</button>";
  echo "</td></form></tr></table>";
  // fine bottoni not logged
}
include "$path/sestante/srv/footer.php";
?>

</body>
</html>

