<?php
session_start();
$logged=false;
if(isset($_SESSION['sess_username'])) { $logged=true; $username=$_SESSION['sess_username']; }
if(isset($_SESSION['sess_is_admin'])) { $is_admin=$_SESSION['sess_is_admin']; }

$username="Paolo";

$path=$_SERVER["DOCUMENT_ROOT"];
include "$path/sestante/srv/config.php";
include "$path/sestante/srv/db_helper.php";
include "$path/sestante/srv/login_check.php";
include "$path/sestante/srv/doctype.php";


echo "<HTML><HEAD>";
include "$path/sestante/srv/head.php";
echo "</HEAD><BODY>";
include "$path/sestante/srv/header.php";

echo
"<!-- Content Start -->
<p class='titolo'>Gestione Utenti</p>";
//echo "<div class='contenuto'>";

if ($logged) {
  if ($is_admin) {

    connetti_db();
    $q = "SELECT id, username, nome, admin FROM utenti ORDER BY id";
    $utenti = db_query_list($q);
    
    echo "<table class='tabella'>";
    echo "<tr style='background-color:silver; font-weight:bold; text-align:center;'>";
    echo "<td>username</td> <td>nome</td> <td>admin</td> <td colspan='3'>Azione</td>";
    echo "</tr>";

    foreach ($utenti as $utente) {
      $admin_flag = $utente[3] ? 'S' : 'N';
      echo "<tr>";
      echo "<td>$utente[1]</td>"; // username
      echo "<td>$utente[2]</td>"; // nome
      echo "<td>$admin_flag</td>";
      
      echo " <form method='POST' action='utenti_edit.php'>";
      echo "  <input type='hidden' name='userid' value='$utente[0]'>";
      echo "  <td>";
      echo "   <button class='action orange' type='submit' name='file' value='utenti.php'>Modifica</button>";
      echo "  </td>";
      echo " </form>";

      echo " <form method='POST' action='utenti_cambia_password.php'>";
      echo "  <input type='hidden' name='userid' value='$utente[0]'>";
      echo "  <td> <button class='action orange' type='submit' name='file' value='utenti.php'>Cambia password</button> </td>";
      echo " </form>";
      
      echo " <form method='POST' action='utenti_elimina.php'>";
      echo "  <input type='hidden' name='userid' value='$utente[0]'>";
      echo "  <td>";
      echo "  <button class='action red' type ='submit' name='file' value='utenti.php'>Elimina</button>";
      echo "  </td>";
      echo " </form>";

      echo "</tr>";
    }

    echo "</table>";
    echo "<div class='generic'><button class='action orange' id='crea' type='button' onClick=\"location.href='utenti_crea.php'\">";
    echo "Crea Nuovo Utente";
    echo "</button></div><br><br>";

  } else {

    echo "<div class='alert'>";
    echo "La gestione utenti &egrave; riservata agli utenti amministratori.";
    echo "</div><br>";
    echo "<div class='generic'><button class='action green' type='button' onClick=\"window.location.href='/sestante/home/home.php'\">Annulla</button></div><br>";

  }
}
else {
  $phpfile= $_SERVER['PHP_SELF'];
  echo "<div class='alert'> Per accedere a questa funzione e' necessario autenticarsi</div>";
  echo "<table class='buttons'><tr>";
  echo "<form method='POST' action='/sestante/utenti/login.php'>";
  echo "<td><input type='hidden' name='user' value='$username'>";
  echo "<td><input type='hidden' name='level' value='$level'>";
  echo "<button class='action green' type'submit' name='file' value='$phpfile' autofocus >Login</button>";
  echo "</td></form>";
  echo "<form>";
  echo "<td><button class='action green' type='button' onClick=\"location.href='/sestante/home/home.php'\">Annulla</button>";
  echo "</td></form></tr></table><br>";
  }
//echo "</div> <!-- Content End -->";
include "$path/sestante/srv/footer.php";
echo "</BODY></HTML>";
?>