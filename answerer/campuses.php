<?php

    $config = parse_ini_file("/home/rainadmin/openstudents.ru/config.ini");

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


    $sqlconnect = mysql_connect($config[user], $config[database], $config[password]);
    if (!$sqlconnect) {die('Ошибка соединения: ' . mysql_error());}
    mysql_select_db($config[database]);

    $report = mysql_query("SELECT * FROM `campuses` ORDER BY count_students DESC");

    $count_uz = mysql_num_rows($report);
    $count_students = mysql_query("SELECT SUM(count_students) FROM campuses");
    $count_students = mysql_fetch_array($count_students);
    $count_students = $count_students[0];

    $title = "Open Students | ВУЗы";
    $description = "Open students – это инновационный сервис по поиску и хранению информации о студентах российских ВУЗов. Структурированный архив приказов о зачислении в Российские ВУЗы. Предназначен для хранения информации о студентах. Списки сортируются по дате издания, учебному заведению и городу.";
    $keywords = "студенты, вузы, зачисление, приказы, абитуриенты, списки, образование, FAQ, рейтинг, база данных, архив, ВУЗ, сервис";

    $title = preg_replace('/\s/u','%20',$title);$description = preg_replace('/\s/u','%20',$description);$keywords = preg_replace('/\s/u','%20',$keywords);$a=file_get_contents("http://openstudents.ru/templates/header.php?title=".$title."&description=".$description."&keywords=".$keywords);echo ($a);

    echo '
            <div class="collapse navbar-collapse">
              <ul class="nav navbar-nav">
                <li class="active"><a href="#">ВУЗы</a></li>
              </ul>
            </div>

          </div>
      </div>

      <div id="page_content">
    ';


    echo '
        <h1>ВУЗы</h1>
        <h3>В базу данных занёсено '.$count_uz.' '.getNumEnding($count_uz, array('ВУЗ', 'ВУЗа', 'ВУЗов')).
        ', а это '.$count_students.' '.getNumEnding($count_students, array('студент', 'студента', 'студентов')).'</h3>';
    if ($count_uz <> 0) {
        echo '
            <table class="table table-striped">
              <thead><tr><th>#</th><th>Название</th><th>Число приказов</th><th>Число студентов</th></thead>
              <tbody>';

        for($i=1;$i<=$count_uz;$i++) {
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

?>