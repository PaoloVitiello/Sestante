<?php
$path=$_SERVER["DOCUMENT_ROOT"];
include "$path/sestante/srv/config.php";
include "$path/sestante/srv/login_check.php";
include "$path/sestante/srv/doctype.php";
?>
<HTML>
<HEAD>
<?php include "$path/sestante/srv/head.php"; ?>
<style>
table.home { border:0; margin:50px; cellspacing:50px; border-spacing:50px;}
button.hidden { width:200px; border:0; background-color:DarkOrange; font-size:30px; padding:30px; border-radius: 15px;}
button.hidden:hover {color:red; background:orange; cursor:pointer;}
</style
</HEAD>
<BODY>
<?php include "$path/sestante/srv/header.php"; ?>
<!-- Content Start -->
<table class='home'>
  <tr>
    <td> <button class='hidden' type='button' onclick="location.href='../videowall/videowall.php';"> Videowall </button> </td>
    <td> <button class='hidden' type='button' onclick="location.href='../ascensori/ascensori.php';"> Ascensori </button> </td>
    <td> <button class='hidden' type='button' onclick="location.href='../touch/touch.php';"> Touch </button> </td>
  </tr>
  <tr>
    <td> <button class='hidden' type='button' onclick="location.href='../percorsi/percorsi.php';"> Percorsi </button> </td>
    <td> <button class='hidden' type='button' onclick="location.href='../sistema/sistema.php';"> Sistema </button> </td>
    <td> <button class='hidden' type='button' onclick="location.href='../video/video.php';"> Video </button> </td>
  </tr>
  <tr>
    <td> <button class='hidden' type='button' onclick="location.href='../sistema/aggiorna.php';"> Aggiorna </button> </td>
    <td> <button class='hidden' type='button' onclick="location.href='../utenti/utenti.php';"> Utenti </button> </td>
    <td> <button class='hidden' type='button' onclick="location.href='../utenti/login.php';"> Login </button> </td>
    <!-- <td> <button class='hidden' type='button' onclick="location.href='#';"> Help </button> </td> -->
  </tr>
</table>
<!-- Content End -->
<?php include "$path/sestante/srv/footer.php"; ?>
</BODY>
</HTML>