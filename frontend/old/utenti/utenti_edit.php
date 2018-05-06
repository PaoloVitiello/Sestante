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

if(isset($_POST['userid'])) {
  $id = $_POST['userid'];
  list($username, $nome, $admin) = db_query_value("SELECT username, nome, admin FROM utenti WHERE id='$id'");
  $admin = $admin? 'S':'N';
}

$statmsg='';
if (isset($_POST['salva'])) {
  $admin_val = $_POST['admin'] == 'N' ? 0 : 1;
  $q = "UPDATE utenti SET username = '$_POST[username]',
                           nome = '$_POST[nome]',
                           admin = '$admin_val'
          WHERE id = '$_POST[userid]'";
  
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

echo "<p class=titolo>Modifica Utente</p>";

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
    echo "    <input class='center' type='text' name='username' value='$username' required='required' pattern='$pattern_username' autofocus >";
    echo "   </td>";
    echo "   <td>";
    echo "    <div class='help'>$help_username</div>";
    echo "   </td>";
    echo "  </tr>";

    echo "  <tr>";
    echo "   <td class=right' > nome: </td>";
    echo "   <td>";
    echo "    <input class='center' type='text' name='nome' value='$nome' required='required' pattern='$pattern_nome' autofocus >";
    echo "   </td>";
    echo "   <td>";
    echo "    <div class='help'>$help_nome</div>";
    echo "   </td>";
    echo "  </tr>";

    echo "  <tr>";
    echo "   <td class=right' > admin: </td>";
    echo "   <td>";
    echo "    <input class='center' type='text' name='admin' value='$admin' required='required' pattern='$pattern_admin' autofocus >";
    echo "   </td>";
    echo "   <td>";
    echo "    <div class='help' >$help_admin</div>";
    echo "   </td>";
    echo "  </tr>";

    echo "</table>";
    echo "<div id='stato'>$statmsg</div>";


    // bottoni logged
    echo "<table class='buttons'><tr>";
    echo "<td><button class='action orange' type='submit' name='salva' value='salva'>Salva</button>";
    echo "<input type='hidden' name='userid' value='$id'>";
    echo "<button class='action green' type='button' onClick=\"window.location.href='/utenti/utenti.php'\">Annulla</button>";
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

