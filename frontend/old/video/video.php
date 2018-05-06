<?php
	$path = $_SERVER['DOCUMENT_ROOT'];
	include($path."/sestante/srv/config.php");
	include($path."/sestante/srv/db_helper.php");
	include "$path/sestante/srv/doctype.php";

?>


<html>
<head>
	<?php include($path . "/sestante/srv/head.php"); ?>
	<title>Anagrafe video</title>
<style>
div.container_tabella {height:500px; width:750px; overflow:auto; background:#EEEEEE}
table.tabella { margin:0;}
table tr td { border: solid 1px black; padding:4px; vertical-align:top;}
td.right { text-align:right;}
#crea {margin:0 0 0 50px;}
</style>

</head>
<body>

	<?php include($path . "/sestante/srv/header.php"); ?>
    
    <?php 
		connetti_db();
		$q = "SELECT idvideo, ip, descrizione, generatore
			  FROM video ORDER BY id";
		$videos = db_query_list($q);
	?>
	
	
	<p class="titolo">Gestione dei Video</p>
	
	<div class='container_tabella generic'>
	<table class="tabella">
		<tr style="background-color:silver; font-weight:bold; text-align:center;">
			<td>idvideo</td>
			<td>ip</td>
			<td>descrizione</td>
<!--			<th>generatore</th> -->
			<td colspan='2'>Azione</td>
		</tr>
    <?php 
		foreach($videos as $vid) {
			echo "<tr> \n";
				echo "<td>$vid[0]</td><td>$vid[1]</td>";
				echo "<td><div style='width:200px; word-wrap: break-word'>$vid[2]</div></td>";
				echo "<form method='POST' action='video_edit.php'>";
//				echo "<input type='hidden' name='file' value='/sestante/video/video.php'>";
				echo "<input type='hidden' name='idvideo' value='$vid[0]'>";
				echo "<td><button class='action orange' type='submit' name='file' value='video.php'>Modifica</button></td></form>";
                echo "<form method='POST' action='video_elimina.php'><td>";
				echo "<input type='hidden' name='idvideo' value='$vid[0]'>";
				echo "<button class='action red' type ='submit' name='file' value='video.php'>Elimina</button></td></form>";
			echo"</tr>";
		}

/*
echo "<pre>";
print_r($_POST);
echo "</pre>";
*/

		?>
	</table></div><br>
	<button class='action orange' id='crea' type='button' onClick="location.href='video_crea.php'">Crea Nuovo Video</button>
	<br><br>

    <p id="debug"></p>
    
    <?php include($path . "/sestante/srv/footer.php");  ?>
</body>
</html>
