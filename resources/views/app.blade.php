<!DOCTYPE html>
<html><head>
  <meta charset="utf-8">
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
  <meta name="yandex-verification" content="1a61a2e81b706c31" />
  <title>Open Students @yield('title')</title>
  <meta name="description" content="Open students – это поиск и хранение информации о студентах российских университетов. Структурированный архив приказов о зачислении в Российские университеты. Предназначен для хранения информации о студентах. Списки сортируются по дате издания, учебному заведению и городу." />
  <meta name="keywords" content="зачисление, приказы, студенты, абитуриенты, списки, образование, рейтинг, база данных, архив, университет, сервис" />
  <script src="/js/jquery-3.0.0.js"></script>
  <script src="/js/jquery.maskedinput.min.js"></script>
  <script src="/js/index.js"></script>
  <link href="/css/bootstrap.css" rel="stylesheet">
  <link href="/css/custom.css" rel="stylesheet">
@yield('head')
  <style type="text/css">


  </style>

</head>
<body>
  <div class="excont">
  <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">Open Students</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
           @yield('navbar')
          </ul>
        </div>
      </div>
  </div>

  <div id="page_content">
@yield('content')
  </div> <!--/page_content-->
  <div class="footer">
  <br>
              <ul class="horizontal-menu"> <!--horizontal-menu-->
                <li><a href="/faq">FAQ</a></li><li><a href="/site">О сайте</a></li></ul>
              <br>
              <p><center>© 2019</center></p>
  </div>
  </div> <!--/excont-->
</body>
</html>