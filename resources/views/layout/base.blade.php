<!DOCTYPE html>
<html lang='{{config("app.locale")}}'>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{config('app.name')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/app.css')}}" />
</head>
<body>
    <div class="container">
    @yield('content')
    </div>

    <script src="{{asset('js/app.js')}}"></script>
</body>
</html>