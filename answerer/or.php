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

$number = preg_replace("/[^\d]/u", "", $_GET['number']);
if (($number==0)or($number>100000)) {
	echo "Inadequate data";
	exit();
}

$sqlconnect = mysql_connect('localhost', 'rainadmin_exp', 'OS8A83M3DUAO');
mysql_select_db('rainadmin_exp');

$report = mysql_query("SELECT * FROM `sources` WHERE `code_source` = ".$number);
$report = mysql_fetch_array($report);

if ($report == false) {
	echo "This source does not exist";
	exit();
}

$date = $report[date];
$code_source = $report[code_source];
$code_UZ = $report[code_UZ];
$abb_name_UZ = $report[abb_name_UZ];
$link = $report[link];
$count_students = $report[count_students];

$report = mysql_query("SELECT * FROM `students` WHERE `code_source` = ".$number);

if ($report == false) {
	echo "This source does not exist [2]";
	exit();
}

$first_student= mysql_fetch_array($report);
$city_name = $first_student[city_name];
$city_code = $first_student[city_code];
$code_UZ = $first_student[code_UZ];

$surname = $first_student[surname];
$name = $first_student[name];
$patronymic = $first_student[patronymic];
$sum = $first_student[sum]; if ($sum==555) {$sum = "б/э";}
$specialization = $first_student[specialization];

$title = "Open Students | Приказ №".$number;
$description = "Open students – это инновационный сервис по поиску и хранению информации об абитуриентах российских ВУЗов. Структурированный архив приказов о зачислении в Российские ВУЗы. Предназначен для хранения информации о студентах. Списки сортируются по дате издания, учебному заведению и городу.";
$keywords = "зачисление, приказы, абитуриенты, списки, образование, FAQ, рейтинг, база данных, архив, ВУЗ, сервис";

$title = preg_replace('/\s/u','%20',$title);$description = preg_replace('/\s/u','%20',$description);$keywords = preg_replace('/\s/u','%20',$keywords);$a=file_get_contents("http://openstudents.ru/templates/header.php?title=".$title."&description=".$description."&keywords=".$keywords);echo ($a);

echo '
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
          	<li><a href="/ci/'.$city_code.'">'.$city_name.'</a></li>
          	<li><a href="/uz/'.$code_UZ.'">'.$abb_name_UZ.'</a></li>
            <li class="active"><a href="#">Приказ №'.$number.'</a></li>
          </ul>
        </div>

      </div>
  </div>

  <div id="page_content">
';

echo '
	<h1>'.$city_name.' / '.$abb_name_UZ.' / Приказ №'.$number.' от '.$date.'</h1>
	<h3>Приказ о зачислении '.$count_students.' '.getNumEnding($count_students, array('студента', 'студентов', 'студентов')).'</h3>
	<h4 class="text-right"><a href="'.$link.'" target="_blank">Ссылка на источник</a></h4>
	<table class="table table-striped">
      <thead><tr><th>#</th><th>Город</th><th>ВУЗ</th><th>Приказ</th><th>Фамилия</th><th>Имя</th><th>Отчёство</th><th>Сумма</th><th>Специальность</th></tr></thead>
      <tbody>';
echo '<tr><td>1</td><td>'.$city_name.'</td><td>'.$abb_name_UZ.'</td><td>Приказ '.$number.'</td><td>'.$surname.'</td><td>'.$name.'</td><td>'.$patronymic.'</td><td>'.$sum.'</td><td>'.$specialization.'</td></tr>';

for($i=2;$i<=$count_students-1;$i++) {
        $arr = mysql_fetch_array($report);
        if ($arr[sum]==555) {$sum = "б/э";} else {$sum = $arr[sum];}//Правильный вывод суммы баллов
        echo "<tr><td>".$i.
        '</td><td>'.$arr[city_name].
        '</td><td>'.$arr[abb_name_UZ].
        '</td><td>Приказ '.$arr[code_source].
        '</td><td>'.$arr[surname].
        '</td><td>'.$arr[name].
        '</td><td>'.$arr[patronymic].
        '</td><td>'.$sum.
        '</td><td>'.$arr[specialization].
        '</td></tr>';
      }
echo '</tbody>
    </table>';


$a=file_get_contents("http://openstudents.ru/templates/footer.php");
echo ($a);

mysql_close($sqlconnect);

?>