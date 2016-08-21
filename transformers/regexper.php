<?php

	require $_SERVER['DOCUMENT_ROOT'].'/config.php';

	require $_SERVER['DOCUMENT_ROOT'].'/loginbox.php';


	$regex = $_POST['regexper'];
	if (strlen($regex)==0){		echo("Не заполнено");exit();	}
	if (strlen($regex)>512){	echo("Слишком большой");exit();	}

	$regex = "/".$regex ."/u";

	$fp = fopen('regex.txt', "w");
	fwrite($fp, $regex);
	fclose($fp);
	
	echo "200";
?>