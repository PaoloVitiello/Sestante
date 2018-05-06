
<html>
<head></head>
<body>bla bla>
<?php
//$pp = header("Content-Type: image/gif");
if (!extension_loaded('gd')) {
        dl('php_gd2.dll');
}

$campo=imagecreatefromgif("campo_calcio.gif");

$maglia_1=imagecreatefromgif("maglia_1.gif");
imagecopy($campo,$maglia_1,10,10,0,0,imagesx($maglia_1),imagesy($maglia_1));

$maglia_2=imagecreatefromgif("maglia_2.gif");
imagecopy($campo,$maglia_2,20,20,0,0,imagesx($maglia_2),imagesy($maglia_2));


$im = imagegif($campo, "campo_calcio.gif");


?>
</body>
</html>