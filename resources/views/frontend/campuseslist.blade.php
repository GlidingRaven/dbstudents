@extends('app')

@section('title', '| Университеты')

@section('content')
        
        <h1>Университеты</h1>

        <h3>В базу данных занёсено {{ $counts['ofCampuses'] }} университета, а это {{ $counts['ofStudents'] }} студентов</h3>

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