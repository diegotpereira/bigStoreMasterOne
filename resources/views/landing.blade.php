<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{csrf_token()}}">
        <title>Store Online Web</title>
        <!-- <link href="{{ mix('css/app.css')}}" rel="stylesheet"> -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body>
        <div id="app">
            <app></app>
        </div>
        <script src="{{ mix('js/bootstrap.js')}}"></script>
        <script src="{{ mix('js/app.js')}}"></script>
    </body>
</html>