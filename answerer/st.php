<?php

$surname = $_POST['surname'];
$name = $_POST['name'];
$patronymic = $_POST['patronymic'];

$count_input_data = 0;

if (strlen($surname)>0) {
	$surname = preg_replace("/[^А-Яа-яЁё]/u", "", $surname);
	$count_input_data++;
}

if (strlen($name)>0) {
	$name = preg_replace("/[^А-Яа-яЁё]/u", "", $name);
	$count_input_data++;
}

if (strlen($patronymic)>0) {
	$patronymic = preg_replace("/[^А-Яа-яЁё]/u", "", $patronymic);
	$count_input_data++;
}


if ($count_input_data==0) {
	$a=file_get_contents("http://openstudents.ru/templates/search.php");
	echo ($a);
	echo "<p>Ничего не введено</p><br>";
	exit();
}

echo "<p>".$surname." ".$name." ".$patronymic."</p>";
echo "<p>".$count_input_data."</p>";
$a=file_get_contents("http://openstudents.ru/templates/search.php");
echo ($a);



?>