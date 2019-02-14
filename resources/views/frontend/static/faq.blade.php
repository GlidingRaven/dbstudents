@extends('app')

@section('title', '| FAQ')

@section('content')
      <style>
.faq_q {
  font-weight: bold;
  display: block;
  margin-bottom: 7px;
}
.faq_q:hover{
  text-decoration: none;
}
.faq_a {
  /*display:none;*/
}
</style>

<script>
$(function() {
  $('a.faq_q').click(function(){ $(this).next().toggle(); return false; });
});
</script>

<div style="margin: 10px 30px;">

<legend>Вопросы и ответы</legend>

<a href="#" class="faq_q">- Что_это?</a>
<div class="well faq_a">
Структурированный архив приказов о зачислении в Российские ВУЗы.<br>
Предназначен для хранения информации о студентах. Списки сортируются по дате издания, учебному заведению и городу.<br>
Обычно сервис используется для поиска людей из ВУЗов, или оценки проходных баллов.
</div>

<a href="#" class="faq_q">- Это вообще законно?</a>
<div class="well faq_a">
Конечно<br>
В целях информационного обеспечения, все обрабатываемые данные собраны из общедоступных источников персональных данных (в соответствии с п. 1 ст. 8 ФЗ №152 «О персональных данных» от 27.07.2006 г.).
</div>

<a href="#" class="faq_q">- Как часто обновляется информация?</a>
<div class="well faq_a">
В августе-сентябре каждого года. Если вы желаете помочь, пишите по контактам указанным в разделе "О сайте".
</div>

<a href="#" class="faq_q">- Как найти людей, поступивших без экзаменов?</a>
<div class="well faq_a">
В поля ввода баллов введите 555.
</div>

</div>
    </div>


@endsection

@section('navbar')
<li class="active"><a href="#">FAQ</a></li>
@endsection