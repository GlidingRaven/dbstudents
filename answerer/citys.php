<?php

    require $_SERVER['DOCUMENT_ROOT'].'/config.php';

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

    $sqlconnect = mysql_connect($config_user, $config_database, $config_password);
    if (!$sqlconnect) {die('Ошибка соединения: ' . mysql_error());}
    mysql_select_db($config_database);

    $report = mysql_query("SELECT * FROM `fatherland` ORDER BY count_students DESC");

    $count_citys = mysql_num_rows($report);

    $count_students = mysql_query("SELECT SUM(count_students) FROM fatherland");
    $count_students = mysql_fetch_array($count_students);
    $count_students = $count_students[0];

    $title = "Города";
    $keywords = "города";

    $title = preg_replace('/\s/u','%20',$title);$keywords = preg_replace('/\s/u','%20',$keywords);$a=file_get_contents("http://openstudents.ru/templates/header.php?title=$title&keywords=$keywords");echo ($a);

    echo '
            <div class="collapse navbar-collapse">
              <ul class="nav navbar-nav">
                <li class="active"><a href="#">Города</a></li>
              </ul>
            </div>

          </div>
      </div>

      <div id="page_content">
    ';


    echo "
        <h1>Города</h1>
        <h3>В базу данных занёсено $count_citys ".getNumEnding($count_citys, array('город', 'города', 'городов')).
        ", а это $count_students ".getNumEnding($count_students, array('студент', 'студента', 'студентов'))."</h3>";
    if ($count_citys <> 0) {
        echo '
            <table class="table table-striped">
              <thead><tr><th>#</th><th>Город</th><th>Число ВУЗов</th><th>Число студентов</th></thead>
              <tbody>';

        for($i=1;$i<=$count_citys;$i++) {
                $arr = mysql_fetch_array($report);
                echo "<tr><td>".$i.
                '</td><td><a href="/ci/'.$arr[city_code].'">'.$arr[city_name].
                '</a></td><td>'.$arr[count_UZ].
                '</td><td>'.$arr[count_students].
                '</td></tr>';
              }
        echo '</tbody>
            </table>';
    }

    $a=file_get_contents("http://openstudents.ru/templates/footer.php");
    echo ($a);

?>