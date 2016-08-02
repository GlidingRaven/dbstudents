<?php
	if ($_COOKIE["passer"]<>"325373c671bd18c9c526be384516c5da") {
		echo("403 Forbidden");
		exit();
	}

	$sqlconnect = mysql_connect('localhost', 'rainadmin_exp', 'OS8A83M3DUAO');
	mysql_select_db('rainadmin_exp');

	$city_code = intval($_POST['city_code']);
	$full_name_uz = mysql_real_escape_string($_POST['full_name_uz']);
	$abb_name_uz = mysql_real_escape_string($_POST['abb_name_uz']);
	$url_site = mysql_real_escape_string($_POST['url_site']);
	if (($city_code==0)or(strlen($full_name_uz)==0)or(strlen($abb_name_uz)==0)or(strlen($url_site)==0))
		{echo("Неполное заполнение или неверный формат");exit();}//Всё ли есть?

	$report = mysql_query("SELECT * FROM `fatherland` WHERE `city_code` = '$city_code'");//Проверка на существование города с таким кодом
	$sql_rows = mysql_num_rows($report);
	if ($sql_rows<>1){echo("Такого города нет");exit();}
	$report = mysql_query("SELECT * FROM `campuses` WHERE `abb_name_UZ` LIKE '$abb_name_uz'");//Проверка на совпадение по краткому названию
	$sql_rows = mysql_num_rows($report);
	if ($sql_rows<>0){echo("Повторение сокращенного названия УЗ");exit();}

	$max_of_code_uz = 0;
	$max_of_code_uz = mysql_fetch_array(mysql_query("SELECT MAX(`code_UZ`) FROM `campuses`"));//Нахождение макс. номера

	$code_uz = $max_of_code_uz[0] + 1;
	mysql_query("UPDATE `fatherland` SET count_UZ = count_UZ + 1 WHERE city_code = $city_code");
	mysql_query("INSERT INTO `campuses` (`city_code`, `full_name_UZ`, `abb_name_UZ`, `code_UZ`, `count_sources`, `url_site`) VALUES ('$city_code', '$full_name_uz', '$abb_name_uz', '$code_uz', 0, '$url_site')");

	if ($ex==false) {echo "1st eror";exit();}

	echo "200";

	mysql_close($sqlconnect);
?>