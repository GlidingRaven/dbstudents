<?php

	require $_SERVER['DOCUMENT_ROOT'].'/config.php';

	require $_SERVER['DOCUMENT_ROOT'].'/loginbox.php';


	$finalsource =	json_decode($_POST['finalsource'], true);
	$finalhelp =	json_decode($_POST['finalhelp'], true);

	$date_day =			$finalhelp["date_day"];
    $date_month =		$finalhelp["date_month"];
    $date_year =		$finalhelp["date_year"];
    $code_source =		$finalhelp["code_source"];
    $code_uz =			$finalhelp["code_UZ"];
	$name_uz =			$finalhelp["name_uz"];
    $url_source =		$finalhelp["url_source"];
    $count_students = 	$finalhelp["count_students"];
    $city_name = 		$finalhelp["city_name"];
    $city_code = 		$finalhelp["city_code"];
    $comment = 			$finalhelp["comment"];
    
    if ((strlen($city_code)==0)or(strlen($city_name)==0)or(strlen($code_source)==0)or(strlen($code_uz)==0)or(strlen($name_uz)==0)or(strlen($url_source)==0)or(strlen($date_day)==0)or(strlen($date_month)==0)or(strlen($date_year)==0)or(strlen($count_students)==0)or($date_day<1)or($date_day>31)or($date_month<1)or($date_month>12)or($date_year<2015)or($date_year>2020)or(strlen($comment)>=200)){echo "Не всё! Как ты смог сделать такую ошибку?";exit();}

    if(count($finalsource)<>$count_students){echo "Число заявленных студентов не равно числу переданных в массиве.";exit();}


    $sqlconnect = mysql_connect($config_user, $config_database, $config_password);
    if (!$sqlconnect) {die('Ошибка соединения: ' . mysql_error());}
    mysql_select_db($config_database);

	$max_of_id_students = mysql_fetch_array(mysql_query("SELECT MAX(`ID`) FROM `students`"));//Нахождение макс. ID студента
	$begin_ID = $max_of_id_students[0] + 1;

	$date_source = date("Y-m-d", mktime(0, 0, 0, $date_month, $date_day, $date_year));



	$ex = mysql_query("UPDATE `campuses` SET count_sources = count_sources + 1 WHERE code_UZ = $code_uz");//Обновляем счётчик сорсов в campuses
	if ($ex==false) {echo "1st eror";exit();}

	$ex = mysql_query("UPDATE `campuses` SET count_students = count_students + $count_students WHERE code_UZ = $code_uz");//Обновляем счётчик студентов в campuses
	if ($ex==false) {echo "2st eror";exit();}

	$ex = mysql_query("UPDATE `fatherland` SET count_students = count_students + $count_students WHERE city_code = $city_code");//Обновляем счётчик студентов в fatherland
	if ($ex==false) {echo "3st eror";exit();}


	$ex = mysql_query("INSERT INTO `sources` (`date`, `code_source`, `code_UZ`, `abb_name_UZ`, `link`, `count_students`, `comment`) VALUES ('$date_source', '$code_source', '$code_uz', '$name_uz', '$url_source', '$count_students', '$comment')");//Добавляем сорс
	if ($ex==false) {echo "4st eror";exit();}

	$bigrequest = 'INSERT INTO `students` (`ID`, `code_source`, `city_name`, `abb_name_UZ`, `city_code`, `code_UZ`, `surname`, `name`, `patronymic`, `sum`, `specialization`) VALUES (\''.$begin_ID.'\', \''.$code_source.'\', \''.$city_name.'\', \''.$name_uz.'\', \''.$city_code.'\', \''.$code_uz.'\', \''.$finalsource[0][1].'\', \''.$finalsource[0][2].'\', \''.$finalsource[0][3].'\', \''.$finalsource[0][4].'\', \''.$finalsource[0][5].'\')';

	for ($i=1; $i < $count_students; $i++) { 
		$ID = $begin_ID + $i;
		$bigrequest .= ', (\''.$ID.'\', \''.$code_source.'\', \''.$city_name.'\', \''.$name_uz.'\', \''.$city_code.'\', \''.$code_uz.'\', \''.$finalsource[$i][1].'\', \''.$finalsource[$i][2].'\', \''.$finalsource[$i][3].'\', \''.$finalsource[$i][4].'\', \''.$finalsource[$i][5].'\')';
	}

	$bigrequest .= ";";

	$ex = mysql_query($bigrequest);//Добавляем всех студентов разом
	if ($ex==false) {echo "3st eror";exit();}

	echo "200";

?>