<?php
  if ($_COOKIE["passer"]<>"325373c671bd18c9c526be384516c5da") {
    header("HTTP/1.1 403 Forbidden" );
    exit();
  }
  echo '
  <!DOCTYPE html>
  <html><head>
      <meta charset="utf-8">
      <title>regexper</title>
      <link href="../../css/bootstrap.min.css" rel="stylesheet">

  </head>
  <body>';

  $sqlconnect = mysql_connect('localhost', 'rainadmin_exp', 'OS8A83M3DUAO');
  mysql_select_db('rainadmin_exp');

  $str = mysql_real_escape_string($_POST['bigtext']);
  $str = preg_replace("/(Приказом\s)|(Минобрнауки\s)|(России\s)|(по\s)/u", "", $str);//Удаляем мусор
  $name_uz = mysql_real_escape_string($_POST['name_uz']);
  $url_source = mysql_real_escape_string($_POST['url_source']);
  $date_day = intval($_POST['date_day']);
  $date_month = intval($_POST['date_month']);
  $date_year = intval($_POST['date_year']);

  if ((strlen($str)==0)or(strlen($name_uz)==0)or(strlen($url_source)==0)or($date_day<1)or($date_day>31)or($date_month<1)or($date_month>12)or($date_year<2015)or($date_year>2020))
  {echo("Неполное заполнение или неверный формат");exit();}//Всё ли есть?

  $report = mysql_query("SELECT * FROM `campuses` WHERE `abb_name_UZ` LIKE '$name_uz'");//Проверка на существование такого УЗ
  $sql_rows = mysql_num_rows($report); if($sql_rows == 0){echo("Такого УЗ нет");exit();}

  $report = mysql_fetch_array($report);
  $city_code = $report[city_code];
  $abb_name_UZ = $report[abb_name_UZ];
  $code_UZ = $report[code_UZ];

  $max_of_code_source = mysql_fetch_array(mysql_query("SELECT MAX(`code_source`) FROM `sources`"));//Нахождение макс. номера сорса
  $code_source = $max_of_code_source[0] + 1;
  $count_students = 0;

  $re_spec = "/(\\b\\d{2}\\.\\d{2}\\.\\d{2}\\b)/";
  $stud = file('regex.txt'); $re_stud = $stud[0];
    
   
  $answer_specialization = preg_match_all($re_spec, $str, $matches_spec, PREG_OFFSET_CAPTURE);
  $answer_students = preg_match_all($re_stud, $str, $matches_stud, PREG_OFFSET_CAPTURE);

  $count_students = $answer_students;

    //Начали перевод ин-ции в более удобный вид
    if ($answer_students >= 1) {
      $count_students = $answer_students;
      for ($i=0; $i < $answer_students; $i++) { 
        $db_students[$i][0] = $matches_stud[0][$i][1];//position in original text
        $db_students[$i][1] = $matches_stud[1][$i][0];//surname
        $db_students[$i][2] = $matches_stud[2][$i][0];//name
        $db_students[$i][3] = $matches_stud[3][$i][0];//patronymic
        $db_students[$i][4] = $matches_stud[4][$i][0];//sum
        $db_students[$i][5] = "00.00.00";//specialization
      }
      //Расстановка специальностей
      if ($answer_specialization >= 1) {
        for ($i=0; $i < $answer_specialization; $i++) {
          for ($k=0; $k < $answer_students; $k++) { 
            if ($db_students[$k][0] > $matches_spec[0][$i][1]) {
              $db_students[$k][5] = $matches_spec[0][$i][0];
            }
          }
        }}
    }
    else {
      echo "Data not available, bitch";exit();
    }
    //print_r($db_students);

    echo '<table class="table table-striped"><thead><tr><th>#</th><th>surname</th><th>name</th><th>patronymic</th><th>sum</th><th>specialization</th></tr></thead><tbody>'."\n";
        for($i=0; $i < $answer_students; $i++) {
          $nuka = $i + 1;
          echo "<tr><td>".$nuka.'</td><td>'.$db_students[$i][1].'</td><td>'.$db_students[$i][2].'</td><td>'.$db_students[$i][3].'</td><td>'.$db_students[$i][4].'</td><td>'.$db_students[$i][5]."</td></tr>\n";
        }
    echo "</tbody></table>\n";

	mysql_close($sqlconnect);
  echo '
</body>
</html>';
?>