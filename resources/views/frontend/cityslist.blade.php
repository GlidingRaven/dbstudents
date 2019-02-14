@extends('app')

@section('title', '| Города')

@section('content')
        
        <h1>Города</h1>

        <h3>В базу данных занёсено {{ $counts['ofCitys'] }} города, а это {{ $counts['ofStudents'] }} студентов</h3>

            <table class="table table-striped">
            <thead><tr><th>#</th><th>Город</th><th>Число университетов</th><th>Число студентов</th></thead>
              <tbody>
              @foreach ($table as $onetable)
                <tr>
                <td>{{ $loop->iteration }}</td>
                <td><a href="/ci/{{ $onetable->city_code }}">{{ $onetable->city_name }}</a></td>
                <td>{{ $onetable->count_UZ }}</td>
                <td>{{ $onetable->count_students }}</td>
                </tr>
              @endforeach
              </tbody>
            </table>
@endsection