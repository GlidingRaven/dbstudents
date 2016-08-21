<?php

	require $_SERVER['DOCUMENT_ROOT'].'/config.php';

	require $_SERVER['DOCUMENT_ROOT'].'/loginbox.php';


	$city = preg_replace("/[^А-Яа-яЁё\-]/u", "", $_POST['city']);			// Берём куки и фильтруем
	if (strlen($city) == 0) { echo ("Введи название города"); exit(); }


    $sqlconnect = mysql_connect($config_user, $config_database, $config_password);
    if (!$sqlconnect) {die('Ошибка соединения: ' . mysql_error());}
    mysql_select_db($config_database);

	$report   = mysql_query("SELECT * FROM `fatherland` WHERE `city_name` = '$city'"); //Проверка на существование города
	$sql_rows = mysql_num_rows($report);
	if ($sql_rows <> 0) {	echo ("Повторение города");exit();	}

	$max_of_code = 0;
	$max_of_code = mysql_fetch_array(mysql_query("SELECT MAX(`city_code`) FROM `fatherland`")); //Нахождение макс. номера
	$code = $max_of_code[0] + 1;

	mysql_query("INSERT INTO `fatherland` (`city_name`, `city_code`, `count_UZ`) VALUES ('$city', '$code', 0)");
	echo "200";
	
?>