<?php
	//Для работы требуется config.php
	$password = preg_replace("/[^A-Za-z\d]/u", "", $_COOKIE["pass"]); // Берём куки и фильтруем
	$hash1 = md5($password);			// Хешируем
	$salt = $config_salt;				// Соль
	$saltedHash = md5($hash1 . $salt);	// Складываем старый хеш с солью и пропускаем через функцию md5()
	if ($saltedHash <> '3a38907753c8f7340a8b4bcaf9490ce7') {	echo "Access Denited.";exit();	}
?>