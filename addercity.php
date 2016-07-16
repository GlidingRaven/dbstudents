<?php
	if ($_COOKIE["passer"]<>"325373c671bd18c9c526be384516c5da") {
	  echo("403 Forbidden" );
	  exit();
	}
	
	$sqlconnect = mysql_connect('localhost', 'rainadmin_exp', 'OS8A83M3DUAO');
	mysql_select_db('rainadmin_exp');

	$city = mysql_real_escape_string($_POST['city']);

	if (strlen($city)==0){echo("Введи город");exit();}//Всё ли есть?

	$report = mysql_query("SELECT * FROM `fatherland` WHERE `city_name` = '$city'");//Проверка на существование города
    $sql_rows = mysql_num_rows($report);
    if ($sql_rows<>0){echo("Повторение города");exit();}

    $max_of_code = 0;
    $max_of_code = mysql_fetch_array(mysql_query("SELECT MAX(`city_code`) FROM `fatherland`"));//Нахождение макс. номера
	
	$code = $max_of_code[0] + 1;
	mysql_query("INSERT INTO `fatherland` (`city_name`, `city_code`, `count_UZ`) VALUES ('$city', '$code', 0)");
	echo "200";

	mysql_close($sqlconnect);
?>