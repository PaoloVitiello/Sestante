<?php
session_start();
error_reporting(E_ALL | E_STRICT);  
ini_set('display_errors',1);  
ini_set('display_startup_errors',1);  
ini_set('log_errors',1);  
ini_set('log_errors_max_len',0);  
ini_set('ignore_repeated_errors',0);  
ini_set('ignore_repeated_source',0);  
ini_set('report_memleaks',1);  
ini_set('track_errors',1);  
ini_set('error_log','/percorso/file/php_error.log'); 
  $path=$_SERVER["DOCUMENT_ROOT"];
  include "$path/sestante/srv/config.php";
  include "$path/sestante/srv/doctype.php";
?>

<HTML>

<HEAD>
<?php include "$path/sestante/srv/head.php"; ?>

<script src="/sestante/srv/filtro.js"></script>
<script src="/sestante/srv/ordina.js"></script>
<script>
function modifica(idpercorso) {
    var url = 'percorsi_edit.php?id='+idpercorso;

    var filtro_id = document.getElementById('flt_id').value;
    if (filtro_id) { url = url + "&flt_id=" + encodeURIComponent(filtro_id); }

    var filtro_attivo = document.getElementById('flt_attivo').value;
    if (filtro_attivo) { url = url + "&flt_attivo=" + encodeURIComponent(filtro_attivo); }

    var filtro_videowall = document.getElementById('flt_videowall').value;
    if (filtro_videowall) { url = url + "&flt_videowall=" + encodeURIComponent(filtro_videowall); }

    var filtro_ascensori = document.getElementById('flt_ascensori').value;
    if (filtro_ascensori) { url = url + "&flt_ascensori=" + encodeURIComponent(filtro_ascensori); }

    var filtro_touch = document.getElementById('flt_touch').value;
    if (filtro_touch) { url = url + "&flt_touch=" + encodeURIComponent(filtro_touch); }

    var filtro_reparto = document.getElementById('flt_reparto').value;
    if (filtro_reparto) { url = url + "&flt_reparto=" + encodeURIComponent(filtro_reparto); }

    var filtro_repartoesteso = document.getElementById('flt_repartoesteso').value;
    if (filtro_repartoesteso) { url = url + "&flt_repartoesteso=" + encodeURIComponent(filtro_repartoesteso); }

    var filtro_edificio = document.getElementById('flt_edificio').value;
    if (filtro_edificio) { url = url + "&flt_edificio=" + encodeURIComponent(filtro_edificio); }

    var filtro_piano = document.getElementById('flt_piano').value;
    if (filtro_piano) { url = url + "&flt_piano=" + encodeURIComponent(filtro_piano); }

    var filtro_stanza = document.getElementById('flt_stanza').value;
    if (filtro_stanza) { url = url + "&flt_stanza=" + encodeURIComponent(filtro_stanza); }


    var filtro_percorso = document.getElementById('flt_percorso').value;
    if (filtro_percorso) { url = url + "&flt_percorso=" + encodeURIComponent(filtro_percorso); }
    window.location.href = url;
}

