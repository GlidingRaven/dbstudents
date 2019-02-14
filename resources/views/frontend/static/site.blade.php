@extends('app')

@section('title', '| О сайте')

@section('content')

	<hr class="featurette-divider">
	
	<div class="row featurette">
        <div class="col-md-7">
          <h2 class="featurette-heading">Студенчество. Здесь. <span class="text-muted">Сейчас.</span></h2>
          <p class="lead">Это структурированный архив приказов о зачислении в Российские ВУЗы. Предназначен для хранения информации о студентах. Контакты: <a href="https://vk.com/id36620280" target="_blank">VK</a> / <a href="https://www.instagram.com/dunaevsky_spb/" target="_blank">Instagram</a> / <a href="https://github.com/GlidingRaven" target="_blank">GitHub</a></p>

        </div>
        <div class="col-md-5">
          <img class="featurette-image img-responsive center-block" src="/lic.jpg">
        </div>
    </div>

    <hr class="featurette-divider">

    <a href="https://github.com/GlidingRaven/dbstudents"><img style="position: absolute; top: 0; right: 0; border: 0; z-index:1031;" src="https://camo.githubusercontent.com/38ef81f8aca64bb9a64448d0d70f1308ef5341ab/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f72696768745f6461726b626c75655f3132313632312e706e67" alt="Fork me on GitHub" data-canonical-src="https://s3.amazonaws.com/github/ribbons/forkme_right_darkblue_121621.png"></a>




@endsection


@section('head')

<link href="/css/carousel.css" rel="stylesheet">

@endsection

@section('navbar')
<li class="active"><a href="#">О сайте</a></li>
@endsection