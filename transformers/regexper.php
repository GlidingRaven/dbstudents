<?php

	////Единый блок авторизации
	$password = preg_replace("/[^A-Za-z\d]/u", "", $_COOKIE["pass"]); // Берём куки и фильтруем
	$hash1 = md5($password);			// Хешируем
	$salt = 'sjkGbLklJa1sLkpN';			// Соль
	$saltedHash = md5($hash1 . $salt);	// Складываем старый хеш с солью и пропускаем через функцию md5()
	if ($saltedHash <> '56e1a81b86f358933a1ba6af32f57c86') {	echo "Access Denited.";exit();	}


	$regex = $_POST['regexper'];
	if (strlen($regex)==0){		echo("Не заполнено");exit();	}
	if (strlen($regex)>512){	echo("Слишком большой");exit();	}

	$regex = "/".$regex ."/u";

	$fp = fopen('regex.txt', "w");
	fwrite($fp, $regex);
	fclose($fp);
	
	echo "200";
?>