function ripristina_filtri() {
  var filtri = {};
  filtri['flt_id'] = <?php if(isset($_GET['flt_id'])) echo "\"$_GET[flt_id]\""; else echo "\"\"";?>;
  filtri['flt_attivo'] = <?php if(isset($_GET['flt_attivo'])) echo "\"$_GET[flt_attivo]\""; else echo "\"\"";?>;
  filtri['flt_videowall'] = <?php if(isset($_GET['flt_videowall'])) echo "\"$_GET[flt_videowall]\""; else echo "\"\"";?>;
  filtri['flt_ascensori'] = <?php if(isset($_GET['flt_ascensori'])) echo "\"$_GET[flt_ascensori]\""; else echo "\"\"";?>;
  filtri['flt_touch'] = <?php if(isset($_GET['flt_touch'])) echo "\"$_GET[flt_touch]\""; else echo "\"\"";?>;
  filtri['flt_reparto'] = <?php if(isset($_GET['flt_reparto'])) echo "\"$_GET[flt_reparto]\""; else echo "\"\"";?>;
  filtri['flt_repartoesteso'] = <?php if(isset($_GET['flt_repartoesteso'])) echo "\"$_GET[flt_repartoesteso]\""; else echo "\"\"";?>;
  filtri['flt_edificio'] = <?php if(isset($_GET['flt_edificio'])) echo "\"$_GET[flt_edificio]\""; else echo "\"\"";?>;
  filtri['flt_piano'] = <?php if(isset($_GET['flt_piano'])) echo "\"$_GET[flt_piano]\""; else echo "\"\"";?>;
  filtri['flt_stanza'] = <?php if(isset($_GET['flt_stanza'])) echo "\"$_GET[flt_stanza]\""; else echo "\"\"";?>;
  filtri['flt_percorso'] = <?php if(isset($_GET['flt_percorso'])) echo "\"$_GET[flt_percorso]\""; else echo "\"\"";?>;

  for(key in filtri) {
    if(filtri[key]) {
      var element = document.getElementById(key);
      element.value = filtri[key];
      var evt = document.createEvent("HTMLEvents");
      evt.initEvent('input',false, true);
      element.dispatchEvent(evt);
    }
  }
}


</script>

<style>
/* define height and width of scrollable area. Add 16px to width for scrollbar  */
div.tableContainer { 
	clear: both;
	border: 1px solid black;
	height: 485px;
	overflow: auto;
	/*width: 916px*/
}

/* Reset overflow value to hidden for all non-IE browsers. */
html>body div.tableContainer {
	overflow: hidden;
        /*width: 916px*/
}

/* define width of table. IE browsers only                 */
div.tableContainer table {
	float: left;
	/*width: 1000px*/
}

/* define width of table. Add 16px to width for scrollbar.           */
/* All other non-IE browsers.                                        */
html>body div.tableContainer table {
  /*width: 916px*/
}

/* set THEAD element to have block level attributes. All other non-IE browsers            */
/* this enables overflow to work on TBODY element. All other non-IE, non-Mozilla browsers */
html>body thead.fixedHeader tr {
	display: block;
	height:30px;
	font-weight:bold;
width: 1000px;
  min-width: 1000px;
}

/* make the TH elements pretty */
thead.fixedHeader th {
	border: 1px solid black;
	font-weight: bold;
	padding: 3px;
	text-align: left
}

/* make the A elements pretty. makes for nice clickable headers                */
thead.fixedHeader a, thead.fixedHeader a:link, thead.fixedHeader a:visited {
	color: #FFF;
	display: block;
	text-decoration: none;
	width: 100%
}

/* make the A elements pretty. makes for nice clickable headers                */
/* WARNING: swapping the background on hover may cause problems in WinIE 6.x   */
thead.fixedHeader a:hover {
	color: #FFF;
	display: block;
	text-decoration: underline;
	width: 100%
}

/* define the table content to be scrollable                                              */
/* set TBODY element to have block level attributes. All other non-IE browsers            */
/* this enables overflow to work on TBODY element. All other non-IE, non-Mozilla browsers */
/* induced side effect is that child TDs no longer accept width: auto                     */
html>body tbody.scrollContent {
	display: block;
	height: 380px;
	overflow: auto;
	width: 1000px
}

/* make TD elements pretty. Provide alternating classes for striping the table */
/* http://www.alistapart.com/articles/zebratables/                             */
tbody.scrollContent td, tbody.scrollContent tr.normalRow td {
	background: #FFF;
	border: 1px solid gray;
	padding:0 3px 0 5px;
	border-collapse:collapse;
}

tbody.scrollContent tr.alternateRow td {
	background: #EEE;
	border: 1px solid gray;
	padding:0 3px 0 5px;
	border-collapse:collapse;
}

