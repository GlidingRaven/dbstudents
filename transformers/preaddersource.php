<?php
  //Функция на случай если пользователь "даст заднюю"
  function stepback($strabb){
    echo '<h1 class="page-header">Добавление сорса</h1>
                <div class="row">
                <div class="col-md-2 col-md-offset-3"><a href="https://regex101.com/" class="btn btn-default" target="_blank">regex tester</a></div>
                <div class="col-md-2 col-md-offset-3"><a href="#handbook" class="btn btn-primary" aria-controls="handbook" role="tab" data-toggle="tab">Обновить regex</a></div>
                </div><br>
                <div class="row">
                <div class="col-md-5">
                  <div class="input-group">
                    <span class="input-group-addon" id="sizing-addon1">Название УЗ</span>
                    <input type="text" class="form-control" placeholder="МГТУ" id="name_uz">
                  </div><!-- /input-group -->
                </div><!-- /.col-lg-5 -->
                <div class="col-md-2">
                  <div class="input-group">
                    <span class="input-group-addon" id="sizing-addon1">День</span>
                    <input type="text" maxlength="2" class="form-control" id="date_day">
                  </div><!-- /input-group -->
                </div><!-- /.col-lg-2 -->
                <div class="col-md-3">
                  <div class="input-group">
                  <span class="input-group-addon" id="sizing-addon1">Месяц</span>
                  <select class="form-control"  id="date_month">
                      <option value="7">июль</option>
                      <option value="8">август</option>
                  </select>
                  </div><!-- /input-group -->
                </div><!-- /.col-lg-3 -->
                <div class="col-md-2">
                  <div class="input-group">
                  <span class="input-group-addon" id="sizing-addon1">Год</span>
                  <select class="form-control"  id="date_year">
                      <option value="2015">2015</option>
                      <option value="2016">2016</option>
                  </select>
                  </div><!-- /input-group -->
                </div><!-- /.col-lg-2 -->
                </div><!-- /.row -->
                <br>
                  <div class="input-group">
                    <span class="input-group-addon" id="sizing-addon1">Ссылка на источник</span>
                    <input type="text" class="form-control" placeholder="http://cpk.msu.ru/files/2015/documents/concourse2_b.pdf" id="url_source">
                  </div><!-- /input-group -->
                <br>
                <p><textarea rows="25" cols="90" name="text" class="form-control" id="bigtext" autofocus></textarea></p>
                <div class="row">
                  <div class="col-md-5"><button type="button" class="btn btn-primary btn-lg" id="buttonforsource" href="#">Ввод</button></div>
                  <div class="col-md-7">'.$strabb.'</div>
                </div>
';}

  if ($_COOKIE["passer"]<>"325373c671bd18c9c526be384516c5da") {
    header("HTTP/1.1 403 Forbidden" );
    exit();
  }

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
  {stepback("<kbd>Неполное заполнение или неверный формат</kbd>");exit();}//Всё ли есть?

  $report = mysql_query("SELECT * FROM `campuses` WHERE `abb_name_UZ` LIKE '$name_uz'");//Проверка на существование такого УЗ
  $sql_rows = mysql_num_rows($report); if($sql_rows == 0){stepback("<kbd>Такого УЗ нет</kbd>");exit();}

  $report = mysql_fetch_array($report);
  $city_code = $report[city_code];
  $abb_name_UZ = $report[abb_name_UZ];
  $code_UZ = $report[code_UZ];

  $max_of_code_source = mysql_fetch_array(mysql_query("SELECT MAX(`code_source`) FROM `sources`"));//Нахождение макс. номера сорса
  $code_source = $max_of_code_source[0] + 1;
  $count_students = 0;

  $re_spec = "/[^0-9](\\b\\d{2}\\.\\d{2}\\.\\d{2}\\b)[^0-9]/";
  $stud = file('regex.txt'); $re_stud = $stud[0];
    
   
  $answer_specialization = preg_match_all($re_spec, $str, $matches_spec, PREG_OFFSET_CAPTURE);
  $answer_students = preg_match_all($re_stud, $str, $matches_stud, PREG_OFFSET_CAPTURE);

  $count_students = $answer_students;
  if ($count_students>1024) {stepback("<kbd>".$count_students." студентов — это слишком много</kbd>");exit();}//Проверка на кол-во элементов

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
      echo "<p>Data not available, bitch</p>";exit();
    }
    //print_r($db_students);

    echo 'Сформулирована таблица из '.$count_students.' студентов
    <table class="table table-striped"><thead><tr><th>#</th><th>surname</th><th>name</th><th>patronymic</th><th>sum</th><th>specialization</th></tr></thead><tbody>'."\n";
        for($i=0; $i < $answer_students; $i++) {
          $nuka = $i + 1;
          echo "<tr><td>".$nuka.'</td><td>'.$db_students[$i][1].'</td><td>'.$db_students[$i][2].'</td><td>'.$db_students[$i][3].'</td><td>'.$db_students[$i][4].'</td><td>'.$db_students[$i][5]."</td></tr>\n";
        }
    echo "</tbody></table>\n";

	mysql_close($sqlconnect);
?>