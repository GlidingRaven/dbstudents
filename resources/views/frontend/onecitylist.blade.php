@extends('app')

@section('title', '| '.$generalInfo['city_name'] )

@section('content')
        
        <h1>{{ $generalInfo->city_name }}</h1>

        <h3>В этом городе индексированно {{ $counts['ofCampuses'] }} университетов, а это {{ $counts['ofStudents'] }} студентов</h3>

            <table class="table table-striped">
            <thead><tr><th>#</th><th>Название</th><th>Число приказов</th><th>Число студентов</th></thead>
              <tbody>
              @foreach ($table as $onetable)
                <tr>
                <td>{{ $loop->iteration }}</td>
                <td><a href="/uz/{{ $onetable->code_UZ }}">{{ $onetable->abb_name_UZ }}</a></td>
                <td>{{ $onetable->count_sources }}</td>
                <td>{{ $onetable->count_students }}</td>
                </tr>
              @endforeach
              </tbody>
            </table>
@endsection

@section('navbar')
<li class="active"><a href="#">{{ $generalInfo['city_name'] }}</a></li>
@endsection