.c1 {min-width:3%;}
.c2 {width:3%;}
.c3 {width:3%;}
.c4 {width:3%;}
.c5 {width:3%;}
.c6 {width:23%;}
.c7 {width:23%;}
.c8 {width:5%;}
.c9 {width:4%;}
.c10 {width:7%;}
.c11 {width:8%;}
.c12 {width:16%;}

table.scrollTable {border-collapse:collapse;

}

input { height:16px; margin:0 0 4px 0; padding:0;
}

thead.fixedHeader tr.titoli th { background:silver;
}
thead.fixedHeader tr.titoli th p { height:20px; margin:0; padding:0;
}

thead.fixedHeader tr.filtro { background:white;
} 

thead.fixedHeader tr.filtro input { width: 80%; } 

thead.fixedHeader tr.sort { margin-top:4px;
} 
thead.fixedHeader tr.sort th { background-color:lightgray; background-image: url(/img/sort.png); background-repeat:no-repeat; background-position: center; background-size: 24px 12px;
} 
thead.fixedHeader tr.sort th p { height:16px; margin:0; padding:0;
}

img.block {display: block; magin-left:auto; margin-right:auto;}


</style>
</HEAD>

<BODY onload='ripristina_filtri()'>
<?php include "$path/sestante/srv/header.php"; ?>

<!-- Content Start -->
<p class="titolo">Gestione dei Percorsi</p>


<?php
  connetti_db();
  $query = 'SELECT id, videowall, ascensori, touch, attivo, reparto, reparto_esteso, edificio, piano, stanza, percorso FROM percorsi ORDER BY reparto ';
  $result = mysql_query($query);
  $row=array();

  while ($riga = mysql_fetch_assoc($result)){
	$row[]=$riga;
    }
?>
	
