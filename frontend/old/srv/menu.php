<?php
if(!isset($_SESSION)) session_start();
$logged=false;
if(isset($_SESSION['sess_username'])) { $logged=true; $user=$_SESSION['sess_username'];}
?>

<div id="drop-menu">
  <span id="margin">&nbsp;</span>
  <ul id="menu">
    <li> <a href="/sestante/home/home.php">Home</a> </li>
    <li> <a href="#">Display</a>
      <ul>
        <li> <a href="/sestante/videowall/videowall.php">VideoWall</a> </li>
        <li> <a href="/sestante/ascensori/ascensori.php">Ascensori</a> </li>
      </ul>
    </li>
    <li> <a href="#">Configurazione</a>
      <ul>
        <li> <a href="/sestante/sistema/sistema.php">Sistema</a> </li>
        <li> <a href="#">Video</a> 
		  <ul>
		    <li> <a href="/sestante/video/video.php">Gestione Video</a> </li>
		    <li> <a href="/sestante/sistema/aggiorna.php">Aggiorna Video</a> </li>
		  </ul>
		</li>
        <li> <a href="/sestante/touch/touch.php">Touchscreen</a> </li>
        <li> <a href="/sestante/percorsi/percorsi.php">Percorsi</a> </li>
      </ul>
	</li>
    <li> <a href="/sestante/utenti/utenti.php">Utenti</a> </li>
    <li>
      <ul>
        <li> <a href="/sestante/utenti/login.php">Login</a> </li>
        <li> <a href="/sestante/utenti/logout.php">Logout</a> </li>
        <li> <a href="/sestante/utenti/utenti_cambia_password.php">Cambia password</a> </li>
      </ul>
	<a href="#">Login</a> </li>
  </ul>
  <span id='user' style='font-weight:bold; font-size:14px; color:red; '> &nbsp;</span>
</div>
<?php
if($logged){
echo "<script>  document.getElementById('user').innerHTML='Logged User: $user &nbsp;&nbsp;'; </script>";}

?>
 
