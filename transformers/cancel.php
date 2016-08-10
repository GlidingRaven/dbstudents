<?php

	$config = parse_ini_file("/home/rainadmin/openstudents.ru/config.ini");

	////Единый блок авторизации
	$password = preg_replace("/[^A-Za-z\d]/u", "", $_COOKIE["pass"]); // Берём куки и фильтруем
	$hash1 = md5($password);			// Хешируем
	$salt = $config[salt];				// Соль
	$saltedHash = md5($hash1 . $salt);	// Складываем старый хеш с солью и пропускаем через функцию md5()
	if ($saltedHash <> '3a38907753c8f7340a8b4bcaf9490ce7') {	echo "Access Denited.";exit();	}


	$del_number = $_POST['del_number'];
	$del_number = preg_replace('/[^\d]/um', "", $del_number);

	$del_pass = $_POST['del_pass'];

    if ((strlen($del_number)==0)or(strlen($del_pass)==0)) {	echo "Введены не все поля";exit();	}
    if (($del_number<=0)or($del_number>2000)) {				echo "Номер приказа неправильный";exit();	}


	////Дублирующий блок аутентификации
	$password = preg_replace("/[^A-Za-z\d]/u", "", $_POST['del_pass']); // Берём куки и фильтруем
	$hash1 = md5($password);			// Хешируем
	$salt = $config[salt_cancel];		// Соль
	$saltedHash = md5($hash1 . $salt);	// Складываем старый хеш с солью и пропускаем через функцию md5()
	if ($saltedHash <> 'ce2bf0fac2983705f2a13d092079f800') {	echo "Пароль неверен";exit();	}


    $sqlconnect = mysql_connect($config[user], $config[database], $config[password]);
    if (!$sqlconnect) {die('Ошибка соединения: ' . mysql_error());}
    mysql_select_db($config[database]);

    $ex = mysql_query("SELECT * FROM `sources` WHERE `code_source` = $del_number");//Находим такой приказ
    if ($ex == false) {	echo "SQL ошибка";exit();	}

    $rez = mysql_fetch_array($ex);
    if ($rez == 0) {	echo "Такого приказа нет";exit();	}

	$count = mysql_num_rows($ex);
	if ($count <> 1) {	echo "Найдено несколько подобных приказов. Запрос брошен. Проверь БД.";exit();	}

	$count_students =	$rez[count_students];
	$code_uz =			$rez[code_UZ];
	if ($count_students == 0) {	echo "Данные недоступны!";exit();	}


	$ex = mysql_query("SELECT * FROM `campuses` WHERE `code_UZ` LIKE '$code_uz'");
	if ($ex == false) {	echo "Ошибка SQL при попытке нахождения города";exit();	}
	$ex = mysql_fetch_array($ex);
	$city_code = $ex[city_code];


	$ex = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM `students` WHERE `code_source` = $del_number"));
	$count_searched = $ex[0];
	if ($count_searched <> $count_students) {echo "Количество студентов в базе не равно количеству заявленных в приказе! Запрос сброшен.";exit();}

						// Ниже начинается "боевой" блок удаления/обновления БД

	$ex = mysql_query("DELETE FROM `students` WHERE `code_source` = $del_number");	//Удаляем студентов
	if ($ex == false) {	echo "Ошибка SQL при попытке удаления студентов. Проверь БД";exit();	}

	$ex = mysql_query("DELETE FROM `sources` WHERE `code_source` = $del_number");	//Трём приказ
	if ($ex == false) {	echo "Ошибка SQL при попытке удаления приказа. Проверь БД";exit();		}




	$ex = mysql_query("UPDATE `campuses` SET count_sources = count_sources - 1 WHERE code_UZ = $code_uz");
	if ($ex==false) {	echo "Ошибка SQL при попытке обновления счётчика сорсов (в таблице ВУЗов)";exit();		}

	$ex = mysql_query("UPDATE `campuses` SET count_students = count_students - $count_students WHERE code_UZ = $code_uz");
	if ($ex==false) {	echo "Ошибка SQL при попытке обновления счётчика студентов (в таблице ВУЗов)";exit();	}

	$ex = mysql_query("UPDATE `fatherland` SET count_students = count_students - $count_students WHERE city_code = $city_code");
	if ($ex==false) {	echo "Ошибка SQL при попытке обновления счётчика студентов (в таблице городов)";exit();	}



	echo "Приказ №$del_number удалён";

?>