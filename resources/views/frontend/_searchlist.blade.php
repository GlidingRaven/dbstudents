@include('frontend._searchform')
<div class="alert alert-success">
            <strong>{{ $cnt }} </strong>результатов
          </div><table class="table table-striped">
          <thead><tr><th>#</th><th>Город</th><th>ВУЗ</th><th>Приказ</th><th>Фамилия</th><th>Имя</th><th>Отчёство</th><th>Сумма</th><th>Специальность</th></tr></thead>
          <tbody>




              @foreach ($table as $table)
                <tr>
                <td>{{ $loop->iteration }}</td>
                <td><a href="/ci/{{ $table['city_code'] }}">{{ $table['city_name'] }}</a></td>
                <td><a href="/uz/{{ $table['code_UZ'] }}">{{ $table['abb_name_UZ'] }}</a></td>
                <td><a href="/or/{{ $table['code_source'] }}">Приказ {{ $table['code_source'] }}</a></td>
                <td>{{ $table['surname'] }}</td>
                <td>{{ $table['name'] }}</td>
                <td>{{ $table['patronymic'] }}</td>
                <td>{{ $table['sum'] }}</td>
                <td>{{ $table['specialization'] }}</td>
                </tr>
              @endforeach
</tbody>
</table>

            <div style="text-align: center;">
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- OpenSt footer -->
            <ins class="adsbygoogle"
                 style="display:inline-block;width:728px;height:90px"
                 data-ad-client="ca-pub-8212627326962960"
                 data-ad-slot="2795091539"></ins>
            <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
            </div>