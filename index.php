<?php
if ($_COOKIE["passer"]<>"325373c671bd18c9c526be384516c5da") {
  header("HTTP/1.1 403 Forbidden" );
  exit();
}
echo '
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Control Panel</title>


    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <link href="dashboard.css" rel="stylesheet">
    <script src="/jquery-2.2.4.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <script src="mine.js"></script>
  </head>

<body>

    <nav class="navbar navbar-inverse navbar-fixed-top"><!-- хуита сверху -->
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">Ravengo</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#" target="_blank">Search</a></li>
            <li><a href="https://bp.webhost1.ru/#hosting" target="_blank">MySQL</a></li>
            <li><a href="#"><u>ДЛЯ СЛУЖЕБНОГО ПОЛЬЗОВАНИЯ</u></a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar" role="tablist">
            <li class="active"><a a href="#source" aria-controls="source" role="tab" data-toggle="tab">Добавить сорс <span class="sr-only">(current)</span></a></li>
            <li><a href="#uz" aria-controls="uz" role="tab" data-toggle="tab">Добавить УЗ</a></li>
            <li><a href="#city" aria-controls="city" role="tab" data-toggle="tab">Добавить город</a></li>
            <li><a href="#reference" aria-controls="reference" role="tab" data-toggle="tab">Справка</a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <li><a href="">Студенты</a></li>
            <li><a href="">УЗ</a></li>
            <li><a href="">Города</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="source">
                <h1 class="page-header">Добавление сорса</h1>
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
                  <div class="col-md-7"></div>
                </div>
            </div>
            
            <div role="tabpanel" class="tab-pane" id="uz">
                <h1 class="page-header">Добавление УЗ</h1>
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1">Код города</span>
                  <input type="text" class="form-control" placeholder="3" id="city_code">
                </div><br>
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1">Полное название</span>
                  <input type="text" class="form-control" placeholder="Российский государственный педагогический университет имени А. И. Герцена" id="full_name_uz">
                </div><br>
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1">Сокращенное название</span>
                  <input type="text" class="form-control" placeholder="РГПУ" id="abb_name_uz">
                </div><br>
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1">Сайт</span>
                  <input type="text" class="form-control" placeholder="http://bmstu.ru/" id="url_site">
                </div><br>
                <p><button type="button" class="btn btn-primary btn-lg" id="buttonforuz" href="#">Ввод</button></p>
            </div>
            <div role="tabpanel" class="tab-pane" id="city">
                <h1 class="page-header">Добавление города</h1>
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1">Город</span>
                  <input type="text" class="form-control" placeholder="Омск" id="city_name">
                </div><br>
                <p><button type="button" class="btn btn-primary btn-lg" id="buttonforcity" href="#">Ввод</button></p>
            </div>
            <div role="tabpanel" class="tab-pane" id="reference">
                <h1 class="page-header">Справка</h1>
                <h3>Ошибки при добавлении УЗ</h3>
                <p>400 - неполное заполнение или неверный формат</p>
                <p>410 - такого города нет</p>
                <p>420 - повторение сокращенного названия УЗ</p>
                <p>430 - такого УЗ нет</p>
                <p>fail - ошибка клиент-сервер</p>
            </div>
            
            <div role="tabpanel" class="tab-pane" id="handbook">
                <h1 class="page-header">Обновление regex\'a</h1>
                <p><a href="#source" class="btn btn-primary" aria-controls="source" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span></a></p>
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1">Выражение</span>
                  <input type="text" class="form-control" value="([А-ЯЁ][а-яё]+)\s([А-ЯЁ][а-яё]+)\s([А-ЯЁ][а-яё]+)\s.{0,20}?([1-9][0-9]{1,2})[^0-9]" id="regular_exp">
                </div><br>
                <p><button type="button" class="btn btn-primary btn-lg" id="buttonregexp" href="#">Ввод</button></p>
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </body>
</html>';
?>