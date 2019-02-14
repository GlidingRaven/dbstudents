<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="apple-touch-icon" sizes="57x57" href="/favicons/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/favicons/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/favicons/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/favicons/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/favicons/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/favicons/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/favicons/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/favicons/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/favicons/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/favicons/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicons/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicons/favicon-16x16.png">
    <link rel="manifest" href="/favicons/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/favicons/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <title>Open Students | Control Panel</title>

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/dashboard.css" rel="stylesheet">
    <link href="/js/highlight-within-textarea-master/jquery.highlight-within-textarea.css" rel="stylesheet">
    <script src="/js/jquery-2.2.4.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/highlight-within-textarea-master/jquery.highlight-within-textarea.js"></script>
    <script src="/js/mine.js"></script>

    <!-- make things pretty -->
    <style>
      @import url(https://fonts.googleapis.com/css?family=Open+Sans:400,700|Roboto+Mono);

      /* background and positioning */
      .hwt-container {
        background-color: #fff;
        height: auto;
      }

      /* size and formatting */
      .hwt-content {
        padding: 20px;
        color: #555;
        font: 18px/25px "Roboto Mono", sans-serif;
      }

      /* highlights */
      .hwt-content mark {
        border-radius: 3px;
      }
      .hwt-content mark:nth-of-type(2n) {
        background-color: #cfdeab;
      }
      .hwt-content mark:nth-of-type(2n+1) {
        background-color: #b1d5e5;
      }
    </style>

  </head>

<body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">Open Students</a>
        </div>

        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Control Panel</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="/phpmyadmin" target="_blank">MySQL</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar" role="tablist">
            <li class="active"><a a href="#source" aria-controls="source" role="tab" data-toggle="tab">Добавить приказ<span class="sr-only">(current)</span></a></li>
            <li><a href="#uz" aria-controls="uz" role="tab" data-toggle="tab">Добавить УЗ</a></li>
            <li><a href="#city" aria-controls="city" role="tab" data-toggle="tab">Добавить город</a></li>
            <li><a href="#reference" aria-controls="reference" role="tab" data-toggle="tab">Справка</a></li>
            <li><a href="#cancel" aria-controls="cancel" role="tab" data-toggle="tab">Удалить приказ</a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <li><a href="/citys" target="_blank">Города</a></li>
            <li><a href="/campuses" target="_blank">ВУЗы</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="source">
                <h1 class="page-header">Добавление приказа</h1>
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
                      <option value="7">июль [7]</option>
                      <option value="8">август [8]</option>
                  </select>
                  </div><!-- /input-group -->
                </div><!-- /.col-lg-3 -->
                <div class="col-md-2">
                  <div class="input-group">
                  <span class="input-group-addon" id="sizing-addon1">Год</span>
                  <select class="form-control"  id="date_year">
                      <option value="2019">2019</option>
                      <option value="2018">2018</option>
                      <option value="2017">2017</option>
                      <option value="2016">2016</option>
                      <option value="2015">2015</option>
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
                  <div class="input-group">
                    <span class="input-group-addon" id="sizing-addon1">Описание приказа</span>
                    <input type="text" class="form-control" id="comment">
                    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                  </div><!-- /input-group -->
                <br>
                <p><textarea rows="20" cols="90" name="text" class="form-control regex-example" id="bigtext" autofocus></textarea></p>
                <script>
                  function onInputRegex(input) {return /(([А-ЯЁ][а-яё]+)\s([А-ЯЁ][а-яё]+)\s([А-ЯЁ][а-яё]+).{0,20}?[^0-9]([1-9][0-9]{2})[^0-9])|([^0-9](\b\d{2}\.\d{2}\.\d{2}\b)[^0-9])/g;}
                  $("textarea.regex-example").highlightWithinTextarea(onInputRegex);
                </script>
                <div class="row">
                  <div class="col-md-3"><button type="button" class="btn btn-primary btn-lg" id="buttonforsource" href="#">Ввод</button></div>
                  <div class="col-md-3">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" id="readmode"> Режим "б/э"
                      </label>
                    </div>
                  </div>
                  <div class="col-md-6"></div>
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
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </div><br>
                <p><button type="button" class="btn btn-primary btn-lg" id="buttonforuz" href="#">Ввод</button></p>
            </div>
            <div role="tabpanel" class="tab-pane" id="city">
                <h1 class="page-header">Добавление города</h1>
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1">Город</span>
                  <input type="text" class="form-control" placeholder="Омск" id="city_name">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </div><br>
                <p><button type="button" class="btn btn-primary btn-lg" id="buttonforcity" href="#">Ввод</button></p>
            </div>
            <div role="tabpanel" class="tab-pane" id="reference">
                <h1 class="page-header">Справка</h1>
                <h3>Примечание</h3>
                <p>Подсветка текста моделирует работу обработчика, не игнорируйте её</p>
                <p>Для обозначения студентов, поступивших без экзаменов, используйте сумму баллов <b>555</b></p>
                <p>Для обозначения отчисленных студентов, используйте сумму баллов <b>666</b></p>
                <p>При отсутствии отчества используйте слово <b>Анон</b></p>
                <h3>Ошибки при добавлении</h3>
                <p>fail - ошибка клиент-сервер</p>
            </div>
            <div role="tabpanel" class="tab-pane" id="cancel">



            <h1 class="page-header">Откат БД | Удаление приказа</h1>
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title">Предупреждение</h3>
              </div>
              <div class="panel-body">Перед удалением внимательно проверь!</div>
            </div>

            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1">Номер приказа</span>
              <input type="text" class="form-control" id="del_number">
            </div><br>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1">Пароль доступа</span>
              <input type="password" class="form-control" id="del_pass">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </div><br>
            <p><button type="button" class="btn btn-primary btn-lg" id="buttondel33" href="#">Ввод</button></p>

            <script>
              $(document).on('click','#buttondel33', delsource);

              function delsource(){
                var del_number = $('#del_number').val();
                var del_pass = $('#del_pass').val();
                
                $.post("/delsource", { del_number: del_number, del_pass: del_pass, _token: token } )
                  .done(function(data) {
                  alert(data);
                  //$("#bigtext").val("");
                                       })
                  .fail(function(data) {
                  alert("fail");
                });
                }
            </script>





            </div>

            
            <div role="tabpanel" class="tab-pane" id="handbook">
                <h1 class="page-header">Обновление regex'a</h1>
                <p><a href="#source" class="btn btn-primary" aria-controls="source" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span></a></p>
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1">Выражение</span>
                  <input type="text" class="form-control" value="([А-ЯЁ][а-яё]+)\s([А-ЯЁ][а-яё]+)\s([А-ЯЁ][а-яё]+).{0,20}?[^0-9]([1-9][0-9]{2})[^0-9]" id="regular_exp">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </div><br>
                <p><button type="button" class="btn btn-primary btn-lg" id="buttonregexp" href="#">Ввод</button></p>
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </body>
</html>