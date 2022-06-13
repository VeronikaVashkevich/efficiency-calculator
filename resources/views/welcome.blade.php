<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Расчет эффективности</title>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>
<body>
<div class="container">
    <div class="calculator">
        <div class="header text-center"><h1>Калькулятор эффективности</h1></div>
        <div class="swapper mb-15">
            <ul>
                <li class="swapper-item energy-item">Энергетическая эффективность</li>
                <li class="swapper-item frequency-item">Частотная эффективность</li>
            </ul>
        </div>
        <div class="form">
            <div class="energy">
                <form action="{{route('index')}}" method="get" id="energy">
                    @csrf
                    <div class="mb-15">
                        <label for="R">R - скорость передачи</label>
                        <input type="number" name="R" id="R" step="0.0000001" class="form-control" required>
                    </div>
                    <div class="mb-15">
                        <label for="Pe">P<sub>e</sub> - мощность сигнала</label>
                        <input type="number" name="Pe" id="Pe" step="0.0000001" class="form-control" required>
                    </div>
                    <div class="mb-15">
                        <label for="N0">N<sub>0</sub> - спектральная плотность шума</label>
                        <input type="number" name="N0" id="N0" step="0.0000001" class="form-control" required>
                    </div>
                    <input type="hidden" name="type" value="energy">
                    <div class="mb-15">
                        <button type="submit" class="btn-submit btn-energy">Рассчитать</button>
                    </div>
                </form>
            </div>
            <div class="frequency display-none">
                <form action="{{route('index')}}" method="get" id="frequency">
                    @csrf
                    <div class="mb-15">
                        <label for="R">R - скорость передачи</label>
                        <input type="number" name="R" id="R" step="0.0000001" class="form-control" required>
                    </div>
                    <div class="mb-15">
                        <label for="deltaF">&#916;F - ширина полосы частот</label>
                        <input type="number" name="deltaF" id="deltaF" step="0.0000001" class="form-control" required>
                    </div>
                    <input type="hidden" name="type" value="frequency">
                    <div class="mb-15">
                        <button type="submit" class="btn-submit btn-frequency">Рассчитать</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="result mb-15">
            @if (!empty($result))
                Результат: {{ $result }}
            @endif
        </div>
        <div class="history mb-15">
            <a href="{{ route('history') }}">История рассчетов</a>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.energy-item').on('click', function () {
            $('.energy').removeClass('display-none');
            $('.frequency').addClass('display-none');
        });

        $('.frequency-item').on('click', function () {
            $('.frequency').removeClass('display-none');
            $('.energy').addClass('display-none');
        });
    });

    @if (!empty($type) && $type == 'frequency')
    $('.frequency').removeClass('display-none');
    $('.energy').addClass('display-none');
    @endif

</script>
</body>
</html>
