<?php

$surname = $_POST['surname'];
$name = $_POST['name'];
$patronymic = $_POST['patronymic'];

$count_input_data = 0;
$sqlending = "";//Для формирования sql запроса

if (strlen($surname)>0) {
	$surname = preg_replace("/[^А-Яа-яЁё]/u", "", $surname);
	$sqlending .= " `surname` LIKE '".$surname."'";
	$count_input_data++;
}

if (strlen($name)>0) {
	$name = preg_replace("/[^А-Яа-яЁё]/u", "", $name);
	if (strlen($sqlending)>0) {$sqlending .= " AND";}
	$sqlending .= " `name` LIKE '".$name."'";
	$count_input_data++;
}

if (strlen($patronymic)>0) {
	$patronymic = preg_replace("/[^А-Яа-яЁё]/u", "", $patronymic);
	if (strlen($sqlending)>0) {$sqlending .= " AND";}
	$sqlending .= " `patronymic` LIKE '".$patronymic."'";
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
echo "<p>SELECT * FROM `students` WHERE".$sqlending."</p>";

$sqlconnect = mysql_connect('localhost', 'rainadmin_exp', 'OS8A83M3DUAO');
mysql_select_db('rainadmin_exp');

$report = mysql_query("SELECT * FROM `students` WHERE".$sqlending);
$sql_rows = mysql_num_rows($report);

if ($sql_rows==0) {
	$a=file_get_contents("http://openstudents.ru/templates/search.php");
	echo ($a);
	echo "<p>Ничего не найдено</p><br>";
	exit();
}

$ending_word = "";if(($sql_rows>1)and($sql_rows<5)){$ending_word = "а";}
echo '<div class="alert alert-success">
        <strong>Найдено</strong> '.$sql_rows.' человек'.$ending_word.'.
      </div><table class="table table-striped">
      <thead><tr><th>#</th><th>Город</th><th>ВУЗ</th><th>Приказ</th><th>Фамилия</th><th>Имя</th><th>Отчёство</th><th>Сумма</th><th>Специальность</th></tr></thead>
      <tbody>';
for($i=1;$i<=$sql_rows;$i++) {
        $arr = mysql_fetch_array($report);
        echo "<tr><td>".$i.
        '</td><td>'.$arr[city_name].
        '</td><td>'.$arr[abb_name_UZ].
        '</td><td>'.$arr[code_source].
        '</td><td>'.$arr[surname].
        '</td><td>'.$arr[name].
        '</td><td>'.$arr[patronymic].
        '</td><td>'.$arr[sum].
        '</td><td>'.$arr[specialization].
        '</td></tr>';
      }
echo '</tbody>
    </table>';


mysql_close($sqlconnect);


$a=file_get_contents("http://openstudents.ru/templates/search.php");
echo ($a);

?>