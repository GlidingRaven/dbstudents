@extends('app')

@section('title', '| Приказ №'.$generalInfo->code_source )

@section('content')
        
        <h1>{{ $cityInfo->city_name }} / {{ $campuseInfo->abb_name_UZ }} / Приказ №{{ $generalInfo->code_source  }} от {{ $generalInfo->date }}</h1>
        <h2>{{ $generalInfo->comment }}</h2>
        <h3>Приказ о зачислении {{ $count }} студентов</h3>
        <h4 class="text-right"><a href="" target="_blank">Ссылка на источник</a></h4>

            <table class="table table-striped">
            <thead><tr><th>#</th><th>Фамилия</th><th>Имя</th><th>Отчество</th><th>Сумма баллов</th><th>Специальность</th></thead>
              <tbody>
              @foreach ($table as $onetable)
                <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $onetable->surname }}</a></td>
                <td>{{ $onetable->name }}</td>
                <td>{{ $onetable->patronymic }}</td>
                <td>{{ $onetable->sum }}</td>
                <td>{{ $onetable->specialization }}</td>
                </tr>
              @endforeach
              </tbody>
            </table>
@endsection

@section('navbar')
<li><a href="/ci/{{ $cityInfo['city_code'] }}">{{ $cityInfo['city_name'] }}</a></li>
<li><a href="/uz/{{ $generalInfo['code_UZ'] }}">{{ $generalInfo['abb_name_UZ'] }}</a></li>
<li class="active"><a href="#">Приказ №{{ $generalInfo->code_source  }}</a></li>
@endsection