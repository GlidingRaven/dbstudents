<?php

/**
 * Функция возвращает окончание для множественного числа слова на основании числа и массива окончаний
 * param  $number Integer Число на основе которого нужно сформировать окончание
 * param  $endingsArray  Array Массив слов или окончаний для чисел (1, 4, 5),
 *         например array('яблоко', 'яблока', 'яблок')
 * return String
 */
function getNumEnding($number, $endingArray)
{
    $number = $number % 100;
    if ($number>=11 && $number<=19) {
        $ending=$endingArray[2];
    }
    else {
        $i = $number % 10;
        switch ($i)
        {
            case (1): $ending = $endingArray[0]; break;
            case (2):
            case (3):
            case (4): $ending = $endingArray[1]; break;
            default: $ending=$endingArray[2];
        }
    }
    return $ending;
}

$surname = $_POST['surname'];
$name = $_POST['name'];
$patronymic = $_POST['patronymic'];
$city = $_POST['city'];
$vuz = $_POST['vuz'];
$specialization = $_POST['specialization'];
$from = $_POST['from'];
$to = $_POST['to'];
$page = $_POST['page'];

$surname = preg_replace("/[^А-Яа-яЁё]/u", "", $surname);
$name = preg_replace("/[^А-Яа-яЁё]/u", "", $name);
$patronymic = preg_replace("/[^А-Яа-яЁё]/u", "", $patronymic);
$city = preg_replace("/[^А-Яа-яЁё]/u", "", $city);
$vuz = preg_replace("/[^А-Яа-яЁё]/u", "", $vuz);
$specialization = preg_replace("/[^\d\.]/u", "", $specialization);
$from = preg_replace("/[^\d]/u", "", $from);
$to = preg_replace("/[^\d]/u", "", $to);
$page = preg_replace("/[^\d]/u", "", $page);

$count_input_data = 0;
$sqlending = "";//Для формирования sql запроса

if (strlen($surname)>0) {
	$sqlending .= " `surname` LIKE '".$surname."'";
	$count_input_data++;
}

if (strlen($name)>0) {
	if (strlen($sqlending)>0) {$sqlending .= " AND";}
	$sqlending .= " `name` LIKE '".$name."'";
	$count_input_data++;
}

if (strlen($patronymic)>0) {
	if (strlen($sqlending)>0) {$sqlending .= " AND";}
	$sqlending .= " `patronymic` LIKE '".$patronymic."'";
	$count_input_data++;
}

if (strlen($city)>0) {
	if (strlen($sqlending)>0) {$sqlending .= " AND";}
	$sqlending .= " `city_name` LIKE '".$city."'";
	$count_input_data++;
}

if (strlen($vuz)>0) {
	if (strlen($sqlending)>0) {$sqlending .= " AND";}
	$sqlending .= " `abb_name_UZ` LIKE '".$vuz."'";
	$count_input_data++;
}

if (strlen($specialization)>0) {
	if (strlen($sqlending)>0) {$sqlending .= " AND";}
	$sqlending .= " `specialization` LIKE '".$specialization."'";
	$count_input_data++;
}

//Блок логики поиска баллов между/больше/меньше заданных значений
if ((strlen($from)>0)and(strlen($to)>0)) {
	if (strlen($sqlending)>0) {$sqlending .= " AND";}
	if ($from==$to) { $sqlending .= " `sum` = ".$from; $count_input_data++; }
	if ($from<$to) { $sqlending .= " `sum` BETWEEN ".$from." AND ".$to; $count_input_data++; }
	if ($from>$to) { $sqlending .= " `sum` BETWEEN ".$to." AND ".$from; $count_input_data++; }
}
elseif ((strlen($from)>0)and(strlen($to)==0)) {
	if (strlen($sqlending)>0) {$sqlending .= " AND";}
	$sqlending .= " `sum` >= ".$from;
	$count_input_data++;
}
elseif ((strlen($from)==0)and(strlen($to)>0)) {
	if (strlen($sqlending)>0) {$sqlending .= " AND";}
	$sqlending .= " `sum` <= ".$to;
	$count_input_data++;
}


if ($count_input_data==0) {
	echo "Данные не введены";
	exit();
}

$sqlconnect = mysql_connect('localhost', 'rainadmin_exp', 'OS8A83M3DUAO');
mysql_select_db('rainadmin_exp');

//Находим количество строк, отвечающих запросу
$report = mysql_query("SELECT COUNT(*) FROM `students` WHERE".$sqlending);
$report = mysql_fetch_array($report);
$count_found = $report[0];

if ($count_found == 0) { echo "По данному запросу ничего не найдено"; exit(); }

$a=file_get_contents("http://openstudents.ru/templates/search.php");
echo ($a);

//А теперь полноценный запрос
$report = mysql_query("SELECT * FROM `students` WHERE".$sqlending);

//Менеджер страниц
if (strlen($page)==0) {$page = 1;}


echo '<div class="alert alert-success">
        <strong>'.$count_found.' </strong>'.getNumEnding($count_found, array('результат', 'результата', 'результатов')).'
      </div><table class="table table-striped">
      <thead><tr><th>#</th><th>Город</th><th>ВУЗ</th><th>Приказ</th><th>Фамилия</th><th>Имя</th><th>Отчёство</th><th>Сумма</th><th>Специальность</th></tr></thead>
      <tbody>';
for($i=1;$i<=$count_found;$i++) {
        $arr = mysql_fetch_array($report);
        if ($arr[sum]==555) {$sum = "б/э";} else {$sum = $arr[sum];}//Правильный вывод суммы баллов
        echo "<tr><td>".$i.
        '</td><td><a href="/ci/'.$arr[city_code].'">'.$arr[city_name].
        '</a></td><td><a href="/uz/'.$arr[code_UZ].'">'.$arr[abb_name_UZ].
        '</a></td><td><a href="/or/'.$arr[code_source].'">Приказ '.$arr[code_source].
        '</a></td><td>'.$arr[surname].
        '</td><td>'.$arr[name].
        '</td><td>'.$arr[patronymic].
        '</td><td>'.$sum.
        '</td><td>'.$arr[specialization].
        '</td></tr>';
      }
echo '</tbody>
    </table>';


mysql_close($sqlconnect);

?>