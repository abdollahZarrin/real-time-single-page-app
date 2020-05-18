<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Realtime SPA</title>
    <link rel="stylesheet" href="{{asset("css/app.css")}}">
    <link rel="stylesheet" href="{{asset("css/font.css")}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href='https://cdn.fontcdn.ir/Font/Persian/Vazir/Vazir.css' rel='stylesheet' type='text/css'>
</head>
<body>
    <div id="app" style="{font-family: myFirstFont}">
        <v-app>
            <app-home></app-home>
        </v-app>
    </div>
    <script src="{{asset('js/app.js')}}"></script>
</body>
</html>
