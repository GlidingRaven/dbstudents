<?php
	$regex = $_POST['regexper'];
	if (strlen($regex)==0){echo("Не заполнено");exit();}//Всё ли есть?

	$needle = '\\';
	$replace = '\\\\';
	$regex = str_replace($needle, $replace, $regex);
	$regex = "/".$regex ."/u";

	$fp = fopen('regex.txt', "w");
	fwrite($fp, $regex);
	fclose($fp);
	

	echo "ok";
?>