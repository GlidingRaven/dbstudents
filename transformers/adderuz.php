<?php

	$config = parse_ini_file("/home/rainadmin/openstudents.ru/config.ini");

	////Единый блок авторизации
	$password = preg_replace("/[^A-Za-z\d]/u", "", $_COOKIE["pass"]); // Берём куки и фильтруем
	$hash1 = md5($password);			// Хешируем
	$salt = $config[salt];				// Соль
	$saltedHash = md5($hash1 . $salt);	// Складываем старый хеш с солью и пропускаем через функцию md5()
	if ($saltedHash <> '3a38907753c8f7340a8b4bcaf9490ce7') {	echo "Access Denited.";exit();	}


    $sqlconnect = mysql_connect($config[user], $config[database], $config[password]);
    if (!$sqlconnect) {die('Ошибка соединения: ' . mysql_error());}
    mysql_select_db($config[database]);

	$city_code =	intval($_POST['city_code']);
	$full_name_uz =	preg_replace("/[^А-Яа-яЁё\-\s]/u", "", $_POST['full_name_uz']);
	$abb_name_uz =	preg_replace("/[^А-Яа-яЁё\-]/u", "", $_POST['abb_name_uz']);
	$url_site =		mysql_real_escape_string($_POST['url_site']);
	if (($city_code<=0) or (strlen($full_name_uz)==0) or (strlen($abb_name_uz)==0) or (strlen($url_site)==0))
		{	echo("Неполное заполнение или неверный формат");exit();	}


	//Проверка на существование города с таким кодом
	$report = mysql_query("SELECT * FROM `fatherland` WHERE `city_code` = '$city_code'");
	$sql_rows = mysql_num_rows($report);
	if ($sql_rows <> 1) {	echo("Такого города нет");exit();	}

	//Проверка на совпадение по краткому названию
	$report = mysql_query("SELECT * FROM `campuses` WHERE `abb_name_UZ` LIKE '$abb_name_uz'");
	$sql_rows = mysql_num_rows($report);
	if ($sql_rows<>0) {		echo("Повторение сокращенного названия УЗ");exit();	}

	$max_of_code_uz = 0;	// Нахождение макс. номера
	$max_of_code_uz = mysql_fetch_array(mysql_query("SELECT MAX(`code_UZ`) FROM `campuses`"));

	$code_uz = $max_of_code_uz[0] + 1;	// Обновление счётчика
	$ex = mysql_query("UPDATE `fatherland` SET count_UZ = count_UZ + 1 WHERE city_code = $city_code");

	if ($ex==false) {	echo "1st eror";exit();	}

	//Добавление ВУЗа
	$ex = mysql_query("INSERT INTO `campuses` (`city_code`, `full_name_UZ`, `abb_name_UZ`, `code_UZ`, `count_sources`, `url_site`) VALUES ('$city_code', '$full_name_uz', '$abb_name_uz', '$code_uz', 0, '$url_site')");

	if ($ex==false) {	echo "2st eror";exit();	}

	echo "200";

?>