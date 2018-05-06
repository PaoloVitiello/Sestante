<?php
$path = $_SERVER['DOCUMENT_ROOT'];
include($path."/sestante/srv/config.php");
include($path."/sestante/srv/db_helper.php");
include "$path/sestante/srv/doctype.php";

echo "<html><head>";
echo "
<style>
button.action {margin:5px 20px 5px 20px;}
i {color:red;}
</style>";
include "$path/sestante/srv/head.php";
echo "<title>Login Form</title> </head> <body>";
include "$path/sestante/srv/header.php";
$statmsg="&nbsp;";
$is_admin="xx";
function print_login_form($msg) {
	$statmsg=$msg;
	echo "<p class=titolo>Login</p>";
	echo "<form id='form1' name='form1' method='post' >";
	echo "<table class='tabella' cellpadding='3' RULES=ROWS FRAME=BOX>";
	foreach ($_POST as $key =>$value){  echo "<input type='hidden' name='$key' value='$value'>";  }
	echo "<tr><td>Username:</td><td><input type='text' name='username' id='username' autofocus /></td></tr>";
	echo "<tr><td>Password:</td><td><input type='password' name='password' id='password' /></td></tr>";
	echo "</table>";
	global $statmsg;
	$statmsg=$msg;// Bottoni Not Logged
	$return_file=isset($_POST[file])?$_POST[file]:"/sestante/home/home.php";
	echo "<table class='buttons'><tr>";
	echo "<td><button class='action orange' type='submit' name='button' id='button' value='Submit'>Login</button>";
	echo "<button class='action green' type='button' onClick=\"window.location.href='$return_file'\">Annulla</button></td></tr>";
	echo "</td></form></tr></table><br>";
// Fine Bottoni Not Logged
}


function print_already_logged() {
  $logged_user=$_SESSION['sess_username'];
  if(isset($_POST['file'])) {
  echo "<form id='nobutton' method='POST' action='$_POST[file]'>";
  foreach ($_POST as $key =>$value){ echo "<input type='hidden' name='$key' value='$value'>"; }
  echo "</form> <script>document.getElementById('nobutton').submit();</script>";
 }
else {
echo "<div class='alert'>Sei autenticato come utente <i>\"$logged_user\"</i></div>";
echo "<table class='buttons'><tr>";
echo "<td style='border:0; padding:0; vertical-align:top;'>";
echo "<form method='POST' action='/sestante/home/home.php'>";
echo "<button class='action green' type='submit' autofocus >Continua</button></form>";
echo "<td><button class='action red' type='button' onclick=\"location.href='/sestante/utenti/logout.php'\">Logout</button></td>";
echo "</td></form></tr></table>";
echo "<script>  document.getElementById('user').innerHTML='Logged User: $logged_user &nbsp;&nbsp;'; </script>";
  }
}


function check_login_data($username, $password) {
  connetti_db();
  $user_safe = mysql_real_escape_string($username);
  $user_in_db = db_query_value("SELECT id, password, admin FROM utenti WHERE username='$user_safe'");
  if (!$user_in_db) {
	print_login_form("Utente non riconosciuto.");
  } else {
	if($user_in_db[1] == md5($password)) {
	  session_regenerate_id();
	  $_SESSION['sess_user_id'] = $user_in_db[0];
	  $_SESSION['sess_username'] = $user_safe;
	  $_SESSION['sess_is_admin'] = $user_in_db[2];
	  session_write_close();
	  $is_admin=$_SESSION['sess_is_admin'];
	  print_already_logged();
	} else {
	  print_login_form("Password non valida.");
	}
  }
}


// this is main

session_start();
if (isset($_SESSION['sess_user_id'])) {
  print_already_logged();
} else {
  if (isset($_POST['username']) && isset($_POST['password'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	check_login_data($username, $password);
  } else {
	print_login_form("&nbsp;");
  }
}


echo "<div class='stato'>$statmsg</div><br>";
echo "<!-- Content End -->";
include "$path/sestante/srv/footer.php";
echo "</BODY></HTML>";

/*
echo "<pre>";
print_r($_POST);
echo "</pre";
*/

?>