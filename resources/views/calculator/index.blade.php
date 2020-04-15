<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        .container {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .form {
            max-width: 50%;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="form">
            <form action="{{ @route('calculator.compute') }}" method="post">
                @csrf
                <input name="input" type="text">
                <button type="submit">Calculate it.</button>
            </form>
        </div>

        @if(true === isset($output))
            <div class="result-box">
                <span>Result:</span>
                <span> {{ $output }}</span>
            </div>
        @endif

    </div>
</body>
</html>

