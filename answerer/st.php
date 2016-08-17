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

    $surname =          isset($_GET['surname']) ?          strval($_GET['surname']) : '';
    $name =             isset($_GET['name']) ?             strval($_GET['name']) : '';
    $patronymic =       isset($_GET['patronymic']) ?       strval($_GET['patronymic']) : '';
    $city =             isset($_GET['city']) ?             strval($_GET['city']) : '';
    $vuz =              isset($_GET['vuz']) ?              strval($_GET['vuz']) : '';
    $specialization =   isset($_GET['specialization']) ?   strval($_GET['specialization']) : '';
    $from =             isset($_GET['from']) ?             strval($_GET['from']) : '';
    $to =               isset($_GET['to']) ?               strval($_GET['to']) : '';
    $page =             isset($_GET['page']) ?             strval($_GET['page']) : '';

    $surname =      preg_replace("/[^А-Яа-яЁё]/u", "", $surname);
    $name =         preg_replace("/[^А-Яа-яЁё]/u", "", $name);
    $patronymic =   preg_replace("/[^А-Яа-яЁё]/u", "", $patronymic);
    $city =         preg_replace("/[^А-Яа-яЁё]/u", "", $city);
    if (($city == "СанктПетербург")or($city == "Санктпетербург")or($city == "санктПетербург")or($city == "санктпетербург")) {$city = "Санкт-Петербург";}
    $vuz =          preg_replace("/[^А-Яа-яЁё]/u", "", $vuz);
    $specialization = preg_replace("/[^\d\.]/u", "", $specialization);
    $from =         preg_replace("/[^\d]/u", "", $from);
    $to =           preg_replace("/[^\d]/u", "", $to);
    $page =         preg_replace("/[^\d]/u", "", $page);

    $count_input_data = 0;
    $sqlending = "";
    $history = "";

    if (strlen($surname)>0) {
    	$sqlending .= " `surname` LIKE '$surname'";
        $history .= $surname;
    	$count_input_data++;
    } else {$history .= "_";}

    if (strlen($name)>0) {
    	if (strlen($sqlending)>0) {$sqlending .= " AND";}
    	$sqlending .= " `name` LIKE '$name'";
        $history .= $name;
    	$count_input_data++;
    } else {$history .= "_";}

    if (strlen($patronymic)>0) {
    	if (strlen($sqlending)>0) {$sqlending .= " AND";}
    	$sqlending .= " `patronymic` LIKE '$patronymic'";
        $history .= $patronymic;
    	$count_input_data++;
    } else {$history .= "_";}

    if (strlen($city)>0) {
    	if (strlen($sqlending)>0) {$sqlending .= " AND";}
    	$sqlending .= " `city_name` LIKE '$city'";
        $history .= $city;
    	$count_input_data++;
    } else {$history .= "_";}

    if (strlen($vuz)>0) {
    	if (strlen($sqlending)>0) {$sqlending .= " AND";}
    	$sqlending .= " `abb_name_UZ` LIKE '$vuz'";
        $history .= $vuz;
    	$count_input_data++;
    } else {$history .= "_";}

    if (strlen($specialization)>0) {
    	if (strlen($sqlending)>0) {$sqlending .= " AND";}
    	$sqlending .= " `specialization` LIKE '$specialization'";
        $history .= $specialization;
    	$count_input_data++;
    } else {$history .= "_";}

    if (strlen($from)>0) {
        $count_input_data++;
    }

    if (strlen($to)>0) {
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

    $sqlconnect = mysql_connect($config_user, $config_database, $config_password);
    if (!$sqlconnect) {die('Ошибка соединения: ' . mysql_error());}
    mysql_select_db($config_database);

    //Находим количество строк, отвечающих запросу
    $report = mysql_query("SELECT COUNT(*) FROM `students` WHERE".$sqlending);
    $report = mysql_fetch_array($report);
    $count_found = $report[0];

    //Сохраняем историю
    $fp = fopen('history.txt', "a");
    $historys = $count_found."\n".$_SERVER['REMOTE_ADDR']."\n".$_SERVER['HTTP_USER_AGENT']."\n".$history."\n";
    fwrite($fp, $historys);
    fclose($fp);

    if ($count_found == 0) { echo "По данному запросу ничего не найдено"; exit(); }

    if ($count_found > 1500) { echo "Количество результатов больше 1500. Уточните запрос"; exit(); }

    $a=file_get_contents("http://openstudents.ru/templates/search.php");
    echo ($a);

    //А теперь полноценный запрос
    $report = mysql_query("SELECT * FROM `students` WHERE$sqlending");

    //Менеджер страниц
    if (strlen($page)==0) {$page = 1;}


    echo '<div class="alert alert-success">
            <strong>'.$count_found.' </strong>'.getNumEnding($count_found, array('результат', 'результата', 'результатов')).'
          </div><table class="table table-striped">
          <thead><tr><th>#</th><th>Город</th><th>ВУЗ</th><th>Приказ</th><th>Фамилия</th><th>Имя</th><th>Отчёство</th><th>Сумма</th><th>Специальность</th></tr></thead>
          <tbody>';
    for($i=1;$i<=$count_found;$i++) {
            $arr = mysql_fetch_array($report);
            if ($arr[sum]==555) {$sum = "б/э";}
            elseif ($arr[sum]==666) {$sum = "отчислен(а)";} else {$sum = $arr[sum];}//Правильный вывод суммы баллов
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

    echo '
            <div style="text-align: center;">
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- OpenSt footer -->
            <ins class="adsbygoogle"
                 style="display:inline-block;width:728px;height:90px"
                 data-ad-client="ca-pub-8212627326962960"
                 data-ad-slot="2795091539"></ins>
            <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
            </div>';

?>