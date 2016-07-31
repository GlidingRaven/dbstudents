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
if (($number==0)or($number>3500)) {
    echo "Inadequate data";
    exit();
}

$sqlconnect = mysql_connect('localhost', 'rainadmin_exp', 'OS8A83M3DUAO');
mysql_select_db('rainadmin_exp');

$report = mysql_query("SELECT * FROM `campuses` WHERE `code_UZ` = ".$number);
$report = mysql_fetch_array($report);

if ($report == false) {
    echo "This source does not exist";
    exit();
}

$city_code = $report[city_code];
$full_name_UZ = $report[full_name_UZ];
$abb_name_UZ = $report[abb_name_UZ];
$code_UZ = $report[code_UZ];
$count_students = $report[count_students];
$count_sources = $report[count_sources];
$url_site = $report[url_site];

$city = mysql_fetch_array(mysql_query("SELECT * FROM `fatherland` WHERE `city_code` LIKE '$city_code'"));//Нахождение названия города
$city_name = $city[city_name];

$report = mysql_query("SELECT * FROM `sources` WHERE `code_UZ` = ".$code_UZ);

if ($report == false) {
    echo "This source does not exist [2]";
    exit();
}

$title = "Open Students | ".$abb_name_UZ;
$description = "Open students – это инновационный сервис по поиску и хранению информации о студентах российских ВУЗов. Структурированный архив приказов о зачислении в Российские ВУЗы. Предназначен для хранения информации о студентах. Списки сортируются по дате издания, учебному заведению и городу.";
$keywords = $abb_name_UZ.", студенты, зачисление, приказы, абитуриенты, списки, образование, FAQ, рейтинг, база данных, архив, ВУЗ, сервис";

$title = preg_replace('/\s/u','%20',$title);$description = preg_replace('/\s/u','%20',$description);$keywords = preg_replace('/\s/u','%20',$keywords);$a=file_get_contents("http://openstudents.ru/templates/header.php?title=".$title."&description=".$description."&keywords=".$keywords);echo ($a);

echo '
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="/ci/'.$city_code.'">'.$city_name.'</a></li>
            <li class="active"><a href="#">'.$abb_name_UZ.'</a></li>
          </ul>
        </div>

      </div>
  </div>

  <div id="page_content">
';


echo '
    <h1>'.$city_name.' / '.$abb_name_UZ.'</h1>
    <h2>'.$full_name_UZ.'</h2>
    <h3>Индексированно '.$count_sources.' '.getNumEnding($count_sources, array('приказ', 'приказа', 'приказов')).
    ' о зачислении ('.$count_students.' '.getNumEnding($count_students, array('студент', 'студента', 'студентов')).')</h3>
    <h4><a href="'.$url_site.'" target="_blank">Сайт вуза</a></h4>';
if ($count_sources <> 0) {
    echo '
        <table class="table table-striped">
          <thead><tr><th>#</th><th>Номер</th><th>Дата</th><th>Зачислено студентов</th></thead>
          <tbody>';

    for($i=1;$i<=$count_sources;$i++) {
            $arr = mysql_fetch_array($report);
            echo "<tr><td>".$i.
            '</td><td><a href="/or/'.$arr[code_source].'">'.$arr[code_source].
            '</a></td><td>'.$arr[date].
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