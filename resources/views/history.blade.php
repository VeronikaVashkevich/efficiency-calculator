<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Расчет эффективности - история</title>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>
<body>
<div class="container history-blocks">
    <h1 class="text-center">История рассчетов</h1>
    <a href="{{ route('index') }}" class="mb-15 text-center">Назад</a>
    <div class="mb-15 history-block">
        <h2 class="text-center">Энергетическая эффективность</h2>
        <table class="history">
            <tr>
                <th>#</th>
                <th>&beta;</th>
                <th>R</th>
                <th>P<sub>e</sub></th>
                <th>N<sub>0</sub></th>
                <th colspan="2">Экспорт</th>
            </tr>
            @foreach($energy as $res)
                <tr>
                    <td>{{ $res->id }}</td>
                    <td>{{ $res->beta }}</td>
                    <td>{{ $res->R }}</td>
                    <td>{{ $res->Pe }}</td>
                    <td>{{ $res->N0 }}</td>
                    <td><a href="{{ route('downloadPdf', ['type' => 'energy', 'id' => $res->id]) }}">PDF</a></td>
                    <td><a href="{{ route('downloadXLS', ['type' => 'energy', 'id' => $res->id]) }}">XLS</a></td>
                </tr>
            @endforeach
        </table>
    </div>
    <div class="mb-15">
        <h2 class="text-center">Частотная эффективность</h2>
        <table class="history">
            <tr>
                <th>#</th>
                <th>&gamma;</th>
                <th>R</th>
                <th>&#916;F</th>
                <th colspan="2">Экспорт</th>
            </tr>
            @foreach($frequency as $res)
                <tr>
                    <td>{{ $res->id }}</td>
                    <td>{{ $res->gamma }}</td>
                    <td>{{ $res->R }}</td>
                    <td>{{ $res->deltaF }}</td>
                    <td><a href="{{ route('downloadPdf', ['type' => 'frequency', 'id' => $res->id]) }}">PDF</a></td>
                    <td><a href="{{ route('downloadXLS', ['type' => 'frequency', 'id' => $res->id]) }}">XLS</a></td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
</body>
</html>

