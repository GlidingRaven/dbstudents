@extends('app')

@section('title', '| '.$generalInfo['abb_name_UZ'] )

@section('content')
        
        <h1>{{ $cityInfo['city_name'] }} / {{ $generalInfo['abb_name_UZ'] }}</h1>
        <h2>{{ $generalInfo['full_name_UZ'] }}</h2>
        <h3>Индексированно {{ $counts['ofSources'] }} приказов о зачислении ({{ $counts['ofStudents'] }} студентов)</h3>
        <h4><a href="{{ $generalInfo['url_site'] }}" target="_blank">Сайт вуза</a></h4>

            <table class="table table-striped">
            <thead><tr><th>#</th><th>Номер</th><th>Дата</th><th>Зачислено студентов</th><th>Описание</th></thead>
              <tbody>
              @foreach ($table as $onetable)
                <tr>
                <td>{{ $loop->iteration }}</td>
                <td><a href="/or/{{ $onetable->code_source }}">{{ $onetable->code_source }}</a></td>
                <td>{{ $onetable->date }}</td>
                <td>{{ $onetable->count_students }}</td>
                <td>{{ $onetable->comment }}</td>
                </tr>
              @endforeach
              </tbody>
            </table>
@endsection

@section('navbar')
<li><a href="/ci/{{ $generalInfo['city_code'] }}">{{ $cityInfo['city_name'] }}</a></li>
<li class="active"><a href="#">{{ $generalInfo['abb_name_UZ'] }}</a></li>
@endsection