<?php
	if ($_COOKIE["passer"]<>"325373c671bd18c9c526be384516c5da") {
	  echo("403 Forbidden");
	  exit();
	}
	$regex = $_POST['regexper'];
	if (strlen($regex)==0){echo("Не заполнено | is not filled");exit();}
	if (strlen($regex)>512){echo("Слишком большой | too big");exit();}

	//$needle = '\\';
	//$replace = '\\\\';
	//$regex = str_replace($needle, $replace, $regex);
	$regex = "/".$regex ."/u";

	$fp = fopen('regex.txt', "w");
	fwrite($fp, $regex);
	fclose($fp);
	
	echo "200";
?>