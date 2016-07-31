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
if (($number==0)or($number>50)) {
    echo "Inadequate data";
    exit();
}

$sqlconnect = mysql_connect('localhost', 'rainadmin_exp', 'OS8A83M3DUAO');
mysql_select_db('rainadmin_exp');

$report = mysql_query("SELECT * FROM `fatherland` WHERE `city_code` = ".$number);
$report = mysql_fetch_array($report);

if ($report == false) {
    echo "This source does not exist";
    exit();
}

$city_name = $report[city_name];
$city_code = $report[city_code];
$count_UZ = $report[count_UZ];
$count_students = $report[count_students];

//$city = mysql_fetch_array(mysql_query("SELECT * FROM `fatherland` WHERE `city_code` LIKE '$city_code'"));//Нахождение названия города
//$city_name = $city[city_name];

$report = mysql_query("SELECT * FROM `campuses` WHERE `city_code` = ".$city_code);

if ($report == false) {
    echo "This source does not exist [2]";
    exit();
}

$title = "Open Students | ".$city_name;
$description = "Open students – это инновационный сервис по поиску и хранению информации о студентах российских ВУЗов. Структурированный архив приказов о зачислении в Российские ВУЗы. Предназначен для хранения информации о студентах. Списки сортируются по дате издания, учебному заведению и городу.";
$keywords = $city_name.", студенты, зачисление, приказы, абитуриенты, списки, образование, FAQ, рейтинг, база данных, архив, ВУЗ, сервис";

$title = preg_replace('/\s/u','%20',$title);$description = preg_replace('/\s/u','%20',$description);$keywords = preg_replace('/\s/u','%20',$keywords);$a=file_get_contents("http://openstudents.ru/templates/header.php?title=".$title."&description=".$description."&keywords=".$keywords);echo ($a);

echo '
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">'.$city_name.'</a></li>
          </ul>
        </div>

      </div>
  </div>

  <div id="page_content">
';


echo '
    <h1>'.$city_name.'</h1>
    <h3>В этом городе индексированно '.$count_UZ.' '.getNumEnding($count_UZ, array('ВУЗов', 'ВУЗа', 'ВУЗов')).
    ', а это '.$count_students.' '.getNumEnding($count_students, array('студент', 'студента', 'студентов')).'</h3>';
if ($count_UZ <> 0) {
    echo '
        <table class="table table-striped">
          <thead><tr><th>#</th><th>Название</th><th>Число приказов</th><th>Число студентов</th></thead>
          <tbody>';

    for($i=1;$i<=$count_UZ;$i++) {
            $arr = mysql_fetch_array($report);
            echo "<tr><td>".$i.
            '</td><td><a href="/uz/'.$arr[code_UZ].'">'.$arr[abb_name_UZ].
            '</a></td><td>'.$arr[count_sources].
            '</td><td>'.$arr[count_students].
            '</td></tr>';
          }
    echo '</tbody>
        </table>';
}

$a=file_get_contents("http://openstudents.ru/templates/footer.php");
echo ($a);

mysql_close($sqlconnect);

?>