<div style='margin: 50px 50px 10px 50px; display:inline-block;'>
<div id="tableContainer" class="tableContainer">
<table border="0" cellpadding="0" cellspacing="0" width="100%" class="scrollTable">
<thead class="fixedHeader">
	<tr class="titoli">
			<th class='c1'><p>Id</p></th>
			<th class='c2'><p>Att.</p></th>
                        <th class='c3'><p>VW</p></th>
                        <th class='c4'><p>Asc</p></th>
                        <th class='c5'><p>Tou</p></th>
			<th class='c6'><p>Reparto</p></th>
                        <th class='c7'><p>Reparto esteso</p></th>
			<th class='c8'><p>Edif.</p></th>
			<th class='c9'><p>P.</p></th>
			<th class='c10'><p>Stanza</p></th>
                        <th class='c11'><p>Percorso</p></th>
			<th class='c12'><p>Azione</p></th>
	</tr>
	<tr class="filtro">
		<th class='c1'><input type='text' id='flt_id' class="filtro-input" data-classedafiltrare="row" data-nodofigliodafiltrare='0' placeholder="id" value=''></th>
		<th class='c2'><input type='text' id='flt_attivo' class="filtro-input" data-classedafiltrare="row" data-nodofigliodafiltrare='1' placeholder="Att." value=''></th>
		<th class='c3'><input type='text' id='flt_videowall' class="filtro-input" data-classedafiltrare="row" data-nodofigliodafiltrare='2' placeholder="VWall" value=''></th>
		<th class='c4'><input type='text' id='flt_ascensori' class="filtro-input" data-classedafiltrare="row" data-nodofigliodafiltrare='3' placeholder="Asc." value=''></th>
		<th class='c5'><input type='text' id='flt_touch' class="filtro-input" data-classedafiltrare="row" data-nodofigliodafiltrare='4' placeholder="Asc." value=''></th>
		<th class='c6'><input type='text' id='flt_reparto' class="filtro-input" data-classedafiltrare="row" data-nodofigliodafiltrare='5' placeholder="Reparto" value=''></th>
		<th class='c7'><input type='text' id='flt_repartoesteso' class="filtro-input" data-classedafiltrare="row" data-nodofigliodafiltrare='6' placeholder="Reparto esteso" value=''></th>
		<th class='c8'><input type='text' id='flt_edificio' class="filtro-input" data-classedafiltrare="row" data-nodofigliodafiltrare='7' placeholder="Edif." value=''></th>
		<th class='c9'><input type='text' id='flt_piano' class="filtro-input" data-classedafiltrare="row" data-nodofigliodafiltrare='8' placeholder="P." value=''></th>
		<th class='c10'><input type='text' id='flt_stanza' class="filtro-input" data-classedafiltrare="row" data-nodofigliodafiltrare='9' placeholder="Stanza" value=''></th>
		<th class='c11'><input type='text' id='flt_percorso' class="filtro-input" data-classedafiltrare="row" data-nodofigliodafiltrare='10' placeholder="Percorso" value=''></th>
    <th class='c12'><button class='green' type='button' onclick='reset_filter()'>&larr;</b> Azzera</button> <span class='filtro-counter'><?php echo count($row);?></span></th>
	</tr>
	<tr class="sort">
                <th class='c1'><p class='ordinatori' data-class2order='row' data-child2order='0' data-ordertype='num'>___</p></th>
                <th class='c2'><p class='ordinatori' data-class2order='row' data-child2order='1'>&nbsp;</p></th>
		<th class='c3'><p class='ordinatori' data-class2order='row' data-child2order='2'>&nbsp;</p></th>
		<th class='c4'><p class='ordinatori' data-class2order='row' data-child2order='3'>&nbsp;</p></th>
		<th class='c5'><p class='ordinatori' data-class2order='row' data-child2order='4'>&nbsp;</p></th>
		<th class='c6'><p class='ordinatori' data-class2order='row' data-child2order='5'>&nbsp;</p></th>
		<th class='c7'><p class='ordinatori' data-class2order='row' data-child2order='6'>&nbsp;</p></th>
		<th class='c8'><p class='ordinatori' data-class2order='row' data-child2order='7'>&nbsp;</p></th>
		<th class='c9'><p class='ordinatori' data-class2order='row' data-child2order='8' data-ordertype='num'>&nbsp;</p></th>
		<th class='c10'><p class='ordinatori' data-class2order='row' data-child2order='9'>&nbsp;</p></th>
		<th class='c11'><p class='ordinatori' data-class2order='row' data-child2order='10'>&nbsp;</p></th>
		<th class='c12'><p style='background:silver'>&nbsp;&larr; Sort</p></th>
	</tr>
</thead>
<tbody class="scrollContent">

<?php
foreach($row as $value ) {
	extract($value);
	echo "<tr class='row'>";
	echo "<td class='c1'>$id</td>";
	echo "<td class='c2'>$attivo</td>";
	echo "<td class='c3'>$videowall</td>";
	echo "<td class='c4'>$ascensori</td>";
	echo "<td class='c5'>$touch</td>";
	echo "<td class='c6'>$reparto</td>";
	echo "<td class='c7'>$reparto_esteso</td>";
	echo "<td class='c8'>$edificio</td>";
	echo "<td class='c9'>$piano</td>";
	echo "<td class='c10'>$stanza</td>";
	echo "<td class='c11'>$percorso</td>";
	echo "<td class='c12'><button class='action orange' onclick=\"modifica($id)\">Modifica</button>&nbsp;&nbsp;<button class='action red' onclick=\"window.location.href='percorsi_elimina.php?id=$id'\">Elimina</button></td>";
	echo "</tr>";
	}
?>
</tbody>
</table>
</div></div>

<div style="margin-left:50px;">
<button class='action orange bottom' onClick="location.href='percorsi_crea.php'">Crea Nuovo Percorso</button>
<button class='action green bottom' onClick="location.href='esporta_csv.php'">Esporta come CSV</button>
</div>

<br>

<!-- Content End -->
<?php include "$path/sestante/srv/footer.php"; ?>
</BODY>
</HTML>
