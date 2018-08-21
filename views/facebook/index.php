<!DOCTYPE html>

<html lang="en-US">
<head>
    
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <script type="text/javascript" src="jquery-2.1.0.min.js"></script>
    <script type="text/javascript" src="map.js"></script>
</head>
<body>
<?php 
    $url='http://www.cobacam.edu.mx/centros/cobertura';
    $ch = curl_init();
	$timeout = 5;
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	$data = curl_exec($ch);
	curl_close($ch);
    echo $data;
 ?>
 </body>
 </html>