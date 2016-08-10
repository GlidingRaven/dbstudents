<?php

    $config = parse_ini_file("/home/rainadmin/openstudents.ru/config.ini");

    ////Единый блок авторизации
    $password = preg_replace("/[^A-Za-z\d]/u", "", $_COOKIE["pass"]); // Берём куки и фильтруем
    $hash1 = md5($password);            // Хешируем
    $salt = $config[salt];              // Соль
    $saltedHash = md5($hash1 . $salt);  // Складываем старый хеш с солью и пропускаем через функцию md5()
    if ($saltedHash <> '3a38907753c8f7340a8b4bcaf9490ce7') {  echo "Access Denited.";exit();  }

    echo
  '<!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
      <meta name="description" content="">
      <meta name="author" content="">

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
      <title>Open Students | Откат БД</title>

      <link href="/css/bootstrap.min.css" rel="stylesheet">
      <link href="/css/dashboard.css" rel="stylesheet">
      <link href="/js/highlight-within-textarea-master/jquery.highlight-within-textarea.css" rel="stylesheet">
      <script src="/js/jquery-2.2.4.min.js"></script>
      <script src="/js/bootstrap.min.js"></script>
      <script src="/js/highlight-within-textarea-master/jquery.highlight-within-textarea.js"></script>
      <script src="/adm/mine.js"></script>

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
            <a class="navbar-brand" href="/">Open Students</a>
          </div>

          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li><a href="/adm/panel">Control Panel</a></li>
              <li class="active"><a href="#">Откат</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li><a href="#"><u>СПЕЦИАЛЬНЫЙ</u></a></li>
            </ul>
          </div>
        </div>
      </nav>

      <div class="container-fluid">
        <div class="row">
            
          <div class="col-md-10 col-md-offset-1">
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
            </div><br>
            <p><button type="button" class="btn btn-primary btn-lg" id="buttondel" href="#">Ввод</button></p>

            '."<script>
              $(document).on('click','#buttondel', delsource);

              function delsource(){
                var del_number = $('#del_number').val();
                var del_pass = $('#del_pass').val();".'
                
                $.post("cancel.php", { del_number: del_number, del_pass: del_pass } )
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
            
        </div>
      </div>
    </body>
  </html>';
?>